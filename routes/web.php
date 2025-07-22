<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\TapelController;
use App\Http\Controllers\PendidikController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MainTaskController; // Add this

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.main');

    // Routes for Instansi
    Route::prefix('instansi')->group(function () {
        Route::get('profile', [InstansiController::class, 'index'])->name('instansi.profile');
        Route::post('profile', [InstansiController::class, 'update'])->name('instansi.update');
    });

    // Routes for Akademik (Tapel, Semester, and Main Tasks)
    Route::prefix('akademik')->group(function () {
        Route::get('tapel', [TapelController::class, 'index'])->name('akademik.tapel.index');
        Route::post('tapel', [TapelController::class, 'store'])->name('akademik.tapel.store');
        Route::get('tapel/{tapel}/edit', [TapelController::class, 'edit'])->name('akademik.tapel.edit');
        Route::put('tapel/{tapel}', [TapelController::class, 'update'])->name('akademik.tapel.update');
        Route::delete('tapel/{tapel}', [TapelController::class, 'destroy'])->name('akademik.tapel.destroy');
        Route::post('tapel/{tapel}/toggle-active', [TapelController::class, 'toggleActive'])->name('akademik.tapel.toggle-active');

        // Routes for Semester
        Route::resource('semesters', SemesterController::class)->only(['index', 'update']);

        // Routes for Main Tasks (Add this)
        Route::resource('main_tasks', MainTaskController::class);
        Route::post('main_tasks/{main_task}/update-additional-tasks', [MainTaskController::class, 'updateAdditionalTasks'])->name('main_tasks.update-additional-tasks');
    });

    // Routes for Kepegawaian (Pendidik and Tenaga Kependidikan)
    Route::prefix('kepegawaian')->name('kepegawaian.')->group(function () {
        // Specific route for inactive educators (teachers)
        Route::get('pendidik/tidak-aktif', [PendidikController::class, 'inactivePendidiks'])->name('pendidik.inactive');

        // Route for active educational staff
        Route::get('tenaga-kependidikan', [PendidikController::class, 'tenagaKependidikanIndex'])->name('tenaga_kependidikan.index');

        // NEW route for inactive educational staff
        Route::get('tenaga-kependidikan/tidak-aktif', [PendidikController::class, 'inactiveTenagaKependidikan'])->name('tenaga_kependidikan.inactive');

        // Resource route for Pendidik (index, create, store, show, edit, update, destroy)
        Route::resource('pendidik', PendidikController::class);

        // Routes for deactivating and activating educators/educational staff
        Route::post('pendidik/{pendidik}/deactivate', [PendidikController::class, 'deactivate'])->name('pendidik.deactivate');
        Route::post('pendidik/{pendidik}/activate', [PendidikController::class, 'activate'])->name('pendidik.activate');
    });

});
