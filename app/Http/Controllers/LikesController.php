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
        if (PostLike::where('user_id', Auth::id())->where('post_id',$data)->count() === 0){
            Post::where('id', $data)->increment('likes_count',1);
            PostLike::insert(['user_id' => Auth::id(), 'post_id'=>$data]);
        }else{
            Post::where('id',$data)->decrement('likes_count',1);
            PostLike::where('user_id', Auth::id())->where('post_id',$data)->delete();
        }
        return response($data); //вместо echo $data
    }
}
