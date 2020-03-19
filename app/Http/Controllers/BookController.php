<?php

namespace App\Http\Controllers;

use App\Borrow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Book;
use App\Favourite;
use App\Category;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = \App\Category::pluck('name', 'id');
        // Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        // return view('User.libraryhome' , compact('favourites'));
         return view('books.addBook' , ['category' => compact('category')]);
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
        $validatedData = $request->validate([
            'title' => 'required|regex :/[a-zA-Z0-9\s]+/|unique:books,title,NULL,id,deleted_at,NULL',
            'author' => 'required| regex: /^[\pL\s]+$/u',
            'description' => 'regex :/[a-zA-Z0-9\s]+/|max:150',
            'quantity' => 'required | integer | max:100|min:0',
            'price' => 'required | numeric | max : 1000|min:0',
            'category' => 'required',
            'pic' => 'mimes:jpeg,bmp,png|max:2048'      
            ]);

            $book = new Book;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;
            $book->quantity = $request->quantity;
            $book->price = $request->price;
            $book->category_id = $request->category;
            if ($request->hasFile('pic')) {
                $cover = $request->file('pic');
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
                $book->pic = $cover->getFilename().'.'.$extension;
            }
            $book->save();
            return redirect()->Route('addbook.index')->with('status','Book added successfully...');


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
        $this->returnBooks();
        $category = \App\Category::pluck('name', 'id');
        return view('books.editBook',['book' => \App\Book::find($id) ,'category' => compact('category')]);
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
//        $this->returnBooks();
        $book = \App\Book::find($id);
        $validatedData = $request->validate([
            'title' => 'required|regex :/[a-zA-Z0-9\s]+/|unique:books,title,'.$id.',id,deleted_at,NULL',
            'author' => 'required| regex: /^[\pL\s]+$/u',
            'description' => 'regex :/[a-zA-Z0-9\s]+/|max:150',
            'quantity' => 'required | integer | max:100|min:0',
            'price' => 'required | numeric | max : 1000|min:0',
            'category' => 'required',
            'pic' => 'mimes:jpeg,bmp,png|max:2048'          
            ]);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;
            $book->quantity = $request->quantity;
            $book->price = $request->price;
            $book->category_id = $request->category;
            if ($request->hasFile('pic')) {
                $cover = $request->file('pic');
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
                $book->pic = $cover->getFilename().'.'.$extension;
            }
            $book->save();
            return redirect()->Route('allbooks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $this->returnBooks();
        $book = \App\Book::find($id);
        $book->delete();
        return redirect()->Route('allbooks');
    }

    public function search($searchQuery)
    {
        $this->returnBooks();
        $favourites = Favourite::where('user_id',Auth::id())->pluck('book_id')->toArray();
        if($searchQuery == "NULL"){
            $books = Book::latest()->get();
        }else{
            $books = Book::where('title', 'like', '%'.$searchQuery.'%')->orWhere('author', 'like', '%'.$searchQuery.'%')->latest()->get();
        }
        
        return response()->json(['res' => $books, 'favourites' => $favourites]);
    }

    public function returnBooks() {

        $books = Book::all();
        foreach ($books as $book) {
            foreach ($book->users_borrows()->get() as $borrow) {
                $returnDate = $borrow->pivot->return_back;
                if(Carbon::now()->diffInMinutes($returnDate) <= 0 ) {
                    $book->increment('quantity', 1);
                    $id = $borrow->pivot->id;
                    Borrow::find($id)->delete();
                }
            }
        }
    }
}
