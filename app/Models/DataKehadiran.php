<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKehadiran extends Model
{
    protected $table = 'data_kehadiran';
    protected $primaryKey = 'id_kehadiran';
    public $timestamps = false;

    protected $fillable = [
        'bulan',
        'nik',
        'nama_karyawan',
        'jenis_kelamin',
        'nama_jabatan',
        'hadir',
        'sakit',
        'alpha',
    ];
}
