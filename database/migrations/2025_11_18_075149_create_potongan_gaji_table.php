<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('potongan_gaji', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('jenis_potongan', 120);
            $table->string('jlh_potongan', 25);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potongan_gaji');
    }
};
