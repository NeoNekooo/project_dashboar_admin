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
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi')->nullable();
            $table->string('bidang_studi')->nullable();
            $table->string('singkatan')->nullable();
            $table->integer('tahun_berdiri')->nullable();
            $table->string('status')->nullable();
            $table->string('nss')->nullable();
            $table->string('kode')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nama_kepala_aktif')->nullable();
            $table->string('luas')->nullable(); // Misal: "25000 m2" atau hanya angka
            $table->string('nip_kepala_aktif')->nullable();
            $table->text('moto')->nullable();
            $table->string('logo')->nullable(); // Path gambar logo
            $table->string('icon')->nullable(); // Path gambar icon
            $table->text('alamat')->nullable();
            $table->string('telpon')->nullable();
            $table->string('skype')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('email')->nullable();
            $table->string('rss')->nullable(); // Biasanya URL feed RSS
            $table->string('kabupaten')->nullable();
            $table->string('situs')->nullable(); // URL situs web
            $table->string('google_plus')->nullable(); // URL Google Plus
            $table->string('provinsi')->nullable();
            $table->string('facebook')->nullable(); // URL Facebook
            $table->string('dribble')->nullable(); // URL Dribble
            $table->string('kode_pos')->nullable();
            $table->string('x')->nullable(); // URL Twitter/X
            $table->string('youtube')->nullable(); // URL YouTube
            $table->text('map')->nullable(); // Bisa link embed Google Maps atau koordinat
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};