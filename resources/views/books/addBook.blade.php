@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="app-content content container-fluid">
<div class="content-wrapper">
    <div class="content-header row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Book
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <div class="container">
            
            {!! Form::open(['route'=>['addbook.store'],'method'=>'post','files'=>'true']) !!}
                <table>
                    <tr>
                        <th><label>Book Title <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::text('title'); !!}</td>
                    </tr>
                    <tr>@if ($errors->has('title'))<td>{{ $errors->first('title') }}</td> @endif</tr>
                    <tr>
                        <th><label>Author <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::text('author'); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('author') }} </td>@endif</tr>
                    <tr>
                        <th><label>description</label></th>
                        <td><textarea name="description" rows="3" cols="55"></textarea></td>
                    </tr>
                        <tr>@if ($errors->any())<td>{{ $errors->first('description') }} </td>@endif</tr>
                    
                    <tr>
                        <th><label>Quantity<small> (<em>required</em>)</small></label></th>
                        <td>{!! Form::number('quantity' ,'',['min' => '0']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('quantity') }} </td>@endif</tr>

                    <tr>
                        <th><label>Price <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::number('price','',['min' => '0','step' =>'0.01']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('price') }} </td>@endif</tr>

                    <tr>
                        <th><label>Category</label></th>
                        <td>{!! Form::select('category',$category, null,['placeholder' => 'Pick a category...'],['class' => 'form-control']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('category') }} </td>@endif</tr>
                    <tr>
                        <th><label>Book Picture</label></th>
                        <td>{!! Form::file('pic'); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('pic') }} </td>@endif</tr>

                </table>
                {!! Form::submit('Add Book!'); !!}

                {!! Form::close() !!}
        </div> 
                

    </section>
    <!-- /.content -->
    </div>

    </div>
  </div>
</div>

</div>
  <!-- /.content-wrapper -->

@endsection  