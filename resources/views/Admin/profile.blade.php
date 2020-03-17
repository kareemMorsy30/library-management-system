@extends('layouts.app')

@section('links')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>
<style>
    .img-thumbnail:hover {
        cursor: pointer;
    }
</style>

@endsection

@section('content')

<!-- START MAIN CONTENT -->
                
                
<div class="app-content content container-fluid">
    <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title">Profile</h2>
            <p>This board give you easy way to Edit your profile</p>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/profile">Profile</a></li>
                    </ol>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="container">


            <div class="row">


                <div class="col-md-12">


                    <div class="profile-top">

                        <div class="profile-img">
                            @if(empty(Auth::user()->picture))
                            <img src="{{asset('/dist/img/user-placeholder.d2a3ff8.png')}}" alt="avatar" style="width: 6rem">
                            @else
                            <img src="/uploads/images/{{Auth::user()->picture}}" alt="avatar">
                            @endif

                        </div>

                        <div class="profile-info">

                            <h5>{{Auth::user()->username}}</h5>

                            <p>{{Auth::user()->email}}</p>

                            @if(Auth::user()->admin == 1)
                            <p>Super Admin</p>
                            @endif

                        </div>

                    </div>


                </div>


                <div class="col-md-12">

                    <!-- Nav tabs -->
                    <ul id="profile-tabs" class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#account" role="tab">Account</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photo" role="tab">Photo</a>
                            </li>
                    </ul>

                </div>

                <div class="col-md-12">

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="account" role="tabpanel">


                                <div class="tabs-content-container">




                                <div class="tabs-content-header">
    
                                    <h4>My Account</h4>
                                    <p>Add information about yourself to share on your profile.</p>
    
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                <form id="editAdminAccountForm" method="POST" action="{{Route('update_admin_profile')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="adminAccountName">Admin Name</label>
                                            <input type="text" class="form-control" id="adminAccountName" @if(old('username')) value="{{old('username')}}" @else value="{{Auth::user()->username}}" @endif name="username" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="adminAccountEmail">Email</label>
    
    
                                            <div class="email-change-container">
    
                                                <input type="email" class="form-control" id="adminAccountEmail" placeholder="Email" value="{{Auth::user()->email}}" name="adminAccountEmail"
                                                    readonly>
    
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#editEmailModal">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                </span>
    
                                            </div>
    
                                        </div>
    
                                        <div class="form-group">
                                            <label for="adminAccountCurrentPassword">Current Password</label>
                                            <input type="password" class="form-control" id="adminAccountCurrentPassword" placeholder="Current Password" name="adminAccountCurrentPassword" value="{{old('adminAccountCurrentPassword')}}">
                                            <div id="msgs"></div>
                                        </div>
    
    
                                        <div class="form-group">
    
                                            <label for="adminAccountNewPassword">New Password</label>
                                            <input type="password" class="form-control" id="adminAccountNewPassword" placeholder="New Password" name="adminAccountNewPassword" value="{{old('adminAccountNewPassword')}}">
    
                                        </div>
    
    
                                        <div class="form-group">
                                            <label for="adminAccountConfirmPassword">Confirm Password</label>
                                            <input type="password" class="form-control" id="adminAccountConfirmPassword" placeholder="Confirm Password" name="password" value="{{old('adminAccountConfirmPassword')}}">
                                        </div>
    
                                        <div class="form-submit">
    
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save Change</button>
    
                                            <div class="ajax-loading loader loader--style2" title="1">
                                                <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;"
                                                    xml:space="preserve">
                                                    <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                                                        <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"
                                                        />
                                                    </path>
                                                </svg>
                                            </div>
    
    
                                        </div>
    
    
                                    </form>

                                </div>
                        </div>
                        <div class="tab-pane" id="photo" role="tabpanel">



                            <div class="tabs-content-container">



                                <div class="tabs-content-header">
    
                                    <h4>My Photo</h4>
                                    <p>Add a nice photo of yourself for your profile.</p>
    
                                </div>
    
                            <form action="/update-email" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <section id="image-upload-container">
                                    <div class="text-center">
                                        <label for="file-input">
                                            @if(empty(Auth::user()->picture))
                                            <img src="/dist/img/user-placeholder.d2a3ff8.png" alt="..." class="img-thumbnail">
                                            @else
                                            <img src="/uploads/images/{{Auth::user()->picture}}" alt="..." class="img-thumbnail">
                                            @endif
                                        </label>
                                        @if(empty(Auth::user()->picture))
                                            <input id="file-input" type="file" name="photo" class="dropify" data-height="400" data-max-file-size="2M" data-min-width="200"
                                            data-max-width="6000" data-min-height="200" data-max-height="1000" data-show-remove="false"
                                            data-errors-position="outside" data-allowed-file-extensions="jpg jpeg png" data-max-file-size-preview="2M" style="display: none" required
                                            />
                                        @else
                                            <input id="file-input" type="file" name="photo" class="dropify" data-default-file="/image/{{Auth::user()->picture}}" data-height="400" data-max-file-size="2M" data-min-width="200"
                                            data-max-width="6000" data-min-height="200" data-max-height="1000" data-show-remove="false"
                                            data-errors-position="outside" data-allowed-file-extensions="jpg jpeg png" data-max-file-size-preview="2M" style="display: none" required
                                            />
                                        @endif
                                    </div>
                                </section>
                                <div class="save_profile_photo">

                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Save Photo</button>

                                </div>

                            </form>
    
                            </div>
    
    

                        </div>
                    </div>

                </div>


            </div>


        </div>


    </div>
</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


<!-- END MAIN CONTENT -->



    <!-- Edit Email Modal -->

<div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">Change Your Email</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">
    <i class="fas fa-times"></i>
</span>
</button>
</div>
<div class="modal-body">
<form id="adminChangeEmailForm" method="POST" action="{{Route('update_admin_email')}}">
    @csrf
<div class="form-group">
    <label for="adminChangeEmailNew">Email</label>
    <input type="email" class="form-control" id="adminChangeEmailNew" name="adminChangeEmailNew" ria-describedby="changeEmailNew" placeholder="Change Email" required>
</div>
<div class="form-group">
    <label for="adminChangeEmailPassword">Password</label>
    <input type="password" class="form-control" id="adminChangeEmailPassword" name="adminChangeEmailPassword" placeholder="Password" required>
    <div id="email"></div>
</div>



<div class="form-submit">

    <button type="submit" class="btn btn-primary btn-lg btn-block">Change Email</button>

    <div class="ajax-loading loader loader--style2" title="1">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"
                />
            </path>
        </svg>
    </div>


</div>




</form>
</div>
</div>
</div>
</div>

<!-- Edit Email Modal -->

@endsection  