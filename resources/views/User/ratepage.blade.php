@extends('layouts.ratelayout')

@section('content')
<div class="row">
    <div class="card">
      <div class="card-header">
        picture
      </div>
    </div>
    <div class="card-body">
      <a><img src="/heart.png" id="heart"></a>
        <p class="card-title title">Book Title</p>
        <div >
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
          <img class="rank" src="/rankicon.png">
        </div>
        <p class="card-text col-md-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae dolores adipisci veniam voluptate perferendis cumque</p>
        <span>2 copies available</span>
        <a id="lease" class="btn btn-success btn-sm" href="#">Lease</a> 
    </div>
</div>
<div class="row">
  
    <div class="form-group comment">
        <textarea class="form-control" rows="4" cols="110" placeholder="Your Comment..."></textarea>
        <a class="btn btn-primary btn-sm btn-block" href="#">Comment</a>
    </div>
    <div class="rankwithcomment">
      <img class="rankcomment" src="/rankicon.png">
      <img class="rankcomment" src="/rankicon.png">
      <img class="rankcomment" src="/rankicon.png">
      <img class="rankcomment" src="/rankicon.png">
      <img class="rankcomment" src="/rankicon.png">
    </div>  
</div>
<div class="row">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Mahmoud</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>user comment</td>
          </tr>
        </tbody>
      </table>
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