<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('/log-in', 'LoginController@index');
Route::get('/register', function () {
    return view('Register.register');
});
Route::post('/library/home', 'LoginController@authenticate'); 
Route::post('/library/home', 'ListBookController@libraryIndex');
// Route::post('userDashboard','LoginController@userDashboard');
Route::get('/logout', 'LoginController@logout');


Route::get('/libraryhome', function () {
    return view('User.libraryhome');
});

Route::get('/libraryhome', function () {
    return view('User.libraryhome');
});

Route::resource('users','UserController');
Route::resource('borrows','BorrowsController');
//Route::resource('users','AdminController')->parameters([
//    'users' => 'admin_user'
//]);

// Admin dashboard routes
Route::post('/admins','AdminController@store')->name('add_new_user');
Route::put('/admins/{admin}','AdminController@update')->name('update_user');
Route::delete('/admins/{admin}','AdminController@destroy')->name('delete_user');
Route::get('/admins/{admin}','AdminController@edit')->name('edit_user');

Route::get('/admin/add_user', function () {
    return view('Admin.users.add');
})->name("add_user");

Route::get('/admin/all-users', function () {
    return view('Admin.users.all',['users'=> User::all()]);
})->name("all_users");

Route::Resource('category','CategoryController');

Route::Resource('/admin/addbook','BookController');
Route::get('/admin/allbooks','ListBookController@index')->name('allbooks');
