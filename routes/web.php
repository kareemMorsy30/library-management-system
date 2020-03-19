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
Route::get('/', function () {
    return redirect("/library/home");
});
Route::get('/log-in', 'LoginController@index');
Route::get('/register', function () {
    return view('Register.register');
});

// library home routes
Route::post('/library/home', 'LoginController@authenticate'); 
Route::get('/library/home', 'ListBookController@libraryIndex')->name("home");
Route::get('/rate/order', 'ListBookController@orderByRate')->name("rate");

// Search for a book
Route::get('/search-books/{query}', 'BookController@search');

Route::get('/library/home/{cat_id}', 'ListBookController@libraryByCat');
Route::get('/libraryhome', function () {
    return view('User.libraryhome');
});
Route::post('/log-in', 'LoginController@authenticate')->name('login'); 
Route::get('/library/home', 'ListBookController@libraryIndex')->name('home');

//logout route
Route::get('/logout', 'LoginController@logout');

// user route
Route::resource('users','UserController');

// borrow route
Route::resource('borrows','BorrowsController')->middleware('auth');


// rate routes
Route::get('/user/book/{book}','RateController@index')->name('bookrate');
Route::get('/user/book/{book}/edit','RateController@edit')->name('edit_rate');
Route::delete('/user/book/{book}/rate/{rate}','RateController@destroy')->name('delete_rate');
Route::post('/user/book','RateController@store')->name('bookRstore')->middleware('auth');
Route::put('/user/book/{book}','RateController@update')->name('rate.update');

// Admin dashboard routes
// Dashboard  landing page
Route::get('/dashboard/home', 'BorrowChartController@index')->middleware(CheckAdmin::class);

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

// Admin profile
Route::get('/admin/profile','AdminController@editProfile')->name('edit_admin_profile')->middleware('auth');
Route::post('/admin/profile','AdminController@updateProfile')->name('update_admin_profile')->middleware('auth');
Route::post('/update-email', 'AdminController@updatePicture')->name('update_admin_email'); 

// User profile
Route::get('/user/profile',function() {
    return view('User.profile');
})->name('edit_admin_profile')->middleware('auth');

// category route
Route::Resource('category','CategoryController')->middleware(CheckAdmin::class);

// remove favourite route
Route::delete('/remove-favourite', 'FavouriteController@removeFav')->name('removeFav')->middleware('auth');




Route::get('rate',function(){
    return view('User/ratepage');
});

Route::resource('Favourite','FavouriteController')->middleware('auth');