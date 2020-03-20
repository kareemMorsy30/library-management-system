<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index(){
        return view('Login.login');
    }

    public function authenticate(Request $request){

        $this->validate($request,[
            'username' => 'required',
            'pass' => 'required'
        ]);
        $checkVal  = filter_var($request->username, FILTER_VALIDATE_EMAIL) ?"email":"username";
       
        if (Auth::attempt([$checkVal => $request->username, 'password' => $request->pass, 'active' => 1])){
            if(Auth::user()->privilege =="user"){
                return redirect('/library/home');
            }
            if(Auth::user()->privilege =="admin" || Auth::user()->privilege =="manager"){
                return redirect('/dashboard/home');
            }
        } else {
            return redirect()->back()->with("error", "Check username or password and try again");
        }
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
