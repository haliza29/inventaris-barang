<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi Halaman Inventaris (Harus Login Dulu)
Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
});