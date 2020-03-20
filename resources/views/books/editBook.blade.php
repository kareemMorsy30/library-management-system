@extends('layouts.app')

@section('content')

<div class="app-content content container-fluid">
    <div class="content-wrapper">
    <div class="content-header row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Book Data
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
            
            {!! Form::open(['route'=>['addbook.update',$book->id],'method'=>'put','files'=>'true']) !!}
                <table>
                    <tr>
                        <th><label>Book Title <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::text('title' , $book->title); !!}</td>
                    </tr>
                    <tr>@if ($errors->has('title'))<td>{{ $errors->first('title') }}</td> @endif</tr>

                    <tr>
                        <th><label>Author <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::text('author', $book->author); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('author') }} </td>@endif</tr>

                    <tr>
                        <th><label>description</label></th>
                    <td><textarea name="description" rows="3" cols="55"> {{ $book->description }}</textarea></td>
                    </tr>
                        <tr>@if ($errors->any())<td>{{ $errors->first('description') }} </td>@endif</tr>
                    
                    <tr>
                        <th><label>Quantity<small> (<em>required</em>)</small></label></th>
                        <td>{!! Form::number('quantity' ,$book->quantity,['min' => '0']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('quantity') }} </td>@endif</tr>

                    <tr>
                        <th><label>Price <small>(<em>required</em>)</small></label></th>
                        <td>{!! Form::number('price',$book->price,['min' => '0','step' =>'0.01']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('price') }} </td>@endif</tr>

                    <tr>
                        <th><label>Category</label></th>
                        <td>{!! Form::select('category',$category,$book->category->name,['class' => 'form-control']); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('category') }} </td>@endif</tr>
                    <tr>
                        <th><label>Book Picture</label></th>
                        <td>{!! Form::file('pic'); !!}</td>
                    </tr>
                    <tr>@if ($errors->any())<td>{{ $errors->first('pic') }} </td>@endif</tr>

                </table>
                {!! Form::submit('Edit Book!'); !!}

                {!! Form::close() !!}
        </div> 
                

    </section>
    <!-- /.content -->
    </div>

    </div>
  </div>
  <!-- /.content-wrapper -->

@endsection  