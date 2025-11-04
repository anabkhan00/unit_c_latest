<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    // List all posts for logged-in user
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show form to create new post
    public function create()
    {
        return view('pages.post_create');
    }

    // Store post in DB
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
    ]);

    // Ensure user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('warning', 'Please login first.');
    }

    $user = Auth::user();

    // Step 1: If LinkedIn not connected, redirect to authorization
    if (!$user->linkedin_access_token) {
        $client_id = '86l1tccr8so0e2';
        $redirect_uri = 'https://honeydew-hornet-347288.hostingersite.com/linkedin/callback';
        $scope = urlencode('openid profile email w_member_social');
        $state = csrf_token();

        $url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&scope={$scope}&state={$state}";
        return redirect($url);
    }

    try {
        // Step 2: Use saved access token to get LinkedIn profile
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'headers' => [
                'Authorization' => "Bearer {$user->linkedin_access_token}",
                'Content-Type' => 'application/json',
            ]
        ]);

        // ✅ New LinkedIn endpoint (per documentation)
        $meResponse = $client->get('https://api.linkedin.com/v2/userinfo');
        $meData = json_decode($meResponse->getBody(), true);

        // 'sub' is the LinkedIn user ID in OIDC (OpenID Connect)
        $author = 'urn:li:person:' . $meData['sub'];

        // Step 3: Prepare and post to LinkedIn
        $body = [
            "author" => $author,
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $request->title . "\n\n" . $request->content
                    ],
                    "shareMediaCategory" => "NONE"
                ]
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
            ]
        ];

        $response = $client->post('https://api.linkedin.com/v2/ugcPosts', [
            'body' => json_encode($body)
        ]);

        $responseData = json_decode($response->getBody(), true);

        return response()->json([
            'success' => true,
            'message' => 'Posted successfully on LinkedIn!',
            'linkedin_response' => $responseData
        ]);

    } catch (\Exception $e) {
        // \Log::error('LinkedIn post error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'LinkedIn post failed',
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
                'redirect_uri' => 'https://honeydew-hornet-347288.hostingersite.com/linkedin/callback',
                'client_id' => '86l1tccr8so0e2',
                'client_secret' => 'WPL_AP1.zdnwuYtjbW0VzOGq.spsYTA==',
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
}




