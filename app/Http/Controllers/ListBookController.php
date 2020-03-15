<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Support\Facades\DB;
use App\Favourite;
use Illuminate\Support\Facades\Auth;

class ListBookController extends Controller
{
    public function index()
    {
        return view('books.allBooks', ['books' => Book::all()] );
    }

    public function libraryByCat($cat_id)
    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $books = DB::table('books')
                    ->where('category_id',$cat_id)
                    ->orderBy('created_at','asc')->paginate(3);

        $rate_arr = DB::table('rates')
                    ->select(DB::raw('avg(rate)as avg,book_id'))
                    ->where('rate', '!=', 0)
                    ->groupBy('book_id')->get();

        return view('User.libraryhome', ['favourites'=>$favourites,'books' => $books,'rates'=> $rate_arr] );
    }
    
    public function libraryIndex()
    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $books = DB::table('books')->orderBy('created_at','desc')->paginate(3);
        
        $rate_arr = DB::table('rates')
                    ->select(DB::raw('avg(rate)as avg,book_id'))
                    ->where('rate', '!=', 0)
                    ->groupBy('book_id')->get();

        return view('User.libraryhome', ['favourites'=>$favourites, 'books'=>$books , 'rates'=> $rate_arr ]);
    }
}
