<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', [DashboardController::class, 'home'])->name('landing');
Route::get('kamar-hotel', [DashboardController::class, 'kamar'])->name('kamar.hotel');
Route::get('kamar-hotel-show/{id}', [DashboardController::class, 'showKamar'])->name('kamar.hotel.show');
Route::get('fasilias-hotel', [DashboardController::class, 'fasilitas'])->name('fasilitas.hotel');

Route::group(['middleware' => 'guest'], function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    
    Route::post('signin', [AuthController::class, 'signin'])->name('signin');
    
    Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    
    Route::get('register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => 'auth'], function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('cart', CartController::class);
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('transaksi-store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('invoice/{id?}', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
    Route::get('invoice-show/{id?}', [TransaksiController::class, 'show'])->name('transaksi.invoice.show');
    Route::group(['middleware' => ['hasrole:admin']], function(){
        Route::resource('kamar', KamarController::class);
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('fasilitas-kamar', FasilitasKamarController::class);
        Route::resource('tipe-kamar', TipeKamarController::class);
    });
    Route::group(['middleware' => ['hasrole:guider']], function(){
        Route::get('buku-tamu', [BukuTamuController::class, 'index'])->name('buku.tamu.index');
        Route::put('buku-tamu/{id?}/update', [BukuTamuController::class, 'update'])->name('buku.tamu.update');
    });
});