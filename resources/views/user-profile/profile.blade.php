@extends('layouts.main')
@section('content')
<div class="d-flex justify-content-center">
    @if($avatar!=null)
    <img src="{{asset('storage/' . 'avatars/' . $avatar->user_avatar_name."?v=".microtime())}}"
         alt="{{asset('storage/' . 'avatars/' . $avatar->user_avatar_name."?v=".microtime())}}" width="250px">
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



