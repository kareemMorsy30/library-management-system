@extends('layouts.librarylayout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('errors'))
    <div class="alert alert-danger">
        {{ session()->get('errors') }}
    </div>
@endif
<div class="showCards">
    @foreach ( $books as $book )
    <div class="flex-card card">
    <a href="{{ route('bookrate', $book->id) }}">
            <div>
                <img src="{{url('uploads/'.$book->pic)}}" />
            </div>
    </a>

    <div class="card-body">
        <div>
            @foreach ($rates as $rate)
            @if($book->id === $rate->book_id)
                @for($i =1 ; $i<=5 ; $i++)
                    @if($i<=round($rate->avg))
                        <img class="rank" src="/rank.png">
                    @else
                        <img class="rank" src="/rankicon.png">
                    @endif
                 @endfor
            @endif    
            @endforeach
        </div>
        <p class="card-title">{{ $book->title }}</p>
        <p class="card-text">{{ $book->description }}</p>
        @if($book->quantity <= 0) <button class="btn btn-danger btn-sm" style="border-radius: 15px;" disabled>no copies
            available</button>
            @else
            <span>{{ $book->quantity }} copies available</span>
            @endif

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
    </div><br>
    <div class="card-footer">
        <button id="lease" data-toggle="modal" data-title="{{$book->title}}" data-book_id="{{$book->id}}"
            data-target="#borrow-model" class="btn btn-success btn-sm btn-block lease"
            {{ ($book->quantity <= 0 || !$book->canBorrow)?"disabled":"" }}>Lease</button>
    </div>
</div>

@endforeach

</div>
<div style="margin-top: 20px; margin-left: 380px;">{{ $books->links() }}</div>
<script src="{{asset('js/library_home.js')}}"> </script>
@endsection

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

