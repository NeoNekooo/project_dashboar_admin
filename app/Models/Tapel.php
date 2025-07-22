<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapel extends Model // Nama kelas model diubah menjadi Tapel
{
    use HasFactory;

    protected $table = 'tapel'; // Nama tabel diubah menjadi 'tapel'
    protected $fillable = [
        'tahun_pelajaran',
        'keterangan',
        'is_active',
    ];
}