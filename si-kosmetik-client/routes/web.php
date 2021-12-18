<?php

use App\Http\Controllers\KategoriKosmetikController;
use App\Http\Controllers\ProdukKosmetikController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('kategoriKosmetik', KategoriKosmetikController::class);
Route::resource('produkKosmetik', ProdukKosmetikController::class);
Route::resource('transaksi', TransaksiController::class);
