<!DOCTYPE html>
<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title></title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
</head>
<body>
<div id="app">
    <header-nav></header-nav>
</div>

<script src="{{mix('js/app.js')}}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
