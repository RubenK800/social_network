<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $files = $request->file('img');
        $postBody = $request->get('post-body');
        if ($files) {
            $postId = $this->createPost($postBody);
            foreach($files as $file) {
                $file->storeAs('post_pics', $file->getClientOriginalName());
                $postImageName = $file->getClientOriginalName();
                $this->savePostImage($postId, $postImageName);
            }
        } else {
            if ($postBody) {
                Post::insert(['user_id' => Auth::id(), 'body' => $postBody, 'likes_count' => 0, 'comments_count' => 0, 'reposts_count' => 0]);
            }
        }

        $posts = Auth::user()->posts()->get();
        return //view('user-profile.user-wall', ['posts' => $posts]);
        Redirect::route('user-wall.index')->with(['posts'=>$posts]);
    }

    public function update($id, Request $request){
        $files = $request->file('img');
        $postBody = $request->get('post-body');

//        $comment = PostComment::where('id',$id)->first();
//        if (! Gate::allows('update-comment', $comment)) {
//            abort(403);
//        }
//        ddd($files);
        if ($files) {
            $this->updatePost($id,$postBody);
            foreach($files as $file) {
                $file->storeAs('post_pics', $file->getClientOriginalName());
                $postImageName = $file->getClientOriginalName();
                $this->savePostImage($id, $postImageName);
            }
        } else {
            if ($postBody) {
                $this->updatePost($id,$postBody);
            }
        }

        $posts = Auth::user()->posts()->get();
        return //view('user-profile.user-wall', ['posts' => $posts]);
            Redirect::route('user-wall.index')->with(['posts'=>$posts]);
    }

    public function destroy($id){
        Post::where('id',$id)->where('user_id',Auth::id())->delete();
        PostLike::where('post_id', $id)->where('user_id',Auth::id())->delete();
        $image_name = PostImage::where('post_id',$id)->value('image_name');
        PostImage::where('post_id', $id)->delete();
        if (is_file('storage/post_pics/'.$image_name)) {
            unlink('storage/post_pics/' . $image_name);
        }
        return Redirect::route('user-wall.index');
    }

    private function createPost($postBody):int {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->body = $postBody;
        $post->likes_count = 0;
        $post->comments_count = 0;
        $post->reposts_count = 0;
        $post->save();

        return $post->id;
    }

    private function updatePost($id,$newText):void {
        Post::where('id',$id)->update(['body'=>$newText]);
    }

    private function savePostImage($postId, $postImageName):void {
        $postImage = new PostImage();
        $postImage->post_id = $postId;
        $postImage->image_name = $postImageName;
        $postImage->save();
    }
}
