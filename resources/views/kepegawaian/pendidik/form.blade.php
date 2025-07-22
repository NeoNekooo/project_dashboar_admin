@extends('adminlte::page')

@section('title', isset($pendidik) && $pendidik->exists ? 'Ubah Pendidik' : 'Tambah Pendidik')

@section('content_header')
    <h1 class="m-0 text-dark">{{ isset($pendidik) && $pendidik->exists ? 'Ubah' : 'Tambah' }} Pendidik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulir Pendidik</h3>
                </div>
                {{-- Tambahkan pemeriksaan $pendidik->exists untuk memastikan objek Pendidik benar-benar ada di database --}}
                @if (isset($pendidik) && $pendidik->exists)
                    <form action="{{ route('kepegawaian.pendidik.update', $pendidik->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('kepegawaian.pendidik.store') }}" method="POST"
                            enctype="multipart/form-data">
                @endif
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-outline card-primary mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-camera mr-2"></i>
                                        Pas Foto
                                    </h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="position-relative d-inline-block mb-3">
                                        <img src="{{ isset($pendidik) && $pendidik->foto_url ? url('storage/' . $pendidik->foto_url) : asset('vendor/adminlte/dist/img/avatar.png') }}"
                                            id="previewFoto" alt="Preview Foto"
                                            class="img-thumbnail rounded-circle shadow-sm"
                                            style="width: 180px; height: 180px; object-fit: cover; border: 3px solid #dee2e6;">
                                        <label for="foto"
                                            class="btn btn-primary btn-sm position-absolute rounded-circle shadow"
                                            style="bottom: 10px; right: 10px; width: 36px; height: 36px; line-height: 20px;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="foto"
                                            class="d-none @error('foto') is-invalid @enderror" id="foto"
                                            accept="image/*">
                                        <small class="form-text text-muted d-block">
                                            Format: JPG/PNG (Maks. 2MB)<br>
                                            Ukuran disarankan: 300x300 px
                                        </small>
                                        @error('foto')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Signature Upload Section -->
                        <div class="col-md-6">
                            <div class="card card-outline card-info mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-signature mr-2"></i>
                                        Tanda Tangan
                                    </h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="position-relative d-inline-block mb-3">
                                        <img src="{{ isset($pendidik) && $pendidik->tandatangan_url ? url('storage/' . $pendidik->tandatangan_url) : asset('vendor/adminlte/dist/img/no-signature.png') }}"
                                            id="previewTandatangan" alt="Preview Tanda Tangan"
                                            class="img-thumbnail shadow-sm"
                                            style="width: 200px; height: 100px; object-fit: contain; background-color: #f8f9fa; border: 3px solid #dee2e6;">
                                        <label for="tandatangan" class="btn btn-info btn-sm position-absolute shadow"
                                            style="bottom: 10px; right: 10px; width: 36px; height: 36px; line-height: 20px;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="tandatangan"
                                            class="d-none @error('tandatangan') is-invalid @enderror" id="tandatangan"
                                            accept="image/*">
                                        <small class="form-text text-muted d-block">
                                            Format: PNG dengan latar transparan<br>
                                            Ukuran disarankan: 400x200 px
                                        </small>
                                        @error('tandatangan')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap"
                                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            id="nama_lengkap" placeholder="Masukkan Nama Lengkap"
                                            value="{{ old('nama_lengkap', $pendidik->nama_lengkap ?? '') }}" required>
                                        @error('nama_lengkap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_depan">Gelar Depan</label>
                                        <input type="text" name="gelar_depan"
                                            class="form-control @error('gelar_depan') is-invalid @enderror" id="gelar_depan"
                                            placeholder="Contoh: Drs."
                                            value="{{ old('gelar_depan', $pendidik->gelar_depan ?? '') }}">
                                        @error('gelar_depan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_belakang">Gelar Belakang</label>
                                        <input type="text" name="gelar_belakang"
                                            class="form-control @error('gelar_belakang') is-invalid @enderror"
                                            id="gelar_belakang" placeholder="Contoh: S.Pd., M.Si."
                                            value="{{ old('gelar_belakang', $pendidik->gelar_belakang ?? '') }}">
                                        @error('gelar_belakang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" placeholder="Masukkan Tempat Lahir"
                                            value="{{ old('tempat_lahir', $pendidik->tempat_lahir ?? '') }}">
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', isset($pendidik) && $pendidik->tanggal_lahir ? \Carbon\Carbon::parse($pendidik->tanggal_lahir)->format('Y-m-d') : '') }}">
                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="lakiLaki" value="L"
                                                {{ old('jenis_kelamin', $pendidik->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="perempuan" value="P"
                                                {{ old('jenis_kelamin', $pendidik->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                        @error('jenis_kelamin')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror"
                                            id="agama">
                                            <option value="">- Pilih -</option>
                                            <option value="Islam"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Buddha"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Buddha' ? 'selected' : '' }}>
                                                Buddha</option>
                                            <option value="Konghucu"
                                                {{ old('agama', $pendidik->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                        </select>
                                        @error('agama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kewarganegaraan">Kewarganegaraan</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kewarganegaraan"
                                                id="wni" value="WNI"
                                                {{ old('kewarganegaraan', $pendidik->kewarganegaraan ?? '') == 'WNI' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="wni">WNI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kewarganegaraan"
                                                id="wna" value="WNA"
                                                {{ old('kewarganegaraan', $pendidik->kewarganegaraan ?? '') == 'WNA' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="wna">WNA</label>
                                        </div>
                                        @error('kewarganegaraan')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                                        <input type="text" name="nama_ibu_kandung"
                                            class="form-control @error('nama_ibu_kandung') is-invalid @enderror"
                                            id="nama_ibu_kandung" placeholder="Masukkan Nama Ibu Kandung"
                                            value="{{ old('nama_ibu_kandung', $pendidik->nama_ibu_kandung ?? '') }}">
                                        @error('nama_ibu_kandung')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik_niy_npsn">NIK/No. Passport (Untuk WNA)</label>
                                        <input type="text" name="nik_niy_npsn"
                                            class="form-control @error('nik_niy_npsn') is-invalid @enderror"
                                            id="nik_niy_npsn" placeholder="NIK/No. Passport"
                                            value="{{ old('nik_niy_npsn', $pendidik->nik_niy_npsn ?? '') }}">
                                        @error('nik_niy_npsn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_pernikahan">Status Pernikahan</label>
                                        <select name="status_pernikahan"
                                            class="form-control @error('status_pernikahan') is-invalid @enderror"
                                            id="status_pernikahan">
                                            <option value="">- Pilih -</option>
                                            <option value="Belum Menikah"
                                                {{ old('status_pernikahan', $pendidik->status_pernikahan ?? '') == 'Belum Menikah' ? 'selected' : '' }}>
                                                Belum Menikah</option>
                                            <option value="Menikah"
                                                {{ old('status_pernikahan', $pendidik->status_pernikahan ?? '') == 'Menikah' ? 'selected' : '' }}>
                                                Menikah</option>
                                            <option value="Cerai Hidup"
                                                {{ old('status_pernikahan', $pendidik->status_pernikahan ?? '') == 'Cerai Hidup' ? 'selected' : '' }}>
                                                Cerai Hidup</option>
                                            <option value="Cerai Mati"
                                                {{ old('status_pernikahan', $pendidik->status_pernikahan ?? '') == 'Cerai Mati' ? 'selected' : '' }}>
                                                Cerai Mati</option>
                                        </select>
                                        @error('status_pernikahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nuptk">NUPTK</label>
                                        <input type="text" name="nuptk"
                                            class="form-control @error('nuptk') is-invalid @enderror" id="nuptk"
                                            placeholder="NUPTK" value="{{ old('nuptk', $pendidik->nuptk ?? '') }}">
                                        @error('nuptk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_suami_istri">Nama Suami/Istri</label>
                                        <input type="text" name="nama_suami_istri"
                                            class="form-control @error('nama_suami_istri') is-invalid @enderror"
                                            id="nama_suami_istri" placeholder="Nama Suami/Istri"
                                            value="{{ old('nama_suami_istri', $pendidik->nama_suami_istri ?? '') }}">
                                        @error('nama_suami_istri')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip"
                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                            placeholder="NIP" value="{{ old('nip', $pendidik->nip ?? '') }}">
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_anak">Jumlah Anak</label>
                                        <input type="number" name="jumlah_anak"
                                            class="form-control @error('jumlah_anak') is-invalid @enderror"
                                            id="jumlah_anak" placeholder="Jumlah Anak"
                                            value="{{ old('jumlah_anak', $pendidik->jumlah_anak ?? '0') }}">
                                        @error('jumlah_anak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="npwp">NPWP</label>
                                        <input type="text" name="npwp"
                                            class="form-control @error('npwp') is-invalid @enderror" id="npwp"
                                            placeholder="NPWP" value="{{ old('npwp', $pendidik->npwp ?? '') }}">
                                        @error('npwp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kontak">Kontak</label>
                                        <input type="text" name="kontak"
                                            class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                                            placeholder="Nomor kontak yang bisa dihubungi"
                                            value="{{ old('kontak', $pendidik->kontak ?? '') }}">
                                        @error('kontak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr> {{-- Garis pemisah --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3"
                                    placeholder="Masukkan Alamat Lengkap">{{ old('alamat', $pendidik->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" name="provinsi"
                                    class="form-control @error('provinsi') is-invalid @enderror" id="provinsi"
                                    placeholder="Provinsi" value="{{ old('provinsi', $pendidik->provinsi ?? '') }}">
                                @error('provinsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input type="text" name="kabupaten"
                                    class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten"
                                    placeholder="Kabupaten" value="{{ old('kabupaten', $pendidik->kabupaten ?? '') }}">
                                @error('kabupaten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" name="kecamatan"
                                    class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan"
                                    placeholder="Kecamatan" value="{{ old('kecamatan', $pendidik->kecamatan ?? '') }}">
                                @error('kecamatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <input type="text" name="desa"
                                    class="form-control @error('desa') is-invalid @enderror" id="desa"
                                    placeholder="Desa" value="{{ old('desa', $pendidik->desa ?? '') }}">
                                @error('desa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" name="kode_pos"
                                    class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos"
                                    placeholder="Kode Pos" value="{{ old('kode_pos', $pendidik->kode_pos ?? '') }}">
                                @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr> {{-- Garis pemisah --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipe_pegawai">Tipe Pegawai</label>
                                <select name="tipe_pegawai"
                                    class="form-control @error('tipe_pegawai') is-invalid @enderror" id="tipe_pegawai">
                                    {{-- Default ke 'Pendidik' --}}
                                    <option value="Pendidik"
                                        {{ old('tipe_pegawai', $pendidik->tipe_pegawai ?? 'Pendidik') == 'Pendidik' ? 'selected' : '' }}>
                                        Pendidik</option>
                                    <option value="Tenaga Kependidikan"
                                        {{ old('tipe_pegawai', $pendidik->tipe_pegawai ?? '') == 'Tenaga Kependidikan' ? 'selected' : '' }}>
                                        Tenaga Kependidikan</option>
                                </select>
                                @error('tipe_pegawai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_jam">Jumlah Jam</label>
                                <input type="number" name="jumlah_jam"
                                    class="form-control @error('jumlah_jam') is-invalid @enderror" id="jumlah_jam"
                                    placeholder="Jumlah Jam Mengajar/Tugas"
                                    value="{{ old('jumlah_jam', $pendidik->jumlah_jam ?? '0') }}">
                                @error('jumlah_jam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror"
                                    id="status">
                                    <option value="Aktif"
                                        {{ old('status', $pendidik->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Tidak Aktif"
                                        {{ old('status', $pendidik->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('kepegawaian.pendidik.index') }}" class="btn btn-danger"><i
                            class="fas fa-times"></i> Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            // Preview Foto
            $('#foto').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewFoto').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Preview Tanda Tangan
            $('#tandatangan').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewTandatangan').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
