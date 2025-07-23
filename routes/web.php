<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\TapelController;
use App\Http\Controllers\PendidikController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\PegawaiTugasController;
use App\Http\Controllers\DaftarKelasController; // Pastikan ini diimpor

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

    // Routes for Akademik (Tapel, Semester)
    Route::prefix('akademik')->group(function () {
        Route::get('tapel', [TapelController::class, 'index'])->name('akademik.tapel.index');
        Route::post('tapel', [TapelController::class, 'store'])->name('akademik.tapel.store');
        Route::get('tapel/{tapel}/edit', [TapelController::class, 'edit'])->name('akademik.tapel.edit');
        Route::put('tapel/{tapel}', [TapelController::class, 'update'])->name('akademik.tapel.update');
        Route::delete('tapel/{tapel}', [TapelController::class, 'destroy'])->name('akademik.tapel.destroy');
        Route::post('tapel/{tapel}/toggle-active', [TapelController::class, 'toggleActive'])->name('akademik.tapel.toggle-active');

        // Routes for Semester
        Route::resource('semesters', SemesterController::class)->only(['index', 'update']);
        Route::put('semesters/{semester}/toggle-active', [SemesterController::class, 'update'])->name('semesters.toggle_active');
    });

    // Routes for Kepegawaian (Pendidik and Tenaga Kependidikan)
    Route::prefix('kepegawaian')->name('kepegawaian.')->group(function () {
        Route::get('pendidik/tidak-aktif', [PendidikController::class, 'inactivePendidiks'])->name('pendidik.inactive');
        Route::get('tenaga-kependidikan', [PendidikController::class, 'tenagaKependidikanIndex'])->name('tenaga_kependidikan.index');
        Route::get('tenaga-kependidikan/tidak-aktif', [PendidikController::class, 'inactiveTenagaKependidikan'])->name('tenaga_kependidikan.inactive');
        Route::resource('pendidik', PendidikController::class);
        Route::post('pendidik/{pendidik}/deactivate', [PendidikController::class, 'deactivate'])->name('pendidik.deactivate');
        Route::post('pendidik/{pendidik}/activate', [PendidikController::class, 'activate'])->name('pendidik.activate');
    });

    // Routes for Pegawai Tugas (tetap ada)
    Route::resource('pegawai_tugas', PegawaiTugasController::class);
    Route::post('pegawai_tugas/update_single_field', [PegawaiTugasController::class, 'updateSingleField'])->name('pegawai_tugas.update_single_field');

    // Routes for Daftar Kelas (BARU)
    Route::resource('daftar_kelas', DaftarKelasController::class)->only(['index', 'store', 'destroy']);
    Route::post('daftar_kelas/update_wali_kelas', [DaftarKelasController::class, 'updateWaliKelas'])->name('daftar_kelas.update_wali_kelas');
});
