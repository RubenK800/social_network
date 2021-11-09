<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDislike;
use App\Models\PostCommentLike;
use App\Models\PostImage;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function store(Request $request)
    {
//        $data = $request->post_id; //тоже работает
        if ($request->has('post_id') && $request->has('type')) {
            $data = $request->input('post_id', 0);
                if (PostLike::where('user_id', Auth::id())->where('post_id', $data)->count() === 0) {
                    Post::where('id', $data)->increment('likes_count', 1);
                    PostLike::insert(['user_id' => Auth::id(), 'post_id' => $data]);
                } else {
                    Post::where('id', $data)->decrement('likes_count', 1);
                    PostLike::where('user_id', Auth::id())->where('post_id', $data)->delete();
                }
        }else if ($request->has('comment_id') && $request->has('type')){
            $data = $request->input('comment_id', 0);
            $type = $request->input('type','false type');
            if ($type === 'like') {
                //PostCommentLike::where('user_id', Auth::id());
                if (PostCommentLike::where('user_id', Auth::id())->where('comment_id', $data)->count() === 0) {
                    PostComment::where('id', $data)->increment('likes_count', 1);
                    //if like exists, delete it, to not break the logic. Dislike === no likes from the same user
                    if (PostCommentDisLike::where('user_id', Auth::id())->where('comment_id', $data)->count()>0){
                        PostCommentDisLike::where('user_id', Auth::id())->where('comment_id', $data)->delete();
                        PostComment::where('id', $data)->decrement('dislikes_count', 1);
                    }
                    PostCommentLike::insert(['user_id' => Auth::id(), 'comment_id' => $data]);
                } else {
                    PostComment::where('id', $data)->decrement('likes_count', 1);
                    PostCommentLike::where('user_id', Auth::id())->where('comment_id', $data)->delete();
                }
            }else if ($type === 'dislike'){
                if (PostCommentDisLike::where('user_id', Auth::id())->where('comment_id', $data)->count() === 0) {
                    PostComment::where('id', $data)->increment('dislikes_count', 1);
                    //if like exists, delete it, to not break the logic. Dislike === no likes from the same user
                    if (PostCommentLike::where('user_id', Auth::id())->where('comment_id', $data)->count()>0){
                        PostCommentLike::where('user_id', Auth::id())->where('comment_id', $data)->delete();
                        PostComment::where('id', $data)->decrement('likes_count', 1);
                    }
                    PostCommentDisLike::insert(['user_id' => Auth::id(), 'comment_id' => $data]);
                } else {
                    PostComment::where('id', $data)->decrement('dislikes_count', 1);
                    PostCommentDisLike::where('user_id', Auth::id())->where('comment_id', $data)->delete();
                }
            }
        }

        return response($data); //вместо echo $data
    }
}
