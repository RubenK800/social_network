@extends('layouts.main')
@section('content')
<div class="d-flex justify-content-center">
    @if($avatar!=null)
    <img src="{{$avatar->user_avatar_directory."?v=".microtime()}}"
         alt="{{$avatar->user_avatar_directory}}Sorry I'm a table, go and find your picture yourself, cause I'm very lazy to do that" width="250px">
    @endif
</div>

<form method="post" action="{{route('upload-avatar')}}" enctype = "multipart/form-data">
    @csrf
    <input type="file" name="img">
    <input type="submit">
</form>

<div>
    <a href="{{route('user-wall.index', ['id' => Auth::id()])}}">
        Wall
    </a>
</div>
@endsection



