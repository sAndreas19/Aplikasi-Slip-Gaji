<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPegawaiSeeder extends Seeder
{
    public function run(): void {
        \App\Models\DataPegawai::create([
            'nik'=>'002',
            'nama_pegawai'=>'Andreas Sihombing',
            'jenis_kelamin'=>'Laki-laki',
            'jabatan'=>'Staff',
            'tanggal_masuk'=>'2025-02-02',
            'status'=>'Tetap',
            'photo'=>null
        ]);
    }

}
