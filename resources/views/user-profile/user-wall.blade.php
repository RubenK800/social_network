@extends('layouts.main')
@section('content')
<form action="{{route('posts.store')}}" method="post" enctype = "multipart/form-data">
    @csrf
    <div class="col-8 mx-auto">
        <label>
{{--            <input type="text" name="post-body" id="text">--}}
            <textarea class="form-control" name="post-body" id="text" rows="10" style="width: 800px"></textarea>
        </label>
    </div>
    <div class="col-8 mx-auto">
        <label for="image" style="border: solid #1a202c 1px">Add image</label>
            <input type="file" id="image" name="img[]" multiple hidden>
    </div>
    <br>
    <div class="col-8 mx-auto">
        <input type="submit" name="submit" value="Send post" id = "submit-post">
    </div>
</form>
<br>
<div>
    @isset($posts)
        @php
            $userId = Auth::id();
        @endphp
    @foreach($posts as $postNo => $post)
        <div class="col-8 mx-auto" style="background-color: #cbd5e0; margin-bottom: 50px;">
            <hr>
            <div style="overflow: hidden; word-wrap: break-word">
                {{$post['body']}}
            </div>
            <div>
                @foreach($post->images as $image)
                <img src = "{{asset('storage/post_pics/' . $image['image_name'])}}"
                     alt = "{{asset('storage/post_pics/' . $image['image_name'])}}"
                     height="250px">
                @endforeach
            </div>
            <hr>
{{--            <post-functions name = "{{$post['id']}}" ></post-functions>--}}
{{--            <div>--}}
{{--                <button class="likeIt" data-post-like="{{$post['id']}}">Like it</button>--}}
{{--                <button class="show-comments hide-c{{$postNo}}" data-show-c = "show-c{{$postNo}}">Show Comments</button>--}}
{{--                <button class="hide-comments show-c{{$postNo}}" data-hide-c = "hide-c{{$postNo}}" hidden>Hide Comments</button>--}}
{{--                <button class="post-edit" data-edit="post-edit{{$post['id']}}">Edit</button>--}}
{{--                <form action="{{route('posts.destroy',['id'=>$post['id']])}}" method="post">--}}
{{--                    @method('DELETE')--}}
{{--                    @csrf--}}
{{--                    <input type="submit" value="Delete">--}}
{{--                </form>--}}
{{--            </div>--}}
            <hr>
            <div class="post-edit-form post-edit{{$post['id']}} post-edit-changed-mind{{$post['id']}}" hidden>
                <form action="{{route('posts.update', ['id' => $post['id']])}}" method="post" enctype = "multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-8 mx-auto">
                        <label>
                            {{--            <input type="text" name="post-body" id="text">--}}
                            <textarea class="form-control" name="post-body" id="text" rows="5" style="width: 800px"></textarea>
                        </label>
                    </div>
                    <div class="row container">
                        @foreach($post->images as $image)
                            <div class="col-sm-3">
                                <div class="row">
                                    <img src = "{{asset('storage/post_pics/' . $image['image_name'])}}"
                                         alt = "{{asset('storage/post_pics/' . $image['image_name'])}}"
                                         height="250px">
                                </div>
                                <div>
                                    <button type="button" class="delete-post-image" data-post="{{$post['id']}}"
                                            data-image-name="{{$image['image_name']}}">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-8 mx-auto">
                        <label style="border: solid #1a202c 1px">Add image
                            <input type="file" name="img[]" multiple hidden>
                        </label>
                    </div>
                    <br>
                    <div class="col-8 mx-auto">
                        <input type="submit" name="submit" value="Save changes" id = "submit-post">
                    </div>
                </form>
                <button class="post-edit-form-hide" data-post-edit-form-hide = "post-edit-changed-mind{{$post['id']}}">I changed my mind</button>
            </div>
            <hr>
            <div class="comments-place show-c{{$postNo}} hide-c{{$postNo}}" hidden>
                @foreach($post->comments as $indElementNo => $independentcomment)
                    @if($independentcomment['receiver_comment_id'] === 0)
                        <br>
                        <div class="bg-light">
                            <div class="text-light bg-dark">
                                @if(!is_null($independentcomment->user))
                                {{$independentcomment->user['name']}}
                                @else
                                {{'User'}}
                                @endif
                            </div>
                            <div>
                                {{$independentcomment['comment_text']}}
                            </div>
                            <div>
                                @isset($independentcomment->image['image_name'])
                                    <img src="storage/comment_pics/{{$independentcomment->image['image_name']}}" alt="go away from me! I'm sad and angry" height="150px">
                                @endisset
                            </div>
                        </div>
                        <div>
                            <button class="comment-like-dislike" data-comment-like-dislike = "ind-c-like{{$independentcomment['id']}}">Like</button>
                            <button class="comment-like-dislike" data-comment-like-dislike ="ind-c-dislike{{$independentcomment['id']}}">Dislike</button>
                            <button class="comment-function-show" data-comment-function-show="ind-reply{{$indElementNo}}">Reply</button>
                            <div>
                                @if($independentcomment->user['id'] === $userId)
                                    <button class="comment-edit" data-edit="ind-edit{{$indElementNo}}">Edit</button>
                                    <form action="{{route('comments.destroy',['id'=>$independentcomment['id']])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Delete">
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="to-independent-comment-write-form ind-reply{{$indElementNo}} ind-changed-mind{{$indElementNo}}" hidden>
                            <form action="{{route('comments.store', ['postId' => $post['id'],
                                            'receiverCommentId' => $independentcomment['id']])}}" method='post' enctype="multipart/form-data">
                                @csrf
                                <label>
                                    <input type="text" name="comment-text" class="comment-text reply-ind-c-value{{$indElementNo}}" value="{{$independentcomment->user['name']}}, ">
                                </label>
                                <label style="border: solid #1a202c 1px">Add Image
                                    <input type="file" name="comment_image" class="comment_image reply-ind-c-value{{$indElementNo}}" hidden>
                                </label>
                                <input type="submit" class="submit-comment" data-comment-value="reply-ind-c-value{{$indElementNo}}" value="Send comment">
                            </form>
                            <button class="comment-function-hide" data-comment-function-hide="ind-changed-mind{{$indElementNo}}">I changed my mind</button>
                        </div>

                        @if($independentcomment->user['id'] === $userId)
                            <div class="independent-comment-edit-form ind-edit{{$indElementNo}} ind-edit-changed-mind{{$indElementNo}}" hidden>
                                <div>write your new comment here. It will replace the old one above</div>
                                <form action="{{route('comments.update', ['id'=>$independentcomment['id']])}}" method='post' enctype='multipart/form-data'>
                                    @csrf
                                    @method('PUT')
                                    <label>
                                        <input type="text" name="comment-text" class="comment-text edit-ind-c-value{{$indElementNo}}" value="{{$independentcomment['comment_text']}}">
                                    </label>
                                    <label style="border: solid #1a202c 1px">Add Image
                                        <input type="file" name="comment_image" class="comment_image edit-ind-c-value{{$indElementNo}}" hidden>
                                    </label>
                                    <input type="submit" class="submit-comment" data-comment-value="edit-ind-c-value{{$indElementNo}}" value="Send comment">
                                </form>
                                <button class="comment-function-hide" data-comment-function-hide = "ind-edit-changed-mind{{$indElementNo}}">I changed my mind</button>
                            </div>
                        @endif
                    @endif
                            <div class="ms-4">
                                @if(!is_null($independentcomment->dependentComments))
                                    @foreach($independentcomment->dependentComments as $dElementNo => $dependentComment)
                                        <br>
                                        <div class="bg-light">
                                        <div class="text-light bg-dark">
                                            @if(!is_null($dependentComment->user))
                                                {{$dependentComment->user['name']}}
                                            @else
                                                {{'User'}}
                                            @endif
                                        </div>
                                        <div>
                                            {{$dependentComment['comment_text']}}
                                        </div>
                                            <div>
                                                @isset($dependentComment->image['image_name'])
                                                    <img src="storage/comment_pics/{{$dependentComment->image['image_name']}}" alt="go away from me! I'm sad and angry" height="150px">
                                                @endisset
                                            </div>
                                        </div>
                                        <div>
                                            <button class="comment-like-dislike" data-comment-like-dislike = "d-c-like{{$dependentComment['id']}}">Like</button>
                                            <button class="comment-like-dislike" data-comment-like-dislike ="d-c-dislike{{$dependentComment['id']}}">Dislike</button>
                                            <button class="comment-function-show" data-comment-function-show="d-reply{{$dElementNo}}">Reply</button>
                                            <div>
                                                @if($dependentComment->user['id'] === $userId)
                                                    <button class="comment-edit" data-edit="d-edit{{$dElementNo}}">Edit</button>
                                                    <form action="{{route('comments.destroy', ['id'=>$dependentComment['id']])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="submit" value="Delete">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="to-dependent-comment-write-form d-reply{{$dElementNo}} d-changed-mind{{$dElementNo}}" hidden>
                                            <form action="{{route('comments.store', ['postId' => $post['id'],
                                            'receiverCommentId' => $independentcomment['id']])}}" method='post' enctype="multipart/form-data">
                                                @csrf
                                                <label>
                                                    <input type="text" name="comment-text" class="comment-text d-changed-mind{{$dElementNo}}" value="{{$dependentComment->user['name']}}, ">
                                                </label>
                                                <label style="border: solid #1a202c 1px">Add Image
                                                    <input type="file" name="comment_image" class="comment_image d-changed-mind{{$dElementNo}}" hidden>
                                                </label>
                                                <input type="submit" class="submit-comment" data-comment-value = "d-changed-mind{{$dElementNo}}" value="Send comment">
                                            </form>
                                            <button class="comment-function-hide" data-comment-function-hide="d-changed-mind{{$dElementNo}}">I changed my mind</button>
                                        </div>

{{--                                            даже если кнопка Edit видна для не авторизованного пользователя, то нажатие на него не активирует окно comment edit--}}
{{--                                        @if($dependentComment->user['id'] === $userId)--}}
                                        <div class="dependent-comment-edit-form d-edit{{$dElementNo}} d-edit-changed-mind{{$dElementNo}}" hidden>
                                            <div>write your new comment here. It will replace the old one above</div>
                                            <form action="{{route('comments.update', ['id'=>$dependentComment['id']])}}" method='post' enctype='multipart/form-data'>
                                                @csrf
                                                @method('PUT')
                                                <label>
                                                    <input type="text" name="comment-text" class="comment-text edit-d-c-value{{$dElementNo}}" value="{{$dependentComment['comment_text']}}">
                                                </label>
                                                <label style="border: solid #1a202c 1px">Add Image
                                                    <input type="file" name="comment_image" class="comment_image edit-d-c-value{{$dElementNo}}" hidden>
                                                </label>
                                                <input type="submit" class="submit-comment" data-comment-value="edit-d-c-value{{$dElementNo}}" value="Send comment">
                                            </form>
                                            <button class="comment-function-hide" data-comment-function-hide = "d-edit-changed-mind{{$dElementNo}}">I changed my mind</button>
                                        </div>
{{--                                        @endif--}}
                                    @endforeach
                                @endif
                            </div>
                @endforeach
            </div>
            <hr>
{{--            <div>Delete this post</div>--}}
{{--            <hr>--}}
            <div>
                <form action="{{route('comments.store', ['postId' => $post['id'], 'receiverCommentId' => 0])}}" method='post' enctype="multipart/form-data">
                    @csrf
                    <label>
                        <input type="text" name="comment-text" class="comment-text c-value{{$postNo}}">
                    </label>
                    <label style="border: solid #1a202c 1px">Add Image
                        <input type="file" name="comment_image" class="comment_image c-value{{$postNo}}" hidden>
                    </label>
                    <input type="submit" class="submit-comment" data-comment-value="c-value{{$postNo}}" value="Send comment">
                </form>
            </div>
            <hr>
            <div>
                Likes count = {{$post['likes_count']}}
            </div>
            <div>
                Comments count = {{count($post->comments)}}
            </div>
            <div>
                Reposts count = {{$post['reposts_count']}}
            </div>
            <hr>
        </div>

    @endforeach
    @endisset
</div>

@endsection

@section('js')
<script>
    import PostFunctions from "../../js/components/PostFunctions";
    export default {
        components: {PostFunctions}
    }
</script>
@endsection
