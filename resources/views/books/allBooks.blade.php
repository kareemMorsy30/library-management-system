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
            
            

            <div id="flex">
            @foreach ( $books as $book )
            <div class="flex-card">

                <div>
                    <img src= {{url('uploads/'.$book->pic)}} />
                </div>
                <div class="title">{{ $book->title }}</div>
                <div class="text">Author : {{ $book->author }}</div>
                <div>Category : {{ $book->category->name ?? 'N/A'}}</div>
                <div class="text">Description : {{ $book->description }}</div>
                <div class="text">Price : {{ $book->price }} , Qty : {{ $book->quantity }}</div>
                <div>
                    {!! Form::open(['route'=>['addbook.edit',$book->id],'method'=>'get','class' => 'foo']) !!}
                    {!! Form::submit('Edit',['class'=>'btnfoo']); !!}
                    {!! Form::close() !!}

                    {!! Form::open(['route'=>['addbook.destroy',$book->id],'method'=>'delete','class' => 'foo'] ) !!}
                    {!! Form::submit('delete',['class'=>'btnfoo']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
            @endforeach
            </div>
      </div>
   </div>
</div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection  