@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container">
           <div id="flex">
 
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection  