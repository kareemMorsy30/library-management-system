<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/dist/css/skins/skin-blue.css">

<link rel="stylesheet" type="text/css" href="/dist/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="/dist/css/add-user-style.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/sc-1.4.4/sl-1.2.5/datatables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.24.1/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.11/css/perfect-scrollbar.min.css">

    <link href="{{ asset('/admin/css/admin-app.css') }}" rel="stylesheet">
    @yield('links')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini" style="overflow-y: hidden;">
<div style="background-color: #ecf0f1; height:100%;width:device-width; overflow-y: scroll;">

  <!-- Main Header -->
  <header class="main-header">

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
<div>
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          @if(empty(Auth::user()->picture))
          <img src="/dist/img/user-placeholder.d2a3ff8.png" class="user-image" alt="User Image">
          @else
          <img src="/uploads/images/{{Auth::user()->picture}}" class="user-image" alt="User Image">
          @endif
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{Auth::user()->username}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            @if(empty(Auth::user()->picture))
              <img src="/dist/img/user-placeholder.d2a3ff8.png" class="img-circle" alt="User Image">
            @else
              <img src="/uploads/images/{{Auth::user()->picture}}" class="img-circle" alt="User Image">
            @endif
            <p>
              {{Auth::user()->username}} - {{Auth::user()->privilege}}
              <small>Member since {{date("M. Y",strtotime(Auth::user()->created_at))}}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="/admin/profile" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
</nav>
</header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
        @if(empty(Auth::user()->picture))
          <img src="/dist/img/user-placeholder.d2a3ff8.png" class="img-circle" alt="User Image">
        @else
          <img src="/uploads/images/{{Auth::user()->picture}}" class="img-circle" alt="User Image">
        @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button style="margin-top:0px;" type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
<!--        <li class="header">HEADER</li>-->
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="/dashboard/home"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/all-users">All Users</a></li>
            <li><a href="/admin/add_user">Add New User</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Books</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/category') }}">Categories</a></li>
            <li><a href="{{ url('/admin/allbooks') }}">All Books</a></li>
            <li><a href="{{ url('/admin/addbook') }}">Add Book</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="container">
    @yield('content')
  </div>


  <!-- Main Footer -->
  <footer class="main-footer" style="margin-top:0px;">
    <!-- To the right -->
<!--
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
-->
    <!-- Default to the left -->
    <strong>All rights reseved &copy; 2017 <br> Powered By <a href="http://www.iti.gov.eg/">ITI</a>.</strong>
  </footer>
</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="{{asset('/admin/js/profilePage.js')}}"></script>

<!-- jQuery 3 -->
<script src="/dist/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script defer src="/dist/DataTables/datatables.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>

<script src="/dist/js/add-user.js"></script>
@yield('scripts')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>