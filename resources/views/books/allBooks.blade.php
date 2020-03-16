@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <div class="app-content content container-fluid">
    <div class="content-wrapper">
    <div class="content-header row">
           <!-- <button type="submit" class="btn btn-fefault cart" id="wishListButton" name="wishListButton" value="Add to wish list">
    <i class="fa fa-shopping-cart"></i>
    Add To wish List
</button> -->
            @if(count($books) == 0)
            <div class="alert alert-warning" style="display:flex">
                No books Added
                <a href="/admin/addbook" class="btn btn-success cart" id="wishListButton" name="wishListButton" value="Add to wish list" style="margin-left: 40rem">
                    <i class="fa fa-book"></i>
                    Add new book
                </a>
            </div>
            
            @endif
            @foreach ( $books as $book )
            <div class="flex-card">
                <div class="title">{{ $book->title }}</div>
                <div>
                    <img src= {{url('uploads/'.$book->pic)}} />
                </div>
                <div class="text">Author : {{ $book->author }}</div>
                <div>Category : {{ $book->category->name }}</div>
                <div class="text">Description : {{ $book->description }}</div>
                <div class="text">Price : {{ $book->price }} , Qty : {{ $book->quantity }}</div>
                <div>
                    {!! Form::open(['route'=>['addbook.edit',$book->id],'method'=>'get']) !!}
                    {!! Form::submit('Edit'); !!}
                    {!! Form::close() !!}

                    {!! Form::open(['route'=>['addbook.destroy',$book->id],'method'=>'delete']) !!}
                    {!! Form::submit('delete'); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
            @endforeach
           </div>
        </div>
</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection  