<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="">Ci4 Login</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{route('user.profile.index')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteNamed('user.profile.show') ? 'active' : '' }}" href="{{route('user.profile.index')}}">Profile</a>
                </li>
            </ul>
            <form action="/logout" method="post" class="navbar-nav my-2 my-lg-0">
                @csrf
                <input type="submit" value="logout" class="nav-item">
            </form>
        </div>
    </div>
</nav>

{{--{{route('test', $id)}}--}}
