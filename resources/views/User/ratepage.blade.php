@extends('layouts.ratelayout')

@section('content')
<div class="row">
    <div class="card">
      <div class="card-header">
         <img src="{{url('uploads/'.$book->pic)}}" width="100%" height="90%"/>
      </div>
    </div>
    <div class="card-body">
      <a><img src="/heart.png" id="heart"></a>
    <p class="card-title title">{{ $book->title }}</p>
        <div >
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
        </div>
        <p class="card-text col-md-6">{{$book->description }}</p>
        <span>{{ $book->quantity }} copies available</span>
        <a id="lease" class="btn btn-success btn-sm" href="#">Lease</a> 
    </div>
</div>

<div class="row">
    <div class="form-group comment">
        <textarea name="comment" class="form-control" rows="4" cols="110" placeholder="Your Comment..." form="form"></textarea>
        <a class="btn btn-primary btn-sm btn-block" href="#">{!! Form::submit('Comment',['form'=>'form','class' => 'btn btn-primary']); !!}</a>
    </div>
    
    <div class="rankwithcomment">
      {!! Form::open(['route'=>['bookRstore'],'method'=>'post', 'class' => 'rating' , 'id' =>'form']) !!}
      {{ Form::hidden('id', $book->id) }}
        <label>
          {!! Form::radio('rate', '1') !!}
          <span class="icon">★</span>
        </label>
        <label>
          {!! Form::radio('rate', '2') !!}
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        <label>
          {!! Form::radio('rate', '3') !!}
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>   
        </label>
        <label>
          {!! Form::radio('rate', '4') !!}
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        <label>
          {!! Form::radio('rate', '5') !!}
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        {!! Form::close() !!}
        </div>
      </div>
    </div>  
</div>
<div>
@if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
  @endif
</div>

<div class="row">
  @foreach ($book->rate as $comment)
    <table class="table">
        <thead>
          <tr>
          <th scope="col" colspan="2">
            {{ $comment->name }}<br>
            <i><small>{{ $comment->pivot->created_at }}</small></i>
            <span id="stars-container">
              @php
              $counter = 5 
              @endphp
              @for($i=1 ; $i<= $comment->pivot->rate ; $i++ )
                <span class="star" style="color:gold;">★</span>
                @php 
                $counter--; 
                if($counter<0) $counter=0;
                @endphp
              @endfor
              @for($i=1 ; $i<=$counter ; $i++ )
                <span class="star">★</span>
              @endfor             
            </span>
          </th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td> 
            {{ $comment->rates[0]->pivot->comment }} 
          </td>
          <td>
            {!! Form::open(['route'=>['edit_rate',$book->id],'method'=>'get' , 'class'=>'button']) !!}
            {!! Form::submit('Edit'); !!}
            {!! Form::close() !!}
   
            {!! Form::open(['route'=>['delete_rate',$book->id],'method'=>'delete', 'class'=>'button']) !!}
            {!! Form::submit('delete'); !!}
            {!! Form::close() !!}
          </td>
          </tr>
        </tbody>
      </table>
      @endforeach
</div>

<div class="row related">
    <p class="title">Related Books</p>
</div>
<div class="row">
  <div class="card">
    <div class="card-header">
        picture
    </div>
    <div class="card-body">
      <p class="card-title title">Book Title</p>
      <span>2 copies available</span>
    </div>
  </div>
</div>
@endsection