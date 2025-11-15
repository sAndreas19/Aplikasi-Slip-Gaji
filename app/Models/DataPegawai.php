<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $table = 'data_pegawai';
    protected $primaryKey = 'id_pegawai';
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'nama_pegawai',
        'jenis_kelamin',
        'jabatan',
        'tanggal_masuk',
        'status',
        'photo'
    ];
}