@extends('layouts.librarylayout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="showCards">
    @foreach ( $books as $book )
    <div class="flex-card card">
        <div>
            <img src="{{url('uploads/'.$book->pic)}}" />
        </div>
        <!-- <form action="{{route('Favourite.store')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value={{$book->id}}>
            <input type="submit" value="ADD" class="btn btn-info"><br>
        </form>
        <form action="{{route('removeFav')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value={{$book->id}}>
            <input type="submit" value="Delete" class="btn btn-info"><br>
        </form> -->

    <a href="{{ route('bookrate',$book->id) }}">
        <div class="flex-card card">
            <div>
                <img src="{{url('uploads/'.$book->pic)}}"/>
            </div>
        <div class="card-body">
            <div>
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
            </div>
            <p class="card-title">{{ $book->title }}</p>
            <p class="card-text">{{ $book->description }}</p>
<<<<<<< HEAD
            <span>{{ $book->quantity }} copies available</span>


            
            @if(in_array($book->id,$favourites))
                <form action="{{route('removeFav')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value={{$book->id}}>
                    <input type="image" id="heart" src="/coloredheart.png"/>
                </form>
            @else
                <form action="{{route('Favourite.store')}}" method="POST">
                    @csrf
                    <input type="image" id="heart" src="/heart.png"/>
                    <input type="hidden" name="id" value={{$book->id}}>
                </form>
            @endif
        </div><br>
        <div class="card-footer">
            <button id="lease" class="btn btn-success btn-sm btn-block lease">Lease</button>
=======
            @if($book->quantity <= 0)
                <button class="btn btn-danger btn-sm" style="border-radius: 15px;" disabled>no copies available</button>
            @else
                <span>{{ $book->quantity }} copies available</span>
            @endif
                <a><img src="/heart.png" id="heart"></a>
        </div><br>
        <div class="card-footer">
            <button id="lease" data-toggle="modal" data-title="{{$book->title}}" data-book_id="{{$book->id}}" data-target="#borrow-model" 
                class="btn btn-success btn-sm btn-block lease" {{ $book->quantity <= 0?"disabled":"" }}>Lease</button>
>>>>>>> 1274ebce4df2702e749fee335f5e32f211698834
        </div>

    </div>
<<<<<<< HEAD
    @endforeach
</div>
{{-- <div class="card">
        <div class="card-header">
            picture
        </div>
        <div class="card-body">
            <div >
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
            </div>
            <p class="card-title">Book Title</p>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae dolores adipisci veniam voluptate perferendis cumque</p>
            <span>2 copies available</span>
            <a><img src="/heart.png" id="heart"></a>
        </div><br>
        <div class="card-footer">
            <button id="lease" class="btn btn-success btn-sm btn-block lease" >Lease</button>
        </div>

    </div> --}}
{{-- <div class="card">
        <div class="card-header">
            picture
        </div>
        <div class="card-body">
            <div >
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
                <img class="rank" src="/rankicon.png">
            </div>
            <p class="card-title">Book Title</p>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae dolores adipisci veniam voluptate perferendis cumque</p>
            <span>2 copies available</span>
            <a><img src="/heart.png" id="heart"></a>
        </div><br>
        <div class="card-footer">
            <button id="lease" data-toggle="modal" data-title="{{"C++"}}" data-book_id="{{"1"}}"
data-target="#borrow-model" class="btn btn-success btn-sm btn-block lease" >Lease</button>
</div>

</div> --}}
{{-- <div class="modal fade" id="borrow-model"
=======
    </a>
@endforeach
</div>
<div style="margin-top: 20px; margin-left: 380px;">{{ $books->links() }}</div>
<script src="{{asset('js/library_home.js')}}"> </script>
@endsection
    
     <div class="modal fade" id="borrow-model"
>>>>>>> 1274ebce4df2702e749fee335f5e32f211698834
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
<<<<<<< HEAD
@csrf
<input name="book_id" id="book_id" hidden />
<div class="modal-body">
    <p>
        Please confirm you would like to borrow
        <b><span id="book-title"></span></b>
        for <input name="numberOfDays" type="number" class="w-25 d-inline" min="1" value="1" /> days
    </p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <span class="pull-right">
        <button type="submit" class="btn btn-primary">
            Borrow
        </button>
    </span>
</div>
</form>
</div>
</div>
</div> --}}
<script src="{{asset('js/library_home.js')}}"> </script>
@endsection
=======
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

>>>>>>> 1274ebce4df2702e749fee335f5e32f211698834
