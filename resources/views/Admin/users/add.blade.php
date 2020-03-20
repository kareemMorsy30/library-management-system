@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="app-content content container-fluid">
    <div class="content-wrapper">
    <div class="content-header row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container">
        <form action="{{ route('add_new_user') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <table>
                    <tr>
                        <th><label>Username <small>(<em>required</em>)</small></label></th>
                        <td><input type="text" name="username" value="{{ old('username') }}" required></td>
                    </tr>
                    <tr>
                        <th><label>Email <small>(<em>required</em>)</small></label></th>
                        <td><input type="email" name="email" value="{{ old('email') }}" required></td>
                    </tr>
                    <tr>
                        <th><label>Name</label></th>
                        <td><input type="text" name="name" value="{{ old('name') }}"></td>
                    </tr>
                    <tr>
                        <th><label>Address</label></th>
                        <td><input type="text" name="address" value="{{ old('address') }}"></td>
                    </tr>
                    <tr>
                        <th><label>Phone</label></th>
                        <td><input type="text" name="phone" value="{{ old('phone') }}" required></td>
                    </tr>
                    <tr>
                        <th><label>Password <small>(<em>required</em>)</small></label></th>
                        <td><input id="password" onkeyup="passwordOneCheck();" type="password" name="password" value="{{ old('password') }}" required></td>
                    </tr>
                    <tr>
                        <th><label>Repeat Password <small>(<em>required</em>)</small></label></th>
                        <td>
                            <input id="rep-password" onkeyup="passwordCheck();" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                            <div id="message"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Privilege</th>
                        <td>
                        @if(!empty(old('privilege')))
                            <input type="radio" id="user" name="privilege" value="user" @if(old('privilege') == 'user') checked @endif>
                            <label for="user">User</label><br>
                            <input type="radio" id="manager" name="privilege" value="manager" @if(old('privilege') == 'manager') checked @endif>
                            <label for="manager">Manager</label><br>
                        @else
                            <input type="radio" id="user" name="privilege" value="user" checked>
                            <label for="user">User</label><br>
                            <input type="radio" id="manager" name="privilege" value="manager">
                            <label for="manager">Manager</label><br>
                        @endif

                        </td>
                    </tr>
                </table>
                <button class="submit" type="submit" >Submit</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
</div>
</div>
  <!-- /.content-wrapper -->

@endsection  