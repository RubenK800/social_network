<?php

namespace App\Http\Controllers;

use App\Models\CommentImage;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDislike;
use App\Models\PostCommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function store(Request $request){
        $image = $request->file('comment_image');
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

        return Redirect::route('user-wall.index');
    }

    public function update($id, Request $request){
        $image = $request->file('comment_image');
        $commentText = $request->get('comment-text');

        $comment = PostComment::where('id',$id)->first();
        if (! Gate::allows('update-comment', $comment)) {
            abort(403);
        }

        if ($image) {
            $this->updateComment($id,$commentText);
            $image->storeAs('comment_pics', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $this->saveCommentImage($id, $imageName);
        } else {
            if ($commentText) {
                $this->updateComment($id,$commentText);
            }
        }
        return Redirect::route('user-wall.index');
    }

    public function destroy($id){
        $comment = PostComment::where('id',$id)->first();
        if (! Gate::allows('delete-comment', $comment)) {
            abort(403);
        }
        PostComment::where('id',$id)->where('writer_user_id',Auth::id())->delete();
        PostCommentLike::where('comment_id', $id)->where('user_id',Auth::id())->delete();
        PostCommentDisLike::where('comment_id', $id)->where('user_id',Auth::id())->delete();
        $image_name = CommentImage::where('comment_id',$id)->value('image_name');
        CommentImage::where('comment_id',$id)->delete();
        if (is_file('storage/comment_pics/'.$image_name)) {
            unlink('storage/comment_pics/' . $image_name);
        }
        return Redirect::route('user-wall.index');
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

    private function updateComment($id,$newText):void {
        PostComment::where('id',$id)->update(['comment_text'=>$newText]);
    }

    private function saveCommentImage(int $commentId, string $imageName):void {
        $commentImage = new CommentImage();
        $commentImage->comment_id = $commentId;
        $commentImage->image_name = $imageName;
        $commentImage->save();
    }
}
