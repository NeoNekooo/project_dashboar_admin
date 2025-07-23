<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Nama tabel di database
    protected $fillable = [
        'tapel_id',
        'semester_id',
        'tingkat_kelas',
        'paket_keahlian',
        'rombel_grup',
        'wali_kelas_id',
    ];

    /**
     * Relasi ke model Pendidik (Wali Kelas).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waliKelas()
    {
        return $this->belongsTo(Pendidik::class, 'wali_kelas_id', 'id');
    }

    /**
     * Relasi ke model Tapel (Tahun Pelajaran).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }

    /**
     * Relasi ke model Semester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
