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
        <input type="submit" name="submit" value="Send post" id = "submit">
    </div>
</form>
<br>
<div>
    @isset($posts)
    @foreach($posts as $post)
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
            <div>
                <button class="likeIt" data-post-like="{{$post['id']}}">Like it</button>
                <button class="show-comments">Show Comments</button>
                <button class="hide-comments" hidden>Hide Comments</button>
            </div>
            <hr>
            <div class="comments-place" hidden>
                @foreach($post->comments as $independentcomment)
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
{{--                                $posts[0]->comments[20]->image['image_name']--}}
                            </div>
                            <div>
                                @isset($independentcomment->image['image_name'])
                                    <img src="storage/comment_pics/{{$independentcomment->image['image_name']}}" alt="go away from me! I'm sad and angry" height="150px">
                                @endisset
                            </div>
                        </div>
                        <div>
                            <button class="ind-comment-like" data-ind-comment-like = "{{$independentcomment['id']}}">Like</button>
                            <button class="ind-comment-dislike" data-ind-comment-dislike ="{{$independentcomment['id']}}">Dislike</button>
                            <button class="ind-comment-reply">Reply</button>
                        </div>
                        <div class="to-independent-comment-write-form" hidden>
                            <form action="{{route('comments.store', ['postId' => $post['id'],
                                            'receiverCommentId' => $independentcomment['id']])}}" method='post'>
                                @csrf
                                <label>
                                    <input type="text" name="comment-text">
                                </label>
                                <label style="border: solid #1a202c 1px">Add Image
                                    <input type="file" name="comment_image" hidden>
                                </label>
                                <input type="submit" value="Send comment">
                            </form>
                            <button class="hide-ind-comment-form">I changed my mind</button>
                        </div>
                    @endif
                            <div class="ms-4">
                                @if(!is_null($independentcomment->dependentComments))
                                    @foreach($independentcomment->dependentComments as $dependentComment)
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
                                        </div>
                                        <div>
                                            <button class="d-comment-like" data-d-comment-like = "{{$dependentComment['id']}}">Like</button>
                                            <button class="d-comment-dislike" data-d-comment-dislike ="{{$dependentComment['id']}}">Dislike</button>
                                            <button class="d-comment-reply">Reply</button>
                                        </div>
                                        <div class="to-dependent-comment-write-form" hidden>
                                            <form action="{{route('comments.store', ['postId' => $post['id'],
                                            'receiverCommentId' => $independentcomment['id']])}}" method='post' enctype="multipart/form-data">
                                                @csrf
                                                <label>
                                                    <input type="text" name="comment-text" value="{{$dependentComment->user['name']}}, ">
                                                </label>
                                                <label style="border: solid #1a202c 1px">Add Image
                                                    <input type="file" name="comment_image" hidden>
                                                </label>
                                                <input type="submit" value="Send comment">
                                            </form>
                                            <button class="hide-d-comment-form">I changed my mind</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                @endforeach
            </div>
            <hr>
            <div>
                <form action="{{route('comments.store', ['postId' => $post['id'], 'receiverCommentId' => 0])}}" method='post' enctype="multipart/form-data">
                    @csrf
                    <label>
                        <input type="text" name="comment-text">
                    </label>
                    <label style="border: solid #1a202c 1px">Add Image
                        <input type="file" name="comment_image" hidden>
                    </label>
                    <input type="submit" value="Send comment">
                </form>
            </div>
            <hr>
            <div>
                Likes count = {{$post['likes_count']}}
            </div>
            <div>
                Comments count = {{count($post->comments)}}{{--{{$post['comments_count']}}--}}
            </div>
            <div>
                Reposts count = {{$post['reposts_count']}}
            </div>
            <hr>
        </div>
    @endforeach
    @endisset
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{mix('js/user-wall.js')}}"></script>
@endsection
