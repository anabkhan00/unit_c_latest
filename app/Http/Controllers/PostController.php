<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    // List all posts for logged-in user
    public function create()
    {
        $posts = Post::where('user_id', auth()->id())->get();

    // Pass posts to the view
    return view('pages.social-link', compact('posts'));
    }

    // Show form to create new post
    public function index()
{
    // Get posts for the logged-in user
    $posts = Post::where('user_id', auth()->id())->get();

    // Pass posts to the view
    return view('pages.social-link', compact('posts'));
}


public function store(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // allow up to 5MB
    ]);

    // 2️⃣ Ensure user logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('warning', 'Please login first.');
    }

    $user = Auth::user();

    // 3️⃣ Handle image upload locally (optional)
    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('posts', 'public');
    }

    // 4️⃣ Optionally save to local DB
    $post = Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $path,
        'user_id' => $user->id,
    ]);

    // 5️⃣ If LinkedIn not connected → redirect to authorize
    if (!$user->linkedin_access_token) {
        $client_id = config('services.linkedin.client_id');
        $redirect_uri = config('services.linkedin.redirect_uri');
        $scope = urlencode('openid profile email w_member_social');
        $state = csrf_token();

        $url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&scope={$scope}&state={$state}";
        return redirect($url);
    }

    try {
        // 6️⃣ Create Guzzle client
        $client = new \GuzzleHttp\Client(['verify' => false]);

        // Get user LinkedIn ID
        $meResponse = $client->get('https://api.linkedin.com/v2/userinfo', [
            'headers' => [
                'Authorization' => "Bearer {$user->linkedin_access_token}"
            ]
        ]);
        $meData = json_decode($meResponse->getBody(), true);
        $author = 'urn:li:person:' . $meData['sub'];

        // Prepare LinkedIn post body
        $body = [
            "author" => $author,
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $request->title . "\n\n" . strip_tags($request->description)
                    ],
                    "shareMediaCategory" => $request->hasFile('image') ? "IMAGE" : "NONE"
                ]
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
            ]
        ];

        // 7️⃣ If image exists, upload to LinkedIn
        if ($request->hasFile('image')) {
            // Step 1: Register image upload
            $register = $client->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
                'headers' => [
                    'Authorization' => "Bearer {$user->linkedin_access_token}",
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    "registerUploadRequest" => [
                        "owner" => $author,
                        "recipes" => ["urn:li:digitalmediaRecipe:feedshare-image"],
                        "serviceRelationships" => [[
                            "identifier" => "urn:li:userGeneratedContent",
                            "relationshipType" => "OWNER"
                        ]]
                    ]
                ])
            ]);
            $registerData = json_decode($register->getBody(), true);

            $uploadUrl = $registerData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
            $asset = $registerData['value']['asset'];

            // Step 2: Upload image binary (🔧 FIXED)
            $imagePath = $request->file('image')->getRealPath();
            $mimeType = $request->file('image')->getMimeType();
            $fileSize = filesize($imagePath);

            $client->put($uploadUrl, [
                'body' => file_get_contents($imagePath),
                'headers' => [
                    'Authorization' => "Bearer {$user->linkedin_access_token}",
                    'Content-Type' => $mimeType,
                    'Content-Length' => $fileSize,
                ]
            ]);

            // Step 3: Attach image to post
            $body["specificContent"]["com.linkedin.ugc.ShareContent"]["media"] = [[
                "status" => "READY",
                "media" => $asset
            ]];
        }

        // 8️⃣ Publish post
        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'headers' => [
                'Authorization' => "Bearer {$user->linkedin_access_token}",
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($body)
        ]);

        $responseData = json_decode($response->getBody(), true);
if (isset($responseData['id'])) {
    $post->linkedin_post_urn = $responseData['id'];
    $post->save();
}
            return redirect()->route('social.link')->with('success', 'Posted successfully on LinkedIn!');

    } catch (\Exception $e) {
        \Log::error('LinkedIn post error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Post saved locally but LinkedIn upload failed.',
            'error' => $e->getMessage()
        ]);
    }
}



public function callback(Request $request)
{
    if ($request->has('error')) {
        return redirect()->route('posts.store')->with('error', 'LinkedIn authorization failed: ' . $request->error_description);
    }

    $code = $request->code;

    $client = new \GuzzleHttp\Client(['verify' => false]);
    

    try {
        // Step 1: Exchange code for access token
        $response = $client->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => config('services.linkedin.client_id'),
                'client_secret' => config('services.linkedin.client_secret'),
                'redirect_uri' => config('services.linkedin.redirect_uri'),
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // Step 2: Save token
        $user = Auth::user();
        $user->linkedin_access_token = $data['access_token'];
        $user->linkedin_token_expires_at = now()->addSeconds($data['expires_in']);
        $user->save();

        // Step 3: Optional — Fetch LinkedIn profile and store LinkedIn ID
        $profileResponse = $client->get('https://api.linkedin.com/v2/userinfo', [
            'headers' => [
                'Authorization' => "Bearer {$data['access_token']}",
                'Content-Type' => 'application/json',
            ]
        ]);
        $profileData = json_decode($profileResponse->getBody(), true);

        // Save LinkedIn ID for future posts
        if (isset($profileData['sub'])) {
            $user->linkedin_id = $profileData['sub'];
            $user->save();
        }

        return redirect()->route('posts.store')->with('success', 'LinkedIn connected successfully.');

    } catch (\Exception $e) {
        return redirect()->route('posts.store')->with('error', 'LinkedIn callback failed: ' . $e->getMessage());
    }
}
public function delete($id)
{
    // dd($id);
    try {
        // Step 1: Database se post nikaalo
        $post = Post::findOrFail($id);

        // Step 2: LinkedIn Access Token lo (jo aap pehle store karte ho)
        $accessToken = Auth::user()->linkedin_access_token;

        // Step 3: LinkedIn API call to delete post
        $client = new \GuzzleHttp\Client();
        $linkedinPostUrn = $post->linkedin_post_urn; // e.g. urn:li:share:7393960776526376960

        // LinkedIn DELETE API request
        $response = $client->request('DELETE', "https://api.linkedin.com/v2/ugcPosts/$linkedinPostUrn", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
            ],
        ]);

        // Step 4: Agar successful response mila, to DB se delete kar do
        if ($response->getStatusCode() == 204) {
            $post->delete();
            return redirect()->route('social.link')->with('success', 'Post deleted successfully from LinkedIn and database!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete from LinkedIn.');
        }

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error deleting post: ' . $e->getMessage());
    }
}


}




