@extends('layouts.ratelayout')

@section('content')
<div class="row">
  <div class="flex-card card">
    <div>
       <img src="{{url('uploads/'.$book->pic)}}"/>
    </div>
  </div>
    <div class="card-body">
    <button type="submit" class="btn btn-success btn-sm" id="wishListButton" name="wishListButton" value="Add to wish list">
    <i class="fa fa-shopping-cart"></i>
    Add To wish List
</button>
    
      @if(in_array($book->id,$favourites))
            <form action="{{route('removeFav')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value={{$book->id}}>
                <input type="image" id="heart" src="/coloredheart.png" />
            </form>
            @else
            <form action="{{route('Favourite.store')}}" method="POST">
                @csrf
                <input type="image" id="heart" src="/heart.png" />
                <input type="hidden" name="id" value={{$book->id}}>
            </form>
            @endif
               <p class="card-title title">Book Title</p>
        
    <p class="card-title title">{{ $book->title }}</p>
        <div >
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
        </div>
        <p class="card-text col-md-6">{{$book->description }}</p>
        @if($book->quantity <= 0)
        <button class="btn btn-danger btn-sm" style="border-radius: 15px;margin-bottom: 20px" disabled>no copies available</button>
    @else
        <span style="margin-bottom: 20px">{{ $book->quantity }} copies available</span>
    @endif
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

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

<div class="row">
  @foreach ($book->rate as $commenttext)
  @foreach ($book->rate as $comment)
  @if($comment->id ===$commenttext->pivot->user_id )
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
            {{ $commenttext->pivot->comment }} 
          </td>
          <td>
{{------------------------------------  edit section   -----------------------------------------}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{-- form --}}
{!! Form::open(['route'=>['rate.update',$book->id],'method'=>'put' , 'id' =>'hiddenform']) !!}
      {{ Form::hidden('hiddenrate', 0) }}
      <div class="ratestar">
        <span class="ranks">☆</span>
        <span class="ranks">☆</span>
        <span class="ranks">☆</span>
        <span class="ranks">☆</span>
        <span class="ranks">☆</span>
        </div>
        <textarea name="newcomment" class="form-control" rows="3" placeholder="Your Comment..."></textarea>
        {!! Form::close() !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="hiddenform" >Save changes</button>
      </div>
    </div>
  </div>
</div>        







{{---------------------------------------------------------------------------------------------}}

            {!! Form::open(['route'=>['delete_rate',$book->id],'method'=>'delete', 'class'=>' button']) !!}
            {!! Form::submit('delete',['class' =>'btn btn-danger']); !!}
            {!! Form::close() !!}
          </td>
          </tr>
        </tbody>
      </table>
        @endif
      @endforeach 
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
<script src="{{ asset('/dist/js/rate.js') }}"></script>


@endsection