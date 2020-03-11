<?php

use App\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('Login.login');
});

Route::get('/register', function () {
    return view('Register.register');
});

//Route::resource('users','UserController');
//Route::resource('users','AdminController')->parameters([
//    'users' => 'admin_user'
//]);

Route::post('/admins','AdminController@store')->name('add_new_user');
Route::put('/admins/{admin}','AdminController@update')->name('update_user');
Route::delete('/admins/{admin}','AdminController@destroy')->name('delete_user');
Route::get('/admins/{admin}','AdminController@edit')->name('edit_user');

// Admin dashboard routes
Route::get('/admin/add_user', function () {
    return view('Admin.users.add');
})->name("add_user");

Route::get('/admin/all-users', function () {
    return view('Admin.users.all',['users'=> User::all()]);
})->name("all_users");

Route::Resource('category','CategoryController');
