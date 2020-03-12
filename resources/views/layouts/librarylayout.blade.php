<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dist/css/librarystyle.css">
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
            <li class="nav-item active">
              <a href="#" id="myBooks" class="btn btn-outline-primary btn-sm">My Books</a>
            </li>
            <li class="nav-item">
              <a href="#" id="favourites" class="btn btn-outline-primary btn-sm">Favourites</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav> 
      <div class="row">
        <div class="col-md-4">
            <input id="formStyle" class="form-control" type="search" placeholder="Search by name or auther" aria-label="Search">
            {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
        </div>
      <div class="orderBy">
        <label for="Order by">Order by: </label>
        <div class="btn-group">
          <button class="btn btn-primary btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Choose
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Rate</a>
            <a class="dropdown-item" href="#">Latest</a>
          </div>
        </div>
      </div>
      </div>
      <div class="row" id="line"></div>
    <div class="row">
      <div class="card links col-md-3">
        <a href="#">Art</a>
        <a href="#">Music</a>
        <a href="#">Kids</a>
        <a href="#">Business</a>
        <a href="#">Computers</a>
      </div>
      <div>@yield('content')</div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>