@extends('adminlte::page') {{-- Menggunakan layout AdminLTE --}}

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Kelas</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daftar Kelas Per Tahun Pelajaran & Semester Aktif</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <strong>INFORMASI:</strong>
                        <ul>
                            <li>Halaman ini digunakan untuk mengelola daftar kelas.</li>
                            <li>Kelas-kelas akan terkait dengan **Tahun Pelajaran dan Semester yang saat ini aktif**.</li>
                            <li>Gunakan formulir di bawah untuk menambahkan kelas baru.</li>
                            <li>**Wali Kelas** dapat langsung diubah di tabel dan akan tersimpan otomatis.</li>
                        </ul>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <strong>Perhatian!</strong> Ada kesalahan dalam pengisian data:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Informasi Tahun Pelajaran dan Semester Aktif --}}
                    @if ($selectedTapel && $selectedSemester)
                        <div class="alert alert-secondary text-center">
                            Menampilkan data untuk Tahun Pelajaran: <strong>{{ $selectedTapel->tahun_pelajaran }}</strong> dan Semester: <strong>{{ $selectedSemester->name }}</strong>.
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Tambah Kelas Baru</h3>
                                    </div>
                                    <form action="{{ route('daftar_kelas.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-control @error('tingkat_kelas') is-invalid @enderror">
                                                    <option value="">-- Pilih Tingkat Kelas --</option>
                                                    @foreach($tingkatKelasOptions as $tingkat)
                                                        <option value="{{ $tingkat }}" {{ old('tingkat_kelas') == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tingkat_kelas') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="paket_keahlian">Paket Keahlian</label>
                                                <select name="paket_keahlian" id="paket_keahlian" class="form-control @error('paket_keahlian') is-invalid @enderror">
                                                    <option value="">-- Pilih Paket Keahlian --</option>
                                                    @foreach($paketKeahlianOptions as $paket)
                                                        <option value="{{ $paket }}" {{ old('paket_keahlian') == $paket ? 'selected' : '' }}>{{ $paket }}</option>
                                                    @endforeach
                                                </select>
                                                @error('paket_keahlian') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="rombel_grup">Rombel/Grup</label>
                                                <input type="text" name="rombel_grup" id="rombel_grup" class="form-control @error('rombel_grup') is-invalid @enderror" value="{{ old('rombel_grup') }}" placeholder="Contoh: 1, 2, A, B">
                                                @error('rombel_grup') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="wali_kelas_id">Wali Kelas</label>
                                                <select name="wali_kelas_id" id="wali_kelas_id" class="form-control @error('wali_kelas_id') is-invalid @enderror">
                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                    @foreach($pendidiks as $pendidik)
                                                        <option value="{{ $pendidik->id }}" {{ old('wali_kelas_id') == $pendidik->id ? 'selected' : '' }}>{{ $pendidik->nama_lengkap }}</option>
                                                    @endforeach
                                                </select>
                                                @error('wali_kelas_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Daftar Kelas</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;">NO</th>
                                                        <th>KELAS</th>
                                                        <th>WALI KELAS</th>
                                                        <th style="width: 150px;">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($kelas as $index => $k)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $k->tingkat_kelas }} {{ $k->paket_keahlian }} {{ $k->rombel_grup }}</td>
                                                            <td>
                                                                <select class="form-control form-control-sm update-wali-kelas" data-kelas-id="{{ $k->id }}">
                                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                                    @foreach($pendidiks as $pendidik)
                                                                        <option value="{{ $pendidik->id }}" {{ $k->wali_kelas_id == $pendidik->id ? 'selected' : '' }}>{{ $pendidik->nama_lengkap }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('daftar_kelas.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Belum ada kelas yang ditambahkan untuk Tahun Pelajaran dan Semester ini.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Tidak ada Tahun Pelajaran atau Semester yang aktif ditemukan. Mohon atur Tahun Pelajaran dan Semester yang aktif di pengaturan Anda.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk update Wali Kelas
        document.querySelectorAll('.update-wali-kelas').forEach(selectElement => {
            selectElement.addEventListener('change', async function() {
                const kelasId = this.dataset.kelasId;
                const waliKelasId = this.value; // ID pendidik yang dipilih

                try {
                    const response = await fetch('{{ route('daftar_kelas.update_wali_kelas') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            kelas_id: kelasId,
                            wali_kelas_id: waliKelasId === '' ? null : waliKelasId // Kirim null jika pilihan kosong
                        })
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        toastr.success(result.message || 'Wali Kelas berhasil diperbarui.');
                    } else {
                        toastr.error(result.message || 'Gagal memperbarui Wali Kelas.');
                    }
                } catch (error) {
                    console.error('Error updating Wali Kelas:', error);
                    toastr.error('Terjadi kesalahan jaringan atau server saat memperbarui Wali Kelas.');
                }
            });
        });

        // Inisialisasi Toastr (pastikan Toastr CSS dan JS sudah dimuat di layout AdminLTE)
        // Jika belum, tambahkan di layout Anda:
        // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        // <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        }
    });
</script>
@endpush
