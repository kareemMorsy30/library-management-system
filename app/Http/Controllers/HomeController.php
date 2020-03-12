<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            echo "adfadfafa";
            //return view('books.addBook');
        }else {
            return redirect("/log-in");
        }
    }
}
