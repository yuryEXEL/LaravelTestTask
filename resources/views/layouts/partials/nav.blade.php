<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if (Request::path() == '/')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usersManager.index') }}">User Manager</a>
                </li
            @endif
            @if (Request::path() == 'usersManager')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">User List</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
