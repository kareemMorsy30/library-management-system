<?php

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
    return view('welcome');
});

// Admin dashboard routes
Route::get('/admin/add-user', function () {
    return view('Admin.users.add');
});

Route::get('/admin/all-users', function () {
    return view('Admin.users.all');
});
Route::Resource('category','CategoryController');
