<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('data_kehadiran', function (Blueprint $table) {
            $table->renameColumn('nama_karyawan', 'nama_pegawai');
        });
    }

    public function down(): void
    {
        Schema::table('data_kehadiran', function (Blueprint $table) {
            $table->renameColumn('nama_pegawai', 'nama_karyawan');
        });
    }
};
