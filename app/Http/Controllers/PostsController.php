<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $files = $request->file('img');
        $postBody = $request->get('post-body');
        if (!is_null($files)) {
            $post = new Post();
            $post->user_id = Auth::id();
            $post->body = $postBody;
            $post->likes_count = 0;
            $post->comments_count = 0;
            $post->reposts_count = 0;
            $post->save();
            foreach($files as $file) {
                $file->storeAs('post_pics', $file->getClientOriginalName());
                $directory = asset('storage/' . 'post_pics/' . $file->getClientOriginalName());
                $postImage = new PostImage();
                $postImage->post_id = $post->id;
                $postImage->image_name = $file->getClientOriginalName();
                $postImage->image_directory = $directory;
                $postImage->image_size = $file->getSize();
                $postImage->save();
            }
        } else {
            if (!is_null($postBody)) {
                Post::insert(['user_id' => Auth::id(), 'body' => $postBody, 'likes_count' => 0, 'comments_count' => 0, 'reposts_count' => 0]);
            }
        }

        $posts = Auth::user()->posts()->get();
        return //view('user-profile.user-wall', ['posts' => $posts]);
        Redirect::route('user-wall.index')->with(['posts'=>$posts]);
    }
}
