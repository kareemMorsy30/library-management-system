@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
            <form>
                <table>
                    <tr>
                        <th><label>Username <small>(<em>required</em>)</small></label></th>
                        <td><input type="text" name="username" required></td>
                    </tr>
                    <tr>
                        <th><label>Email <small>(<em>required</em>)</small></label></th>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <th><label>First Name</label></th>
                        <td><input type="text" name="first-name"></td>
                    </tr>
                    <tr>
                        <th><label>Last Name</label></th>
                        <td><input type="text" name="last-name"></td>
                    </tr>
                    <tr>
                        <th><label>Password <small>(<em>required</em>)</small></label></th>
                        <td><input id="password" onkeyup="passwordOneCheck();" type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <th><label>Repeat Password <small>(<em>required</em>)</small></label></th>
                        <td>
                            <input id="rep-password" onkeyup="passwordCheck();" type="password" name="rep-password" required>
                            <div id="message"></div>
                        </td>
                    </tr>
                    <tr>
                        <th><label>Send Password?</label></th>
                        <td><label class="check"><input class="checkb" type="checkbox" name="send-password" value="send">
                            Send this password to the new user by email.
                        </label></td>
                    </tr>
                </table>
                <input class="submit" type="submit" value="Submit">
            </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection  