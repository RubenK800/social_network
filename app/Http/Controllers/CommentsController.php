<?php

namespace App\Http\Controllers;

use App\Models\CommentImage;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function store(Request $request){
        $image = $request->file('comment_image');
        ddd($image);
        $commentText = $request->get('comment-text');
        $postId = $request->get('postId');
        $receiver_comment_id = $request->get('receiverCommentId');

        if ($image) {
                $commentId = $this->createComment($commentText,$postId, $receiver_comment_id);
                $image->storeAs('comment_pics', $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
                $this->saveCommentImage($commentId, $imageName);
        } else {
            if ($commentText) {
                $this->createComment($commentText, $postId,$receiver_comment_id);
            }
        }

        //$postComments = PostComment::where('post_id',$postId)->get();
        return Redirect::route('user-wall.index')/*->with(['postIndComments' => $postComments])*/;
    }

    private function createComment(string $commentText, int $postId, int $receiverCommentId):int {
        $comment = new PostComment();
        $comment->post_id = $postId;
        $comment->writer_user_id = Auth::id();
        $comment->comment_text = $commentText;
        $comment->receiver_comment_id = $receiverCommentId;
        $comment->likes_count = 0;
        $comment->dislikes_count = 0;
        $comment->save();

//        $commentsCount = PostComment::where('post_id')->count();
//        if ($commentsCount > 0) {
//            Post::where('id', $postId)->update(['comments_count' => $commentsCount]);
//        }
        Post::where('id', $postId)->increment('comments_count', 1);
        return $comment->id;
    }

    private function saveCommentImage(int $commentId, string $imageName):void {
        $commentImage = new CommentImage();
        $commentImage->comment_id = $commentId;
        $commentImage->image_name = $imageName;
        $commentImage->save();
    }
}
