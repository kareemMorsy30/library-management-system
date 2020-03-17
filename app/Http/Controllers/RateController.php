<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book;
//use Auth;
use App\User;
use App\Favourite;
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
        $favourites = Favourite::where('user_id', Auth::id())->pluck('book_id')->toArray();
        $category = \App\Book::find($id)->category_id; 
        $user = Auth::id();
        $rate =DB::table('rates')
                ->where('book_id',$id)
                ->avg('rate') !== null ? DB::table('rates')
                ->where('book_id',$id)
                ->where('rate', '!=',0)
                ->avg('rate'):0;

        $book = Book::find($id);
        $myBooks = Auth::user()->books_borrows()->get();
        $book->canBorrow = true;
        foreach ($myBooks as $myBook){
            if($book->id === $myBook->id){
                $book->canBorrow = false;
                break;
            }
        }

        return view(
            'User.ratepage',
            [
                'book' => $book,
                'relatedBooks' => \App\Book::all()->where('category_id', $category),
                'rate' => $rate,
                'user' => $user,
                'favourites'=>$favourites
            ]);
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
            $comment = $request->comment;
            $is_exsit =DB::table('rates')->where('Book_id',$book_id)
                        ->where('user_id',Auth::id())->exists();

            if ($request->rate == 0 && $is_exsit == true) {
                    $rate = DB::table('rates')->where('Book_id',$book_id)
                            ->where('user_id',Auth::id())->get()[0]->rate;
            }else{
                $rate = $request->rate;
            }
            
            \App\User::find(Auth::id())->rates()
                        ->attach([$book_id =>['rate'=>$rate ,
                                              'comment'=>$comment ,
                                              'created_at' => Carbon::now()]]);

            if ($is_exsit == true ) {
                $rating = DB::table('rates')
                            ->where('Book_id',$book_id)
                            ->where('user_id',Auth::id())->update(array('rate' => $rate));
            }

        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('message', 'Please leave a comment and rate our book!');
        }

        return redirect()->route('bookrate', $book_id);
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
            'comment' => ' required|max:250'  
            ]);

        $rateId = $request->rateId;
        $rate = $request->hiddenrate;
        $comment = $request->comment;
        
        if($rate !=0){
        \App\User::find(Auth::id())->rates()
        ->updateExistingPivot($id,['rate'=>$rate]);
        }
        \App\User::find(Auth::id())->rates() 
        ->wherePivot('id',$rateId)
        ->updateExistingPivot($id,['comment'=>$comment ,'created_at' => Carbon::now()]);
    
        
        return redirect()->route('bookrate', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id ,$rateId)
    {
        \App\User::find(Auth::id())->rates()->wherePivot('id',$rateId)->detach($id);

        return redirect()->route('bookrate', $id);

    }
}
