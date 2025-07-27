<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ✅ Gunakan cara modern (array syntax + use Controller)
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::resource('pelanggan', 'PelangganController');
    Route::resource('penggunaan', 'PenggunaanController');
    Route::resource('tagihan', 'TagihanController');
    Route::resource('pembayaran', 'PembayaranController');
    Route::resource('tarif', 'TarifController');
});

Route::middleware(['pelanggan'])->group(function () {
    Route::get('/tagihan-saya', 'TagihanController@tagihanSaya')->name('tagihan.saya');

});
