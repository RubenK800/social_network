<?php

namespace App\Http\Controllers;

use App\Models\CommentImage;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IndependentCommentsController extends Controller
{
    public function store(Request $request){
        $image = $request->file('comment_image');
        $commentText = $request->get('comment-text');
        $postId = $request->get('postId');

        if (!is_null($image)) {
                $commentId = $this->createIndependentComment($commentText,$postId);
                $image->storeAs('comment_pics', $image->getClientOriginalName());
                $imageName = $image->getClientOriginalName();
                $this->saveCommentImage($commentId, $imageName);
        } else {
            if (!is_null($commentText)) {
                $this->createIndependentComment($commentText, $postId);
            }
        }

        //$postComments = PostComment::where('post_id',$postId)->get();
        return Redirect::route('user-wall.index')/*->with(['postIndComments' => $postComments])*/;
    }

    private function createIndependentComment(string $commentText, int $postId):int {
        $comment = new PostComment();
        $comment->post_id = $postId;
        $comment->writer_user_id = Auth::id();
        $comment->comment_text = $commentText;
        $comment->receiver_user_id = 0;
        $comment->receiver_comment_id = 0;
        $comment->save();

        return $comment->id;
    }

    private function saveCommentImage(int $commentId, string $imageName):void {
        $commentImage = new CommentImage();
        $commentImage->comment_id = $commentId;
        $commentImage->image_name = $imageName;
        $commentImage->save();
    }
}
