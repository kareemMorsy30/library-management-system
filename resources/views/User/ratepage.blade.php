@extends('layouts.ratelayout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class="row">
  <div class="flex-card card">
    <div>
       <img src="{{url('uploads/'.$book->pic)}}"/>
    </div>
  </div>
    <div class="card-body">
       
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

    <p class="card-title title">{{ $book->title }}</p>
        <div >
          @for($i =1 ; $i<=5 ; $i++)
          @if($i<=$rate)
          <img class="rank" src="/rank.png">
          @else
          <img class="rank" src="/rankicon.png">
          @endif
          @endfor
        </div>
        <p class="card-text col-md-6">{{ $book->description }}</p>
        @if($book->quantity <= 0)
        <button class="btn btn-danger btn-sm" style="border-radius: 15px;margin-bottom: 20px" disabled>no copies available</button>
    @else
        <span style="margin-bottom: 20px">{{ $book->quantity }} copies available</span>
    @endif
        <button id="lease" data-toggle="modal" data-title="{{$book->title}}" data-book_id="{{$book->id}}"
        data-target="#borrow-model" class="btn btn-success btn-sm btn-block lease"
        {{ ($book->quantity <= 0 || !$book->canBorrow)?"disabled":"" }}>Lease</button>
    </div>
</div>

<div class="row">
    <div class="form-group comment">
        <textarea name="comment" class="form-control" rows="4" cols="110" placeholder="Your Comment..." form="form"></textarea>
        <a class="btn btn-primary btn-sm btn-block">{!! Form::submit('Comment',['form'=>'form','class' => 'btn btn-primary']); !!}</a>
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
            @for($i=0; $i<3; $i++)
              <span class="icon">★</span>
            @endfor
        </label>
        <label>
          {!! Form::radio('rate', '4') !!}
            @for($i=0; $i<4; $i++)
              <span class="icon">★</span>
            @endfor
        </label>
        <label>
          {!! Form::radio('rate', '5') !!}
            @for($i=0; $i<5 ; $i++)
              <span class="icon">★</span>
            @endfor
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
  @foreach ($book->rate as $comment)
    <table class="table">
        <thead>
          <tr>
          <th scope="col" colspan="2">
            {{ $comment->name }}<br>
            <i><small>{{ date('d M Y  H:i:s', strtotime($comment->pivot->created_at)) }}</small></i>
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
            {{ $comment->pivot->comment?? '.....' }} 
          </td>
<td>
  @if($comment->pivot->user_id === $user)
  <div id="form-container">
{{------------------------------------  edit section   -----------------------------------------}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" 
data-id="{{ $comment->pivot->id }}" data-comment="{{$comment->pivot->comment}}">
  Edit
</button>

{{---------------------------------------------------------------------------------------------}}
            {!! Form::open(['route'=>['delete_rate',$book->id, $comment->pivot->id],'method'=>'delete', 'class'=>' button']) !!}
            {!! Form::submit('delete',['class' =>'btn btn-danger']); !!}
            {!! Form::close() !!}
  </div>
  @endif 
</td>
        
          </tr>
        </tbody>
      </table>
  @endforeach
</div>



{{------------------------------------ related books  -----------------------------------------}} 
<div class="row related">
    <p class="title">Related Books</p>
</div>
<div class="row">
  @foreach ($relatedBooks as $Rbook)
  @if($Rbook->id === $book->id)
    @continue
  @else
  <div class="flex-card card">
    <a href="{{ route('bookrate', $Rbook->id) }}">
    <div>
        <img src="{{url('uploads/'.$Rbook->pic)}}"/>
    </div>
    </a>
    <div class="card-body">
    <p class="card-title title"><b>{{ $Rbook->title }}</b></p>
      <span>
        @if($Rbook->quantity <= 0)
        <button class="btn btn-danger btn-sm" style="border-radius: 15px;margin-bottom: 20px" disabled>no copies available</button>
    @else
        <span style="margin-bottom: 10px">{{ $Rbook->quantity }} copies available</span>
    @endif
      </span>
    </div>
  </div>
  @endif
  @endforeach
</div>
<script src="{{ asset('/dist/js/rate.js') }}"></script>
<script src="{{asset('js/library_home.js')}}"> </script>
@endsection

{{--borrow model--}}
<div class="modal fade" id="borrow-model"
     tabindex="-1" role="dialog"
     aria-labelledby="borrowModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex flex-row align-self-start">
                <button type="button" class="close mr-1"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="borrowModalLabel"></h4>
            </div>
            <form method="post" action="{{ route('borrows.store') }}">
                @csrf
                <input name="book_id" id="book_id" hidden/>
                <div class="modal-body">
                    <p>
                        Please confirm you would like to borrow
                        <b><span id="book-title"></span></b>
                        for <input name="numberOfDays" type="number" class="w-25 d-inline" min="1" value="1"/> days
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">Close</button>
                    <span class="pull-right">
          <button type="submit" class="btn btn-success">
            Borrow
          </button>
        </span>
                </div>
            </form>
        </div>
    </div>
</div>
{{------------------------------------------------------------------------------------------}}

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
      {{ Form::hidden('hiddenrate') }}
      {{ Form::hidden('rateId','',['id'=>'rateId']) }}
      <div class="ratestar">
        @for($i=0; $i<5 ; $i++)
        <span class="ranks">☆</span>
        @endfor
        </div>
      <textarea name="comment" class="form-control" rows="3" id="comment"></textarea>
        {!! Form::close() !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="hiddenform" >Save changes</button>
      </div>
    </div>
  </div>
</div>  
