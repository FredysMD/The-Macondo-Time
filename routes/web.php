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

Route::resource('users','App\Http\Controllers\UsersController')->middleware('role:admin,manager');
Route::get('/user/{id}', [App\Http\Controllers\UsersController::class, 'show'])->middleware('role:admin,manager');

Route::resource('roles','App\Http\Controllers\RolesController')->middleware('can:isAdmin');
Route::get('/role/{id}', [App\Http\Controllers\RolesController::class, 'show'])->middleware('can:isAdmin');
