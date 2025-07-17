<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Opsional, jika Anda butuh user yang login

class GuruController extends Controller
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
        // Middleware untuk memastikan hanya user dengan role 'guru' yang bisa mengakses
        $this->middleware('can:guru');
    }

    /**
     * Show the Guru dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() // <-- Metode ini yang dicari!
    {
        // Ini akan memanggil view 'resources/views/guru/dashboard.blade.php'
        return view('guru.dashboard');
    }
}