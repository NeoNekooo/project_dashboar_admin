@extends('adminlte::page')

@section('title', 'Tahun Pelajaran')

@section('content_header')
    <h1 class="m-0 text-dark">Tahun Pelajaran</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulir</h3>
                </div>
                {{-- Cek apakah variabel $tapel (sebagai single model instance untuk edit) ada dan merupakan instance dari model Tapel --}}
                @if(isset($tapel) && $tapel instanceof \App\Models\Tapel)
                    <form action="{{ route('akademik.tapel.update', $tapel->id) }}" method="POST">
                    @method('PUT')
                @else
                    <form action="{{ route('akademik.tapel.store') }}" method="POST">
                @endif
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tahun_pelajaran">Tahun Pelajaran</label>
                            {{-- Gunakan $tapel->tahun_pelajaran jika ada, jika tidak kosongkan --}}
                            <input type="text" name="tahun_pelajaran" class="form-control @error('tahun_pelajaran') is-invalid @enderror" id="tahun_pelajaran" placeholder="Ex: 2023/2024" value="{{ old('tahun_pelajaran', ($tapel->tahun_pelajaran ?? '')) }}" required>
                            @error('tahun_pelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            {{-- Gunakan $tapel->keterangan jika ada, jika tidak kosongkan --}}
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" rows="3">{{ old('keterangan', ($tapel->keterangan ?? '')) }}</textarea>
                            @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('akademik.tapel.index') }}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tahun Pelajaran</h3>
                    <div class="card-tools">
                        @if($activeTapel)
                            <span class="badge badge-success">Aktif: {{ $activeTapel->tahun_pelajaran }}</span>
                        @else
                            <span class="badge badge-warning">Belum ada tahun pelajaran aktif.</span>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        <h5><i class="icon fas fa-info"></i> Informasi:</h5>
                        <ol class="mb-0">
                            <li><i class="fas fa-check-circle text-success"></i> adalah tahun pelajaran yang aktif</li>
                            <li>Klik <i class="fas fa-check-circle text-secondary"></i> untuk mengaktifkan tahun pelajaran</li>
                        </ol>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">NO</th>
                                <th>TAHUN PELAJARAN</th>
                                <th>KETERANGAN</th>
                                <th style="width: 150px">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Gunakan $allTapel untuk iterasi tabel --}}
                            @forelse($allTapel as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun_pelajaran }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($item->is_active)
                                                <i class="fas fa-check-circle text-success mt-2 mr-2" title="Tahun Pelajaran Aktif"></i>
                                            @else
                                                <form action="{{ route('akademik.tapel.toggle-active', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-link text-info" title="Aktifkan Tahun Pelajaran">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('akademik.tapel.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- Ubah tombol delete untuk memicu modal --}}
                                            <button type="button" class="btn btn-sm btn-danger delete-tapel-btn"
                                                    data-toggle="modal" data-target="#confirmDeleteModal"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->tahun_pelajaran }}"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data tahun pelajaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
    </div>

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
                    Apakah Anda yakin ingin menghapus Tahun Pelajaran: **<span id="tapelNameToDelete"></span>**?
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteTapelForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

{{-- Tambahkan script JS di bagian @push('js') --}}
@push('js')
<script>
    $(document).ready(function() {
        // Ketika modal delete tampil
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var tapelId = button.data('id'); // Ambil data-id dari tombol
            var tapelName = button.data('name'); // Ambil data-name dari tombol

            var modal = $(this);
            // Isi nama tahun pelajaran ke dalam span di modal
            modal.find('#tapelNameToDelete').text(tapelName);

            // Set action URL untuk form delete di dalam modal
            var form = modal.find('#deleteTapelForm');
            var actionUrl = "{{ route('akademik.tapel.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', tapelId);
            form.attr('action', actionUrl);
        });
    });
</script>
@endpush