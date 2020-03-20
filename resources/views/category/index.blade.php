    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.0/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js">
    </script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.0/js/mdb.min.js">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @extends('layouts.categorylayout')
    @section('content')

    <!-- Main content -->

    <head>
        <style>
            .modal-dialog {
                width: 400px;
                height: 100px;
            }
        </style>
    </head>


    <h2 class="alert 50" style="background-color:whitesmoke;text-align:center;"> Categories</h2>

    <a href="" class="btn btn-info" style="margin-left:55%" data-toggle="modal" data-target="#exampleModal">Add New Category</a>
    <div class="col-md-6" style="margin-left: 400px">

        <table class="table table-border">
            <thead>
                <tr>

                    <th>name</th>
                    <th>action</th>

                </tr>
            </thead>
            <tbody>

                @foreach($categories as $categories)
                <tr>
                    <td>{{$categories->name}}</td>

                    <td>

                        @csrf

                        <input type="submit" value="Edit" class="btn btn-warning btn-m" data-toggle="modal" data-target="#exampleModal-edit">
                        <!-- <a type="button" class="btn btn-danger btn-m">Delete</a> -->
                        <div class="modal fade" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-notify modal-lg modal-default" role="document">
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
                                        <button id = edit type="submit" class="btn btn-info">edit category</button>
            
                                    </div>
                                 <?php  $error =$errors->add->first('name');?>
                                     @if ($error) 
                    <div class="alert alert-danger">
                    <li>{{$error }}</li>
                        <script type="text/javascript">
                            $('#exampleModal-edit').modal('show');
                        </script>
                       
                            <!-- @foreach ($errors->all() as $error) -->
                          
                            <!-- @endforeach -->
                       
                    </div>
                    @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('category.destroy', $categories->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger btn-m">
                        </form>

                    </td>


                </tr>
                @endforeach
            </tbody>


        </table>

        <!-- --------------------add new category---------------- -->
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-lg modal-default" role="document">
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

                        <button type="submit" class="btn btn-info">Save category</button>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <script type="text/javascript">
                            $('#exampleModal').modal('show');
                        </script>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </form>


                </div>


            </div>
        </div>
    </div>






    @endsection