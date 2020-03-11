<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;


class ListBookController extends Controller
{
    public function index()
    {
        return view('books.allBooks', ['books' => \App\Book::all()] );
    }
}
