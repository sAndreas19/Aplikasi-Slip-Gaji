<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_kehadiran', function (Blueprint $table) {
            $table->integer('id_kehadiran', true);
            $table->string('bulan', 16);
            $table->string('nik', 50);
            $table->string('nama_karyawan', 225);
            $table->string('jenis_kelamin', 20);
            $table->string('nama_jabatan', 50);
            $table->integer('hadir');
            $table->integer('sakit');
            $table->integer('alpha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kehadiran');
    }
};
