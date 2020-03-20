<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Book;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        $books = Book::paginate(3);
        // $users = DB::table('favourites')->paginate();
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
        $rates = DB::table('rates')
        ->select(DB::raw('avg(rate)as avg,book_id'))
        ->where('rate', '!=', 0)
        ->groupBy('book_id')->get();

        return view('books.favourite', compact('favourites', 'books' ,'rates'));
      
        // return view('books.favourite',['books'=>Book::all()],compact('favourites'));
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
        $fav = new Favourite;
        $fav->user_id = Auth::id();
        $fav->book_id = $request->id;
        $fav->save();
        return redirect()->back();
 
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
        //ter
    }

    public function removeFav(Request $request){
        Favourite::where([
            ['user_id', Auth::id()],
            ['book_id', $request->id]
        ])->delete();
        return redirect()->back();
    }
}