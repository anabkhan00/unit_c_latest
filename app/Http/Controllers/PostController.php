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

}




