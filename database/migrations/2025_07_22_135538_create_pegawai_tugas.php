<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pegawai_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pendidiks')->onDelete('cascade');
            $table->foreignId('tapel_id')->constrained('tapel')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->integer('tipe'); // 1 = Tugas Pokok, 2 = Tugas Tambahan
            $table->integer('jenis_id')->nullable(); // ID jenis tugas (misal: 1=Pendidik, 2=Panitia A)
            $table->date('tanggal'); // Tanggal ditetapkan tugas
            $table->date('tmt'); // Terhitung Mulai Tanggal
            $table->string('nomor_sk')->nullable();
            $table->string('file_sk')->nullable(); // Path ke file SK yang diupload
            $table->integer('jumlah_jam')->default(0)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['pegawai_id', 'tapel_id', 'semester_id', 'tipe', 'jenis_id'], 'unique_pegawai_tugas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai_tugas');
    }
};
