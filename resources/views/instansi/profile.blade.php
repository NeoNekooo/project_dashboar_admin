@extends('adminlte::page')

@section('content')
    {{-- Mengubah container menjadi container-fluid untuk lebar penuh --}}
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white py-3">
                <h4 class="mb-0">{{ __('Profil Instansi') }}</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ups!</strong> Ada masalah dengan input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('instansi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <ul class="nav nav-tabs mb-3" id="instansiTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-toggle="tab" data-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gambar-tab" data-toggle="tab" data-target="#gambar" type="button" role="tab" aria-controls="gambar" aria-selected="false">Gambar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="alamat-tab" data-toggle="tab" data-target="#alamat" type="button" role="tab" aria-controls="alamat" aria-selected="false">Alamat & Kontak</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="peta-tab" data-toggle="tab" data-target="#peta" type="button" role="tab" aria-controls="peta" aria-selected="false">Peta</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="instansiTabContent">
                        {{-- Tab Profil --}}
                        <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi', $instansi->nama_instansi) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="singkatan" class="form-label">Singkatan / Inisial</label>
                                        <input type="text" class="form-control" id="singkatan" name="singkatan" value="{{ old('singkatan', $instansi->singkatan) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $instansi->status) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kode" class="form-label">Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $instansi->kode) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_kepala_aktif" class="form-label">Nama Kepala Aktif</label>
                                        <input type="text" class="form-control" id="nama_kepala_aktif" name="nama_kepala_aktif" value="{{ old('nama_kepala_aktif', $instansi->nama_kepala_aktif) }}">
                                        <small class="form-text text-muted">Diisi dari menu Kepegawaian->tugas pegawai->tugas tambahan</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip_kepala_aktif" class="form-label">NIP/NY Kepala Aktif</label>
                                        <input type="text" class="form-control" id="nip_kepala_aktif" name="nip_kepala_aktif" value="{{ old('nip_kepala_aktif', $instansi->nip_kepala_aktif) }}">
                                        <small class="form-text text-muted">Diisi dari menu Kepegawaian->data pegawai</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bidang_studi" class="form-label">Bidang Studi</label>
                                        <input type="text" class="form-control" id="bidang_studi" name="bidang_studi" value="{{ old('bidang_studi', $instansi->bidang_studi) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                        <input type="number" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $instansi->tahun_berdiri) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nss" class="form-label">NSS</label>
                                        <input type="text" class="form-control" id="nss" name="nss" value="{{ old('nss', $instansi->nss) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="npsn" class="form-label">NPSN</label>
                                        <input type="text" class="form-control" id="npsn" name="npsn" value="{{ old('npsn', $instansi->npsn) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="luas" class="form-label">Luas</label>
                                        <input type="text" class="form-control" id="luas" name="luas" value="{{ old('luas', $instansi->luas) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="moto" class="form-label">Moto</label>
                                        <textarea class="form-control" id="moto" name="moto" rows="3">{{ old('moto', $instansi->moto) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Gambar --}}
                        <div class="tab-pane fade" id="gambar" role="tabpanel" aria-labelledby="gambar-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo Instansi</label>
                                        <input class="form-control" type="file" id="logo" name="logo">
                                        @if ($instansi->logo)
                                            <small class="form-text text-muted mt-2">Logo saat ini: <br>
                                                <img src="{{ Storage::url($instansi->logo) }}" alt="Logo Instansi" style="max-width: 150px; height: auto;">
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon Instansi</label>
                                        <input class="form-control" type="file" id="icon" name="icon">
                                        @if ($instansi->icon)
                                            <small class="form-text text-muted mt-2">Icon saat ini: <br>
                                                <img src="{{ Storage::url($instansi->icon) }}" alt="Icon Instansi" style="max-width: 50px; height: auto;">
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Alamat & Kontak --}}
                        <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $instansi->alamat) }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Desa</label>
                                        <input type="text" class="form-control" id="desa" name="desa" value="{{ old('desa', $instansi->desa) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $instansi->kecamatan) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
                                        <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $instansi->kabupaten) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $instansi->provinsi) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kode_pos" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $instansi->kode_pos) }}">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4"> {{-- Garis pemisah untuk membedakan alamat dan kontak --}}

                            <h5>Kontak & Media Sosial</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telpon" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" id="telpon" name="telpon" value="{{ old('telpon', $instansi->telpon) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $instansi->email) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="situs" class="form-label">Situs Web (URL)</label>
                                        <input type="url" class="form-control" id="situs" name="situs" value="{{ old('situs', $instansi->situs) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rss" class="form-label">RSS (URL)</label>
                                        <input type="url" class="form-control" id="rss" name="rss" value="{{ old('rss', $instansi->rss) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook (URL)</label>
                                        <input type="url" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $instansi->facebook) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="x" class="form-label">X / Twitter (URL)</label>
                                        <input type="url" class="form-control" id="x" name="x" value="{{ old('x', $instansi->x) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">YouTube (URL)</label>
                                        <input type="url" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', $instansi->youtube) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="skype" class="form-label">Skype</label>
                                        <input type="text" class="form-control" id="skype" name="skype" value="{{ old('skype', $instansi->skype) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="google_plus" class="form-label">Google Plus (URL)</label>
                                        <input type="url" class="form-control" id="google_plus" name="google_plus" value="{{ old('google_plus', $instansi->google_plus) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dribble" class="form-label">Dribble (URL)</label>
                                        <input type="url" class="form-control" id="dribble" name="dribble" value="{{ old('dribble', $instansi->dribble) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Peta --}}
                        <div class="tab-pane fade" id="peta" role="tabpanel" aria-labelledby="peta-tab">
                            <div class="mb-3">
                                <label for="map" class="form-label">Kode Embed Peta (Google Maps)</label>
                                <textarea class="form-control" id="map" name="map" rows="5" placeholder="Tempelkan kode embed dari Google Maps di sini">{{ old('map', $instansi->map) }}</textarea>
                                <small class="form-text text-muted">
                                    Untuk mendapatkan kode embed, buka Google Maps, cari lokasi, klik 'Bagikan', pilih 'Sematkan peta', lalu salin kode HTML-nya.
                                </small>
                                @if ($instansi->map)
                                    <div class="mt-3">
                                        <h6>Pratinjau Peta:</h6>
                                        {!! $instansi->map !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> {{-- End Tab Content --}}

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengaktifkan tab berdasarkan hash di URL
            function activateTabFromHash() {
                var hash = window.location.hash; // Mengambil hash dari URL
                if (hash && hash !== '#') {
                    // Mencari tombol tab yang data-target-nya cocok dengan hash
                    var targetTabSelector = 'button[data-target="' + hash + '"]';
                    if ($(targetTabSelector).length > 0) { // Pastikan elemen ditemukan
                        $(targetTabSelector).tab('show');
                    } else {
                        // Jika hash tidak cocok dengan tab yang ada, fallback ke tab profil
                        $('#profil-tab').tab('show');
                    }
                } else {
                    // Jika tidak ada hash, aktifkan tab profil secara default
                    $('#profil-tab').tab('show');
                }
            }

            // Panggil fungsi saat halaman pertama kali dimuat
            activateTabFromHash();

            // Panggil fungsi ketika ada perubahan hash di URL (misalnya dari klik sidebar)
            // Ini sangat penting untuk kasus Anda!
            $(window).on('hashchange', function() {
                activateTabFromHash();
            });

            // Aktifkan tab saat tombol tab di dalam halaman diklik
            $('#instansiTabs button[data-toggle="tab"]').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');

                // Opsional: Perbarui URL hash saat tab diklik di dalam halaman
                // Ini membantu menjaga sinkronisasi URL dengan tab yang aktif
                var newHash = $(this).attr('data-target');
                if (history.pushState) {
                    history.pushState(null, null, newHash);
                } else {
                    window.location.hash = newHash;
                }
            });

            // Opsional: Listener untuk saat tab ditampilkan
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // console.log('Tab diubah ke:', $(e.target).attr('data-target'));
            });
        });
    </script>
@stop