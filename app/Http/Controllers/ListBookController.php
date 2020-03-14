<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Support\Facades\DB;

class ListBookController extends Controller
{
    public function index()
    {
        return view('books.allBooks', ['books' => Book::all()] );
    }
    public function libraryByCat($cat_id)
    {
        $books = DB::table('books')->where('category_id',$cat_id)->orderBy('created_at','asc')->paginate(3);
        return view('User.libraryhome', ['books' => $books] );
    }
    
    public function libraryIndex()
    {
        $books = DB::table('books')->orderBy('created_at','desc')->paginate(3);
        return view('User.libraryhome', ['books' => $books] );
    }
}
