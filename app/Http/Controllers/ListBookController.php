<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\DB;
use App\Favourite;
use Illuminate\Support\Facades\Auth;

class ListBookController extends Controller
{
    public function index()
    {
        return view('books.allBooks', ['books' => Book::all()] );
    }

    public function libraryIndex()
    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $books = DB::table('books')->paginate(3);
        return view('User.libraryhome', compact('favourites', 'books'));
    }
}
