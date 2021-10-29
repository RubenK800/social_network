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
        $file = $request->file('img');
        $postBody = $request->get('post-body');
        if (!is_null($file)) {
            $file->store('post_pics');
            $directory = asset('storage/' . 'post_pics/' . $file->getClientOriginalName());

            if (!is_null($postBody)) {
                Post::insert(['user_id' => Auth::id(), 'body' => $postBody, 'likes_count' => 0, 'comments_count' => 0, 'reposts_count' => 0]);
                //get the last inserted post_id
                $data = Post::latest('id')->first();
                $id = $data->id;
                PostImage::insert(['post_id' => $id, 'image_name' => $file->getClientOriginalName(), 'image_directory' => $directory,
                    'image_size' => $file->getSize()]);
            }
        }else{
            if (!is_null($postBody)) {
                Post::insert(['user_id' => Auth::id(), 'body' => $postBody, 'likes_count' => 0, 'comments_count' => 0, 'reposts_count' => 0]);
            }
        }

        $posts = Auth::user()->posts()->get();
        return //view('user-profile.user-wall', ['posts' => $posts]);
        Redirect::route('user-wall.index')->with(['posts'=>$posts]);
    }
}
