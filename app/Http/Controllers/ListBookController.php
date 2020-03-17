<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rate;
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
        foreach ($books as $book) {
            if(!Auth::user()) {
                $book->canBorrow = false;
            } else {
                $myBooks = Auth::user()->books_borrows()->get();
                $book->canBorrow = true;
                foreach ($myBooks as $myBook){
                    if($book->id === $myBook->id){
                        $book->canBorrow = false;
                        break;
                    }
                }
            }
        }
//        return $books;
//        return $borrows;
        $rate_arr = DB::table('rates')
                    ->select(DB::raw('avg(rate)as avg,book_id'))
                    ->where('rate', '!=', 0)
                    ->groupBy('book_id')->get();

        return view('User.libraryhome', ['favourites'=>$favourites, 'books'=>$books , 'rates'=> $rate_arr ]);
    }

    public function orderByRate()
    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();

        $rate_arr = DB::table('rates')
        ->select(DB::raw('avg(rate)as avg,book_id'))
        ->where('rate', '!=', 0)
        ->groupBy('book_id')->get();

        $books = Book::orderByDesc(
            DB::table('rates')
            ->select('rate')
            ->whereColumn('book_id','books.id')
            ->orderBy('rate','desc')
            )->paginate(3);
        // return $books;
        return view('User.libraryhome',['books'=>$books,'rates'=>$rate_arr,'favourites'=>$favourites]);
    }
}
