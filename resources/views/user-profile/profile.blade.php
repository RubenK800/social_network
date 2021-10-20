{{--@if (auth()->user()/*session()->get('isLoggedIn')*/)--}}
@extends('layouts.layout1')
@section('content')
<div class="d-flex justify-content-center">
    <img src="https://img.etimg.com/thumb/msid-79066167,width-1200,height-900,imgsize-380692,resizemode-8,quality-100/prime/technology-and-startups/appification-of-space-is-a-chance-to-leverage-a-big-shift-to-unlock-value-vcs-and-isro-take-note-.jpg"
         alt="Sorry I'm a table, go and find your picture yourself, cause I'm very lazy to do that">
</div>
@endsection
{{--@else--}}
{{--    {{URL::route('login')}}--}}
{{--@endif--}}
