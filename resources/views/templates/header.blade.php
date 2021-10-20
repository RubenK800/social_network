<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="">Ci4 Login</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item" {{--{{ Route::currentRouteNamed('') ? 'active' : '' }}--}}>
                    <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item {{ Route::currentRouteNamed('userProfile') ? 'active' : '' }}">
                    <a class="nav-link" href="/user-profile">Profile</a>
                </li>
            </ul>
            <form action="/logout" method="post" class="navbar-nav my-2 my-lg-0">
                @csrf
                <input type="submit" value="logout" class="nav-item">
            </form>
        </div>
    </div>
</nav>
