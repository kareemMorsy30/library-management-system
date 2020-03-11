

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.0/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.0/js/mdb.min.js">
    </script>

</head>

<body>

    <style>
        .container {
            padding: 0.5%;
            text-align: center;

        }
    </style>
    <div class="container">
       
        @extends('layouts.app')

@section('content')

    <!-- Main content -->
    
     <h2 class="alert alert-success 50m"> Categories</h2>
        <div class="row">
            <a href="" class="btn btn-info" style="margin-left:82%" data-toggle="modal" data-target="#exampleModal">Add New Category</a>
            <div class="col-md-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th>name</th>
                            <th>action</th>

                        </tr>

                    <tbody>

                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                          
                            <td>
                            <form action="{{route('category.edit',$category->id)}}" method="get">
                    @csrf
                       
                        <input type="submit" value="Edit" class="btn btn-warning btn-m" data-toggle="modal" data-target="#exampleModal-edit">
                        <!-- <a type="button" class="btn btn-danger btn-m">Delete</a> -->
                    </form>
                    <form action="{{route('category.destroy', $category->id)}}" method="POST">
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

  @endsection  
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
            </div>
        </div>
    </div>
</body>

</html>