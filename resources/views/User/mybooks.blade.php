@extends('layouts.librarylayout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class="showCards">
        @foreach ( $books as $book )
            <a href="{{ route('bookrate', $book->id) }}">
                <div class="flex-card card">
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
            {{--<div class="card-footer">
                <button id="lease" data-toggle="modal" data-title="{{$book->title}}" data-book_id="{{$book->id}}"
                        data-target="#borrow-model" class="btn btn-success btn-sm btn-block lease"
                        {{ $book->quantity <= 0?"disabled":"" }}>Lease</button>
            </div>--}}
    </div>

    @endforeach

    </div>
    <div style="margin-top: 20px; margin-left: 380px;">{{ $books->links() }}</div>
{{--    <script src="{{asset('js/library_home.js')}}"> </script>--}}
@endsection