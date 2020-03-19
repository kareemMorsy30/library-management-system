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
                            <td><input type="email" name="email" value="{{ $user->email }}" ></td>
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