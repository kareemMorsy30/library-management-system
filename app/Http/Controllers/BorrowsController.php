<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrow;
use App\Favourite;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->returnBooks();
//        return Auth::user()->books_borrows()->paginate(3);
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $rate_arr = DB::table('rates')
            ->select(DB::raw('avg(rate)as avg,book_id'))
            ->where('rate', '!=', 0)
            ->groupBy('book_id')->get();
        $books = Auth::user()->books_borrows()->paginate(3);
        return view('User.mybooks',['favourites'=>$favourites, 'books'=>$books , 'rates'=> $rate_arr ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::id();
        $bookId = $request->book_id;
        $numberOfDays = $request->numberOfDays;
        $user = User::find($userId);
        $book = Book::find($bookId);

        if(count($user->books_borrows()->where('books.id', $request->book_id)->get()) > 0){
            return redirect()->back()->with('success', "You already borrowed ".$book->title." book");
        }

        if(!$book || $book->quantity <= 0) {
            return redirect('/library/home')->with("errors","can not borrow this book");
        }

        User::find($userId)->books_borrows()->attach($bookId,['return_back'=> Carbon::now()->addDays($numberOfDays)]);
        
        $book->decrement('quantity', 1);
        return redirect('/library/home')->with("success","borrow is done successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
