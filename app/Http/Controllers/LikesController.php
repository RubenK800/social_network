<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function store(Request $request)
    {
//        $data = $request->post_id; //тоже работает
        $data = $request->input('post_id',0);
//        $currentLikesCount = Post::where('id', $data)->value('likes_count');
//        $newLikesCount = $currentLikesCount+1;
        if (PostLike::where('user_id', Auth::id())->where('post_id',$data)->count() === 0){
            $currentLikesCount = Post::where('id', $data)->value('likes_count');
            $newLikesCount = $currentLikesCount+1;
            Post::where('id',$data)->update(['likes_count' => $newLikesCount]);
            PostLike::insert(['user_id' => Auth::id(), 'post_id'=>$data]);
        }else{
            $currentLikesCount = Post::where('id', $data)->value('likes_count');
            $newLikesCount = $currentLikesCount-1;
            Post::where('id',$data)->update(['likes_count' => $newLikesCount]);
            PostLike::where('user_id', Auth::id())->where('post_id',$data)->delete();
        }

        return response($data); //вместо echo $data
    }
}
