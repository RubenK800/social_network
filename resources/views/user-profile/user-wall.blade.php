@extends('layouts.main')
@section('content')
<form action="{{route('save-post')}}" method="post" enctype = "multipart/form-data">
    @csrf
    <div>
        <label>
            <input type="text" name="post-body" id="text">
        </label>
    </div>
    <div>
        <label for="image" style="border: solid #1a202c 1px">Add image</label>
            <input type="file" id="image" name="img" hidden>
    </div>
    <br>
    <input type="submit" name="submit" value="Send post" id = "submit">
</form>
<br>
<div>
    @isset($posts)
    @foreach($posts as $post)
        <div class="col-4">
            <div>
                {{$post['body']}}
            </div>
            <div>
                @foreach($postImages[$post['id']-1] as $image)
                <img src="{{$image['image_directory']}}"
                     alt = "{{$image['image_directory']}}">
                @endforeach
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
        </div>
    @endforeach
    @endisset
</div>

<script>
    let submit = document.getElementById('submit');
    submit.onclick = function () {
        if(document.getElementById("image").files.length === 0 && document.getElementById("text").value===''){
            alert("nothing to post");
                return false;
        }
    };
</script>
@endsection
