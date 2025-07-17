<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Optional: Jika Anda butuh data user di controller ini

class AdminController extends Controller
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
        // Middleware untuk memastikan hanya user dengan role 'admin' yang bisa mengakses
        // 'can:admin' merujuk pada Gate 'admin' yang kita definisikan di AuthServiceProvider
        $this->middleware('can:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard'); // Ini akan memanggil view 'resources/views/admin/dashboard.blade.php'
    }
}