@extends('adminlte::page')

@section('title', 'Daftar Pendidik Aktif')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Pendidik Aktif</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pendidik Aktif</h3>
                    <div class="card-tools">
                        <a href="{{ route('kepegawaian.pendidik.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
                        <a href="{{ route('kepegawaian.pendidik.inactive') }}" class="btn btn-sm btn-warning"><i class="fas fa-user-times"></i> Lihat Tidak Aktif</a>
                        <button type="button" class="btn btn-sm btn-info"><i class="fas fa-file-export"></i> Export</button>
                        <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">NO</th>
                                <th style="width: 80px">FOTO</th>
                                <th>NAMA PEGAWAI</th>
                                <th>L/P</th>
                                <th>JML JAM</th>
                                <th>TIPE PEGAWAI</th>
                                <th>STATUS</th>
                                <th style="width: 180px">AKSI</th> {{-- Lebarkan kolom Aksi untuk tombol tambahan --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendidiks as $pendidik)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{-- Perbaikan di sini untuk menampilkan foto --}}
                                        @if($pendidik->foto)
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $pendidik->foto)) }}" alt="Foto {{ $pendidik->nama_lengkap }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="https://placehold.co/60x60/cccccc/333333?text=No+Foto" alt="No Foto" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pendidik->gelar_depan ? $pendidik->gelar_depan . '. ' : '' }}{{ $pendidik->nama_lengkap }}{{ $pendidik->gelar_belakang ? ', ' . $pendidik->gelar_belakang : '' }}
                                        <br>NIP/NIY/NIGK: {{ $pendidik->nik_niy_npsn ?? '-' }}
                                        <br>TTL: {{ $pendidik->tempat_lahir ?? '-' }}, {{ $pendidik->tanggal_lahir ? $pendidik->tanggal_lahir->format('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $pendidik->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $pendidik->jumlah_jam ?? '0' }}</td>
                                    <td>{{ $pendidik->tipe_pegawai ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-success">{{ $pendidik->status }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Aksi Pendidik">
                                            <a href="{{ route('kepegawaian.pendidik.show', $pendidik->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('kepegawaian.pendidik.edit', $pendidik->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- Tombol Nonaktifkan --}}
                                            <form action="{{ route('kepegawaian.pendidik.deactivate', $pendidik->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning" title="Nonaktifkan" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan pendidik ini?');">
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </form>
                                            {{-- Tombol Hapus (menggunakan modal) --}}
                                            <button type="button" class="btn btn-sm btn-danger delete-pendidik-btn"
                                                    data-toggle="modal" data-target="#confirmDeleteModal"
                                                    data-id="{{ $pendidik->id }}"
                                                    data-name="{{ $pendidik->nama_lengkap }}"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pendidik aktif.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Penghapusan --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data Pendidik: **<span id="pendidikNameToDelete"></span>**?
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deletePendidikForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function() {
        // Skrip untuk modal konfirmasi penghapusan
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pendidikId = button.data('id'); // Ekstrak info dari atribut data-*
            var pendidikName = button.data('name');

            var modal = $(this);
            modal.find('#pendidikNameToDelete').text(pendidikName); // Perbarui nama pendidik di modal

            var form = modal.find('#deletePendidikForm');
            var actionUrl = "{{ route('kepegawaian.pendidik.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', pendidikId); // Ganti placeholder :id dengan ID aktual
            form.attr('action', actionUrl); // Set action URL formulir
        });
    });
</script>
@endpush
