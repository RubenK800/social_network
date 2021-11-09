<!DOCTYPE html>
<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title></title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
</head>
<body>
@include('templates.header')

@yield('content')
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
@include('templates.footer')
{{--<script src="{{mix('js/app.js')}}"></script>--}}
<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
