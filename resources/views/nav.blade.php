<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('books') }}">Library</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @can('manageFavs')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('getfavourites') }}">My books</a>
                </li>
            @endcan
            @can('add')
                <li class="nav-item ml-5">
                    <a class="nav-link" href="{{ route('addbook') }}">Add book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addauthor') }}">Add author</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addgenre') }}">Add genre</a>
                </li>
            @endcan
            @can('exportbooks')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('exportbooks') }}">Export books</a>
                </li>
            @endcan
        </ul>
        <ul class="navbar-nav ml-auto">
            @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('myaccount') }}">Hello, {{ Auth::user()->name }}!</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
