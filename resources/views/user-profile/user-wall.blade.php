@extends('layouts.main')
@section('content')
<form action="{{route('save-post')}}" method="post" enctype = "multipart/form-data">
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
                <button onclick="">Comments</button>
            </div>
            <hr>
            <div id="comments-place">
                @foreach($post->comments as $comment)
                    <br>
                    <div>
                         {{$comment->user['name']}}
                    </div>
                    <div>{{$comment['comment_text']}}</div>
                    <br>
                @endforeach
            </div>
            <hr>
            <div>
                <form action="{{route('add-independent-comment', ['postId' => $post['id']])}}" method='post'>
                    @csrf
                    <label>
                        <input type="text" name="comment-text">
                    </label>
                    <label for="comment_image" style="border: solid #1a202c 1px">Add Image</label>
                    <div>
                    <input type="file" id="comment_image" name="comment_image" hidden>
                    </div>
                    <input type="submit" value="Send comment">
                </form>
            </div>
            <hr>
            <div>
                Likes count = {{$post['likes_count']}}
            </div>
            <div>
                Comments count = {{$post['comments_count']}}
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
<script src="js/user-wall.js">
    //src="js/users-wall/user-wall.js"
    // let submit = document.getElementById('submit');
    // submit.onclick = function () {
    //     if(document.getElementById("image").files.length === 0 && document.getElementById("text").value===''){
    //         alert("nothing to post");
    //             return false;
    //     }
    // };
    //
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    //
    // function likeIt(postId)
    // {
    //     $.ajax({
    //         url:'add-like',
    //         data:{'post_id':postId},
    //         type:'post',
    //         success:  function (response) {
    //             console.log(response);
    //         },
    //         error: function(x,xs,xt){
    //             console.log(x);
    //         }
    //     });
    // }

</script>
@endsection
