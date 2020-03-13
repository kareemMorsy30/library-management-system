@extends('layouts.librarylayout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <div class="showCards">
        @foreach ( $books as $book )
<div class="flex-card card">
    <div>
        <img src="{{url('uploads/'.$book->pic)}}"/>
    </div>
    <div class="card-body">
        <div >
            <img class="rank" src="/rankicon.png">
            <img class="rank" src="/rankicon.png">
            <img class="rank" src="/rankicon.png">
            <img class="rank" src="/rankicon.png">
            <img class="rank" src="/rankicon.png">
        </div>
      <p class="card-title">{{ $book->title }}</p>
      <p class="card-text">{{ $book->description }}</p>
      <span>{{ $book->quantity }} copies available</span>
      <a><img src="/heart.png" id="heart"></a>
    </div><br>
    <div class="card-footer">
        <button id="lease" class="btn btn-success btn-sm btn-block lease" >Lease</button>
    </div>

</div>
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
            <button id="lease" data-toggle="modal" data-title="{{"C++"}}" data-book_id="{{"1"}}" data-target="#borrow-model" class="btn btn-success btn-sm btn-block lease" >Lease</button>
        </div>

    </div> --}}
    {{-- <div class="modal fade" id="borrow-model"
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
