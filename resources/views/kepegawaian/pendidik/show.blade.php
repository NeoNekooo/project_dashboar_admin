@extends('adminlte::page')

@section('title', 'Detail Pendidik')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Pendidik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Lengkap Pendidik</h3>
                    <div class="card-tools">
                        <a href="{{ route('kepegawaian.pendidik.edit', $pendidik->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit Data</a>
                        @if($pendidik->status == 'Aktif')
                            <form action="{{ route('kepegawaian.pendidik.deactivate', $pendidik->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan pendidik ini?');"><i class="fas fa-user-times"></i> Nonaktifkan</button>
                            </form>
                        @else
                            <form action="{{ route('kepegawaian.pendidik.activate', $pendidik->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin ingin mengaktifkan pendidik ini?');"><i class="fas fa-user-check"></i> Aktifkan</button>
                            </form>
                        @endif
                        <a href="{{ route('kepegawaian.pendidik.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="form-group">
                                <label for="foto">Foto Pendidik</label><br>
                                @if($pendidik->foto)
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $pendidik->foto)) }}" alt="Foto {{ $pendidik->nama_lengkap }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://placehold.co/200x200/cccccc/333333?text=No+Foto" alt="No Foto" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Nama Lengkap</th>
                                        <td>{{ $pendidik->gelar_depan ? $pendidik->gelar_depan . '. ' : '' }}{{ $pendidik->nama_lengkap }}{{ $pendidik->gelar_belakang ? ', ' . $pendidik->gelar_belakang : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <td>{{ $pendidik->tempat_lahir ?? '-' }}, {{ $pendidik->tanggal_lahir ? $pendidik->tanggal_lahir->format('d F Y') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $pendidik->jenis_kelamin == 'L' ? 'Laki-laki' : ($pendidik->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK/NIY/NPSN</th>
                                        <td>{{ $pendidik->nik_niy_npsn ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NUPTK</th>
                                        <td>{{ $pendidik->nuptk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP</th>
                                        <td>{{ $pendidik->nip ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NPWP</th>
                                        <td>{{ $pendidik->npwp ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kewarganegaraan</th>
                                        <td>{{ $pendidik->kewarganegaraan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>{{ $pendidik->agama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ibu Kandung</th>
                                        <td>{{ $pendidik->nama_ibu_kandung ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pernikahan</th>
                                        <td>{{ $pendidik->status_pernikahan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Suami/Istri</th>
                                        <td>{{ $pendidik->nama_suami_istri ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Anak</th>
                                        <td>{{ $pendidik->jumlah_anak ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $pendidik->alamat ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $pendidik->kecamatan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desa</th>
                                        <td>{{ $pendidik->desa ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td>{{ $pendidik->kabupaten ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $pendidik->provinsi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>{{ $pendidik->kode_pos ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kontak</th>
                                        <td>{{ $pendidik->kontak ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Jam</th>
                                        <td>{{ $pendidik->jumlah_jam ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipe Pegawai</th>
                                        <td>{{ $pendidik->tipe_pegawai ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($pendidik->status == 'Aktif')
                                                <span class="badge badge-success">{{ $pendidik->status }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $pendidik->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanda Tangan</th>
                                        <td>
                                            @if($pendidik->tandatangan)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $pendidik->tandatangan)) }}" alt="Tanda Tangan {{ $pendidik->nama_lengkap }}" class="img-thumbnail" style="max-width: 150px; max-height: 100px; object-fit: contain;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
