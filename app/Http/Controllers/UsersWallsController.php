<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;

class UsersWallsController
{
    public function index(){
//        dump($user = Auth::user()->load('posts'));
//        dd($user->posts);

        $posts = Auth::user()->posts()->get();
        $postsIds = [];
        for($i = 0; $i<count($posts); $i++){
            array_push($postsIds, $posts[$i]['id']);
        }

        $postImages = [];
        for ($i = 0; $i<count($postsIds); $i++) {
            //if (PostImage::query()->where('post_id', $postsIds[$i])->count() != 0){
                array_push($postImages, PostImage::query()->where('post_id', $postsIds[$i])->get());
            //}
        }

        return view('user-profile.user-wall',['posts' => $posts, 'postImages' => $postImages]);
    }
}
