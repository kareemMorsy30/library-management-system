@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container">  
           <div id="flex">
 
            @foreach ( $books as $book )
            <div class="flex-card">
                <div>
                    <img src= {{url('uploads/'.$book->pic)}} />
                </div>
                <div class="title">{{ $book->title }}</div>
                <div class="text"><b>Author </b>: {{ $book->author }}</div>
                <div><b>Category</b> : {{ $book->category->name }}</div>
                <div class="text"><b>Description</b> : {{ $book->description }}</div>
                <div class="text"><b>Price</b> : {{ $book->price }} ,  <b>Qty</b> : {{ $book->quantity }}</div>
                <div>
                    <button type="submit" class="btn btn-fefault cart" id="wishListButton" name="wishListButton" value="Add to wish list">
                        <i class="fa fa-shopping-cart"></i>
                        Add To wish List
                    </button>
                </div>
                <div>
                    {!! Form::open(['route'=>['addbook.edit',$book->id],'method'=>'get' , 'class'=>'button']) !!}
                    {!! Form::submit('Edit'); !!}
                    {!! Form::close() !!}

                    {!! Form::open(['route'=>['addbook.destroy',$book->id],'method'=>'delete', 'class'=>'button']) !!}
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