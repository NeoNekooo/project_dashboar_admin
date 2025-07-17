<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    // Mengatur nama tabel secara eksplisit karena nama model tidak jamak dari 'instansi'
    protected $table = 'instansis';

    protected $fillable = [
        'nama_instansi',
        'bidang_studi',
        'singkatan',
        'tahun_berdiri',
        'status',
        'nss',
        'kode',
        'npsn',
        'nama_kepala_aktif',
        'luas',
        'nip_kepala_aktif',
        'moto',
        'logo',
        'icon',
        'alamat',
        'telpon',
        'skype',
        'desa',
        'kecamatan',
        'email',
        'rss',
        'kabupaten',
        'situs',
        'google_plus',
        'provinsi',
        'facebook',
        'dribble',
        'kode_pos',
        'x',
        'youtube',
        'map',
    ];
}