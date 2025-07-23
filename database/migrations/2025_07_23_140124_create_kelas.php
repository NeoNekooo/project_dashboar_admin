<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id(); // Ini akan membuat kolom 'id' sebagai UNSIGNED BIGINT
            $table->foreignId('tapel_id')->constrained('tapel')->onDelete('cascade'); // Foreign key ke tabel 'tapel'
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade'); // Foreign key ke tabel 'semesters'
            $table->string('tingkat_kelas'); // Contoh: X, XI, XII
            $table->string('paket_keahlian'); // Contoh: AKL, PPLG, DKV
            $table->string('rombel_grup'); // Contoh: 1, 2, A, B
            $table->foreignId('wali_kelas_id')->nullable()->constrained('pendidiks')->onDelete('set null'); // Foreign key ke tabel 'pendidiks'
            $table->timestamps();

            // Baris unique constraint ini DIHAPUS sesuai permintaan Anda.
            // Validasi keunikan akan ditangani di DaftarKelasController.
            // $table->unique(['tapel_id', 'semester_id', 'tingkat_kelas', 'paket_keahlian', 'rombel_grup'], 'unique_kelas_per_semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
