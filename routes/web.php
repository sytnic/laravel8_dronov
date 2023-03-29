<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BbsController;


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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [BbsController::class, 'index'])->name('index');

Route::get('/{bb}', [BbsController::class, 'detail'])->name('detail');