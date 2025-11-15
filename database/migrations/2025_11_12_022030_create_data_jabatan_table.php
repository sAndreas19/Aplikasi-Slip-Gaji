<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_jabatan', function (Blueprint $table) {
            $table->integer('id_jabatan', true);
            $table->string('nama_jabatan', 120);
            $table->string('gaji_pokok', 50);
            $table->string('uang_transport', 50);
            $table->string('uang_makan', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_jabatan');
    }
};
