<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk akses storage di accessor

class Pendidik extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama_lengkap',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nik_niy_npsn',
        'nuptk',
        'nip',
        'npwp',
        'kewarganegaraan',
        'agama',
        'nama_ibu_kandung',
        'status_pernikahan',
        'nama_suami_istri',
        'jumlah_anak',
        'alamat',
        'kecamatan',
        'desa',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'kontak',
        'tandatangan',
        'jumlah_jam',
        'tipe_pegawai',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Accessor untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : asset('vendor/adminlte/dist/img/avatar.png');
    }

    // Accessor untuk mendapatkan URL tanda tangan
    public function getTandatanganUrlAttribute()
    {
        return $this->tandatangan ? Storage::url($this->tandatangan) : asset('vendor/adminlte/dist/img/no-signature.png');
    }
}