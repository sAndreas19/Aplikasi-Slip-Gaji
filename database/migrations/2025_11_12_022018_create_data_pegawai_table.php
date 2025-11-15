<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->integer('id_pegawai', true);
            $table->string('nik', 50);
            $table->string('nama_pegawai', 225);
            $table->string('jenis_kelamin', 20);
            $table->string('jabatan', 50);
            $table->date('tanggal_masuk');
            $table->string('status', 20);
            $table->string('photo', 225)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pegawai');
    }
};
