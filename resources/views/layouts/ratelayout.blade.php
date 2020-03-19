<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dist/css/ratestyle.css">
  <link rel="stylesheet" href="/dist/css/ratingtoggle.css">
  <title>Maktabty</title>
</head>
<body>
  <div class="container-fullwidth">
      <nav class="navbar navbar-expand-lg">
        <span class="navbar-brand" sty>Maktabty</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{ url('/library/home') }}" id="allbooks" class="btn btn-outline-primary btn-sm">All Books</a>
            </li>
            <li class="nav-item active">
              <a href="{{route('borrows.index')}}" id="myBooks" class="btn btn-outline-primary btn-sm">My Books</a>
            </li>
            <li class="nav-item">
              <a href="/Favourite" id="favourites" class="btn btn-outline-primary btn-sm">Favourites</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
            @if(Auth::check())
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->username }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/user/profile">Profile</a>
                @if(Auth::user()->privilege == 'admin' || Auth::user()->privilege == 'manager')
                  <a class="dropdown-item" href="/dashboard/home">Dashboard</a>
                @endif
              <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
              </div>
            @elseif(Auth::guest())
              <a href="/log-in" class="btn btn-outline-primary btn-sm loginBtn" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Login
              </a>
            @endif
            </li>
          </ul>
        </div>
  </div>
  <div>
    @yield('content')
  </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>