@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="app-content content container-fluid">
<div class="content-wrapper">
    <div class="content-header row">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit User
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
                <form action="{{ route('update_user',$user->id) }}" method="POST">
                    {{method_field('PUT')}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <table>
                        <tr>
                            <th><label>Username <small>(<em>required</em>)</small></label></th>
                            <td><input type="text" name="username" value="{{ $user->username }}" ></td>
                        </tr>
                        <tr>
                            <th><label>Email <small>(<em>required</em>)</small></label></th>
                            <td><input type="text" name="email" value="{{ $user->email }}" required></td>
                        </tr>
                        <tr>
                            <th><label>Name</label></th>
                            <td><input type="text" value="{{ $user->name }}" name="name"></td>
                        </tr>
                        <tr>
                            <th><label>Address</label></th>
                            <td><input type="text" value="{{ $user->address }}" name="address"></td>
                        </tr>
                        <tr>
                            <th><label>Phone</label></th>
                            <td><input type="text" value="{{ $user->phone }}" name="phone"></td>
                        </tr>
                        <tr>
                            <th><label>Password <small>(<em>required</em>)</small></label></th>
                            <td><input id="password" onkeyup="passwordOneCheck();" type="password" name="password" ></td>
                        </tr>
                        <tr>
                            <th><label>Repeat Password <small>(<em>required</em>)</small></label></th>
                            <td>
                                <input id="rep-password" onkeyup="passwordCheck();" type="password" name="password_confirmation" >
                                <div id="message"></div>
                            </td>
                        </tr>
                       {{-- <tr>
                            <th>Privilege</th>
                            <td>
                                <input type="radio" id="user" name="privilege" value="user" @if ($user->privilege == 'user'){{ 'checked' }}@endif>
                                <label for="user">User</label><br>
                                <input type="radio" id="manager" name="privilege" value="manager" @if ($user->privilege == 'manager'){{ 'checked' }}@endif>
                                <label for="manager">Manager</label><br>
                            </td>
                        </tr>--}}
                        <tr>
                            <th><label>Send Password?</label></th>
                            <td><label class="check"><input class="checkb" type="checkbox" name="send-password" value="send">
                                    Send this password to the new user by email.
                                </label></td>
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