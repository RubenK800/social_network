<?php

namespace App\Http\Controllers;

//use Session;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersWallsController
{
    public function index()
    {
        $posts = Auth::user()->posts()->with('images','comments.user','comments.dependentComments', 'comments.image')->get();
        //ddd($posts);
        //check and correct the comments count if there is wrong value
        foreach ($posts as $post) {
            $commentsCount = PostComment::where('post_id',$post['id'])->count();
            if ($commentsCount > 0) {
                Post::where('id', $post['id'])->update(['comments_count' => $commentsCount]);
            }
        }

        //dd($posts[0]->comments[20]->image);
        return view('user-profile.user-wall',['posts' => $posts]);
    }
}
