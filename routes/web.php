<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\InstansiController;


Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.main');
     Route::get('/instansi/profile', [InstansiController::class, 'index'])->name('instansi.profile'); // Ubah ini
    Route::post('/instansi/profile', [InstansiController::class, 'update'])->name('instansi.update'); // Ubah ini


});