<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $file = $request->file('img');
        $postBody = $request->get('post-body');
        $file->store('post_pics');
        $directory = asset('storage/'.'post_pics/'.$file->getClientOriginalName());

        Post::insert(['user_id' => Auth::id(), 'body' => $postBody, 'image_directory' => $directory]);
    }
}
