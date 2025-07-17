<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController; // <-- Pastikan ini diimpor!

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Semua pengguna setelah login akan diarahkan ke dashboard utama
        return redirect()->action([DashboardController::class, 'index']);
        // Atau jika Anda ingin redirect ke named route:
        // return redirect()->route('dashboard.main');
    }
}