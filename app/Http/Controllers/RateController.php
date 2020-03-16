<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book;
// use Auth;
use App\User;
use App\Favourite;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        // $books = DB::table('books');
        // return view('User.ratepage', compact('favourites', 'books'));
        return view('User.ratepage',['book'=>\App\Book::find($id)], compact('favourites'));
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
        try{
        $book_id = $request->id;
        $rate = $request->rate;
        $comment = $request->comment;
        \App\User::find(Auth::id())->rates()->syncWithoutDetaching([$book_id =>['rate'=>$rate , 'comment'=>$comment , 'created_at' => Carbon::now()]]);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('message', 'Please leave a comment and rate our book!');
        }
        return view('User.ratepage',['book' => \App\Book::find($book_id)]);
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
        $validatedData = $request->validate([
            'newcomment' => ' required|max:250',
            'hiddenrate' => 'required',  
            ]);
        $rate = $request->hiddenrate;
        $comment = $request->newcomment;
        $user = \App\User::find(Auth::id())->rates()->updateExistingPivot($id,['rate'=>$rate ,'comment'=>$comment ,'created_at' => Carbon::now()]);
        return view('User.ratepage',['book' => \App\Book::find($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\User::find(Auth::id())->rates()->detach($id);
        return view('User.ratepage',['book' => \App\Book::find($id)]);

    }

    
}
