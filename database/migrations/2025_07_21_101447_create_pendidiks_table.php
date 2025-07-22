<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidiks', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable(); // Untuk menyimpan path foto
            $table->string('nama_lengkap');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 1)->nullable(); // L/P
            $table->string('nik_niy_npsn')->nullable()->unique(); // NIK/NIY/NPSN, bisa juga disebut NIP/NIY/NIGK/NUPTK
            $table->string('nuptk')->nullable()->unique(); // NUPTK
            $table->string('nip')->nullable()->unique(); // NIP
            $table->string('npwp')->nullable(); // NPWP
            $table->string('kewarganegaraan')->nullable(); // WNI/WNA
            $table->string('agama')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('nama_suami_istri')->nullable();
            $table->integer('jumlah_anak')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kontak')->nullable(); // Nomor kontak
            $table->string('tandatangan')->nullable(); // Untuk menyimpan path tanda tangan
            $table->integer('jumlah_jam')->default(0); // Sesuai "JML JAM" di foto
            $table->string('tipe_pegawai')->default('Pendidik'); // Default ke 'Pendidik'
            $table->string('status')->default('Aktif'); // Default ke 'Aktif'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendidiks');
    }
}