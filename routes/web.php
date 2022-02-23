<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LoginController;

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
Route::resource('login', LoginController::class);
Route::get('/logout', [LoginController::class,'logout']);
Route::get('/admin', function(){
    return view('admin.index');
})->name('admin.index');
Route::resource('admin/userlist', UserController::class);
Route::get('/manager', function(){
    return view('manager.index');
})->name('manager.index');
Route::resource('manager/menu', MenuController::class);
Route::get('/kasir', function(){
    return view('kasir.index');
})->name('kasir.index');
Route::resource('kasir/transaksi', TransaksiController::class);