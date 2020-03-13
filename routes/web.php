<?php

use App\User;
use App\Http\Controllers;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use League\CommonMark\Extension\Table\Table;
use Illuminate\Support\Facades\DB;
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

// login and register routes
Route::get('/', 'HomeController@index');
Route::get('/log-in', 'LoginController@index');
Route::get('/register', function () {
    return view('Register.register');
});

// library home routes
Route::get('/libraryhome', function () {
    return view('User.libraryhome');
});
Route::post('/library/home', 'LoginController@authenticate'); 
Route::get('/library/home', 'ListBookController@libraryIndex');

//logout route
Route::get('/logout', 'LoginController@logout');

// user route
Route::resource('users','UserController');

// borrow route
Route::resource('borrows','BorrowsController');


// Admin dashboard routes
Route::post('/admins','AdminController@store')->name('add_new_user')->middleware(CheckAdmin::class);
Route::put('/admins/{admin}','AdminController@update')->name('update_user')->middleware(CheckAdmin::class);
Route::delete('/admins/{admin}','AdminController@destroy')->name('delete_user')->middleware(CheckAdmin::class);
Route::get('/admins/{admin}','AdminController@edit')->name('edit_user')->middleware(CheckAdmin::class);
Route::get('/admin/add_user', function () {
    return view('Admin.users.add');
})->name("add_user")->middleware(CheckAdmin::class);
Route::get('/admin/all-users', function () {
    return view('Admin.users.all',['users'=> User::all()]);
})->name("all_users")->middleware(CheckAdmin::class);
Route::Resource('/admin/addbook','BookController')->middleware(CheckAdmin::class);
Route::get('/admin/allbooks','ListBookController@index')->name('allbooks')->middleware(CheckAdmin::class);

// category route
Route::Resource('category','CategoryController')->middleware(CheckAdmin::class);

// remove favourite route
Route::delete('/remove-favourite', 'FavouriteController@removeFav')->name('removeFav');
