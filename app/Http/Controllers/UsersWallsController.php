<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;

class UsersWallsController
{
    public function index(){
        $posts = Auth::user()->posts()->get();
        $postImages = PostImage::get();
        return view('user-profile.user-wall',['posts' => $posts, 'postImages' => $postImages]);
    }
}
