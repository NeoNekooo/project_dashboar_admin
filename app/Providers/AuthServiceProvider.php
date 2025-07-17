<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- PASTIKAN INI DIIMPORT

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // --- Definisi Gates untuk Role ---
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('guru', function ($user) {
            return $user->role === 'guru';
        });

        Gate::define('siswa', function ($user) {
            return $user->role === 'siswa';
        });

        // Gate umum untuk semua pengguna terautentikasi (role apapun)
        Gate::define('user', function ($user) {
            return $user !== null; // Semua pengguna yang login bisa mengakses gate ini
        });
        // --- Akhir Definisi Gates ---
    }
}