<?php $uri = request();?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="">Ci4 Login</a>
        @if (auth()->user()/*session()->get('isLoggedIn')*/)
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item" <?= ($uri->segment(1) === 'dashboard' ? 'active':null); ?>>
                    <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item" <?= ($uri->segment(1) === 'profile' ? 'active':null); ?>>
                    <a class="nav-link" href="/user-profile">Profile</a>
                </li>
            </ul>
{{--            <ul class="navbar-nav my-2 my-lg-0">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="/logout">Logout</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
            <form action="/logout" method="post" class="navbar-nav my-2 my-lg-0">
                @csrf
                <input type="submit" value="logout" class="nav-item">
            </form>
        </div>
        @else
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" {{ $uri->segment(1) == '' ? 'active' : null}}">
                    <a class="nav-link active" aria-current="page" href="/">Login</a>
                </li>
                <li class="nav-item" {{$uri->segment(1) == 'register' ? 'active' : null}}">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
