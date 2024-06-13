<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/kategori', \App\Http\Controllers\KategoriController::class)->middleware('auth');
Route::resource('/barang', \App\Http\Controllers\BarangController::class)->middleware('auth');
Route::resource('/barangmasuk', \App\Http\Controllers\BarangmasukController::class)->middleware('auth');




Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth')->name('dashboard');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', [HomeController::class, 'index']);
    // Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});