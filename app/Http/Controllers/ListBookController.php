<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrow;
use App\Rate;
use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Favourite;
use Illuminate\Support\Facades\Auth;

class ListBookController extends Controller
{



    public function index()
    {
        $this->returnBooks();
        return view('books.allBooks', ['books' => Book::all()] );
    }

    public function libraryByCat($cat_id)
    {
        $this->returnBooks();
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();


        $books = Book::where('category_id',$cat_id)
                    ->orderBy('created_at','asc')->paginate(3);

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

        $rate_arr = DB::table('rates')
                    ->select(DB::raw('avg(rate)as avg,book_id'))
                    ->where('rate', '!=', 0)
                    ->groupBy('book_id')->get();

        return view('User.libraryhome', ['favourites'=>$favourites,'books' => $books,'rates'=> $rate_arr] );
    }



    public function libraryIndex()
    {
//        return $this->returnBooks();
        $this->returnBooks();
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $books = Book::orderBy('created_at','desc')->paginate(3);
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

        $rate_arr = DB::table('rates')
                    ->select(DB::raw('avg(rate)as avg,book_id'))
                    ->where('rate', '!=', 0)
                    ->groupBy('book_id')->get();

        return view('User.libraryhome', ['favourites'=>$favourites, 'books'=>$books , 'rates'=> $rate_arr ]);
    }

    public function orderByRate()
    {
        $this->returnBooks();
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();

        $rate_arr = DB::table('rates')
        ->select(DB::raw('avg(rate)as avg,book_id'))
        ->where('rate', '!=', 0)
        ->groupBy('book_id')->get();

        $books = Book::orderByDesc(
            DB::table('rates')
            ->select(DB::raw("avg(rate) as count"))
            ->whereColumn('book_id','books.id')
                ->groupBy('book_id')
            ->orderBy('count','desc')
            )->paginate(3);
//        return $books;
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
        // return $books;
        return view('User.libraryhome',['books'=>$books,'rates'=>$rate_arr,'favourites'=>$favourites]);
    }

    public function returnBooks() {

        $books = Book::all();
        foreach ($books as $book) {
            foreach ($book->users_borrows()->get() as $borrow) {
//                return $book->users_borrows()->get();
                $returnDate = $borrow->pivot->return_back;
//                return Carbon::now()->diffInMinutes(Carbon::parse($returnDate),false);
                if(Carbon::now()->diffInMinutes(Carbon::parse($returnDate),false) <= 0 ) {
                    $book->increment('quantity', 1);
                    $id = $borrow->pivot->id;
                    Borrow::find($id)->delete();
                }
            }
        }
    }

}


