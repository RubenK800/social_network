<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UsersWallsController
{
    public function index()
    {
        $posts = Auth::user()->posts()->with('images','comments.user', 'comments.dependentComments', 'comments.image',
            'comments.dependentComments.user', 'comments.dependentComments.image')->get();
        //ddd($posts);

        //dd($posts[0]->comments[20]->image);
        return view('user-profile.user-wall',['posts' => $posts]);
    }
}
