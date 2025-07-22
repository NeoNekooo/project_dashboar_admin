@extends('adminlte::page')

@section('title', 'Daftar Semester')

@section('content_header')
    <h1>Daftar Semester</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="alert alert-info" role="alert">
                <p><strong>Informasi:</strong></p>
                <p>1. <i class="fas fa-check-circle text-success"></i> adalah semester yang aktif</p>
                <p>2. Klik ikon <i class="fas fa-check-circle text-success"></i> untuk menonaktifkan atau <i class="fas fa-ban text-danger"></i> untuk mengaktifkan semester.</p>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">NO</th>
                        <th>SEMESTER</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($semesters as $semester)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->description }}</td>
                            <td>
                                <form action="{{ route('semesters.update', $semester->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    @if ($semester->is_active)
                                        {{-- Jika semester aktif, tampilkan ikon cek yang bisa diklik untuk menonaktifkan --}}
                                        <input type="hidden" name="deactivate" value="true">
                                        <button type="submit" class="btn btn-sm text-success" title="Nonaktifkan Semester">
                                            <i class="fas fa-check-circle"></i> {{-- Ikon status aktif yang bisa diklik --}}
                                        </button>
                                    @else
                                        {{-- Jika semester tidak aktif, tampilkan ikon ban yang bisa diklik untuk mengaktifkan --}}
                                        <input type="hidden" name="activate" value="true">
                                        <button type="submit" class="btn btn-sm text-danger" title="Aktifkan Semester">
                                            <i class="fas fa-ban"></i> {{-- Ikon status tidak aktif yang bisa diklik --}}
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- Add any specific CSS for this page if needed --}}
@stop

@section('js')
    {{-- Add any specific JS for this page if needed --}}
@stop
