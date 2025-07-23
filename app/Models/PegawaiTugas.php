<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiTugas extends Model
{
    use HasFactory;

    protected $table = 'pegawai_tugas';

    protected $fillable = [
        'pegawai_id', 'tapel_id', 'semester_id', 'tipe', 'jenis_id',
        'tanggal', 'tmt', 'nomor_sk', 'file_sk', 'jumlah_jam', 'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tmt' => 'date',
    ];

    // Relasi ke Pendidik
    public function pegawai()
    {
        return $this->belongsTo(Pendidik::class, 'pegawai_id');
    }

    // Relasi ke Tapel
    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tapel_id');
    }

    // Relasi ke Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}