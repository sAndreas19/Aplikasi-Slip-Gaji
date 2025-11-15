<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataJabatan extends Model
{
    protected $table = 'data_jabatan';
    // Primary key
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
        'uang_transport',
        'uang_makan',
    ];
}
