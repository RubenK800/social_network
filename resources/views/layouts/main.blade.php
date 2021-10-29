<!DOCTYPE html>
<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title></title>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
@include('templates.header')

@yield('content')

@include('templates.footer')
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
