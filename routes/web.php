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

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{id}', [App\Http\Controllers\HomeController::class, 'show']);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::resource('posts','App\Http\Controllers\PostsController'); // Es diferente por la versión de Laravel