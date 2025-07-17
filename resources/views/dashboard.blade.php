@extends('adminlte::page')

@section('title', 'Dashboard Aplikasi')

@section('content_header')
    <h1>Dashboard Utama</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Selamat datang di Dashboard!</h3>
        </div>
        <div class="card-body">
            <p>Halo, {{ Auth::user()->name }}!</p>
            <p>Anda login sebagai **{{ Auth::user()->role }}**.</p>
            <p>Konten utama dashboard yang sama untuk semua role bisa diletakkan di sini.</p>

            @can('admin')
                <div class="alert alert-info">
                    Anda adalah Admin. Anda bisa melihat menu khusus Admin.
                </div>
            @endcan

            @can('guru')
                <div class="alert alert-warning">
                    Anda adalah Guru. Anda bisa melihat menu khusus Guru.
                </div>
            @endcan

            @can('siswa')
                <div class="alert alert-success">
                    Anda adalah Siswa. Anda bisa melihat menu khusus Siswa.
                </div>
            @endcan

            @can('user')
                @if (Auth::user()->role === 'user')
                    <div class="alert alert-secondary">
                        Anda adalah Pengguna Umum.
                    </div>
                @endif
            @endcan

        </div>
    </div>
    {{-- Di sini Anda bisa menambahkan bagian dinamis lainnya --}}
    {{-- Misalnya, Anda bisa menyertakan view parsial berdasarkan role --}}
    {{-- @includeIf('partials.' . Auth::user()->role . '_dashboard_content') --}}
@stop

@section('css')
    {{-- CSS Tambahan --}}
@stop

@section('js')
    <script> console.log('Dashboard utama dimuat!'); </script>
@stop