@extends('layouts.main')
@section('content')
<div class="container">
    @foreach ($users as $user)
        {{ $user->name }}
    @endforeach
</div>

{{ $users->links() }}

{{--<script src="{{mix('js/app.js')}}"></script>--}}
@endsection
