<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('dashboard')}}">LiteNote</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('dashboard')}}">Notlarım</a>
            </li>
            @hasrole('admin')
                <li class="nav-item {{request()->routeIs('admin.index')?'active':''}}">
                    <a class="nav-link" href="{{route('admin.index')}}">Kullanıcılar</a>
                </li>
            @endhasrole
        </ul>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{\Illuminate\Support\Facades\Auth::user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
    </div>
</nav>
