<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SesionController;


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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/')->middleware('auth');;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');;

Route::get('userInfo', [App\Http\Controllers\UserController::class, 'user'])->name('userInfo')->middleware('auth');;


Route::get('userInfo', [App\Http\Controllers\UserController::class, 'user'])->name('userInfo')->middleware('auth');;

Route::middleware('auth')->prefix('/session')->group(function(){
    Route::get('/set', [SesionController::class, 'setSession']);
    Route::get('/get', [SesionController::class, 'getSession']);
    Route::get('/del', [SesionController::class, 'delSession']);
});