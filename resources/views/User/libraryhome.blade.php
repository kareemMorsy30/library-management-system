@extends('layouts.librarylayout')

@section('content')
<div class="card">
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
        <a id="lease" class="btn btn-success btn-sm btn-block" href="#">Lease</a> 
    </div>
</div>
@endsection