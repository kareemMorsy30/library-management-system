<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\DB;

class ListBookController extends Controller
{
    public function index()
    {
        return view('books.allBooks', ['books' => Book::all()] );
    }

    public function libraryIndex()
    {
        $books = DB::table('books')->paginate(3);
        return view('User.libraryhome', ['books' => $books] );
    }
}
