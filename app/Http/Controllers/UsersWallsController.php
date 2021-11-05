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
        $posts = Auth::user()->posts()->with('images','comments.user')->get();
        //ddd($posts);
        return view('user-profile.user-wall',['posts' => $posts]);
    }
}
