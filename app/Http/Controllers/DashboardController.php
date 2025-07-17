<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware untuk memastikan hanya user yang terautentikasi bisa mengakses
        $this->middleware('auth');
        // Opsional: Anda bisa tambahkan middleware 'can' di sini juga jika ingin
        // memastikan hanya user yang memiliki gate 'user' (semua yang login)
        // bisa mengakses dashboard ini.
        // $this->middleware('can:user');
    }

    /**
     * Show the main application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Anda bisa pass data spesifik ke view jika diperlukan,
        // misalnya $user = Auth::user();
        // return view('dashboard', compact('user'));

        // Mengembalikan satu view dashboard untuk semua role
        return view('dashboard');
    }
}