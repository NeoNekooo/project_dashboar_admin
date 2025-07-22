<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTapelsTable extends Migration // Nama kelas diubah menjadi CreateTapelsTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tapel', function (Blueprint $table) { // Nama tabel diubah menjadi 'tapel'
            $table->id();
            $table->string('tahun_pelajaran', 9)->unique(); // Contoh: 2023/2024
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('tapel'); // Nama tabel diubah menjadi 'tapel'
    }
}