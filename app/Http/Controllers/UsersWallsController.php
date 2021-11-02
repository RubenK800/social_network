<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UsersWallsController
{
    public function index()
    {
        $posts = Auth::user()->posts()->with('images')->get();
        return view('user-profile.user-wall',['posts' => $posts]);
    }
}
