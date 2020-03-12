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
            if (Auth::attempt([$checkVal => $request->username, 'password' => $request->pass])){
            if(Auth::user()->active == 1){
                if(Auth::user()->privilege =="user"){
                    return view('User.libraryhome');
                }
                if(Auth::user()->privilege =="admin"){
                    return redirect('/admin/all-users');
                }
            } else {
                Session::flush();
                Auth::logout();
                return redirect("/log-in");
            }
        } 
        return redirect()->back();
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
