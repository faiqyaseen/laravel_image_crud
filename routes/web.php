<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/my-posts', [App\Http\Controllers\HomeController::class, 'myPosts'])->name('myposts');
Route::post('/home/add-post', [App\Http\Controllers\HomeController::class, 'addPost'])->name('home.add-post');

//post route
Route::resource('posts', PostController::class);

//comment route
Route::resource('comments', CommentController::class);