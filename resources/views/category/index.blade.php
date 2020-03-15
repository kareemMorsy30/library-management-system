
@extends('layouts.app')

@section('content')

    <!-- Main content -->
<section class="content container-fluid">
    <div class="container">
        
     <h2 class="alert alert-success 50m"> Categories</h2>
        <div id="flex">
            <a href="" class="btn btn-info" style="margin-left:55%" data-toggle="modal" data-target="#exampleModal">Add New Category</a>
            <div class="col-md-8">

                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th>name</th>
                            <th>action</th>

                        </tr>

                    <tbody>

                        @foreach($categories as $categories)
                        <tr>
                            <td>{{$categories->name}}</td>
                          
                            <td>
                          
                    @csrf
                       
                        <input type="submit" value="Edit" class="btn btn-warning btn-m" data-toggle="modal" data-target="#exampleModal-edit">
                        <!-- <a type="button" class="btn btn-danger btn-m">Delete</a> -->
                    </form>
                    <form action="{{route('category.destroy', $categories->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="delete" class="btn btn-danger btn-m">
                                    </form>
                  
                         </td>
                                   

                        </tr>
                        @endforeach
                    </tbody>

                    </thead>

                </table>

                <!-- --------------------add new category---------------- -->
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notify modal-lg modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="exampleModalLabel">ADD NEW CATEGORY</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" action="{{ route('category.store')}}">

                                    @csrf
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">category name</span>
                                        </div>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Category name">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" data-dismiss="modal">Close</button>
                            </div>
                                <button type="submit" class="btn btn-info">Save category</button>
                            </div>
                            </form>
                        </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notify modal-lg modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="exampleModalLabel">ADD NEW CATEGORY</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('category.update', $categories) }}">
                        @csrf
                        @method('PUT')
                       
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">category name</span>
                                        </div>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Category name">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save category</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  @endsection  