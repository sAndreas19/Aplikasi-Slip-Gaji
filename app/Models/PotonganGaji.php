<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotonganGaji extends Model
{
    protected $table = 'potongan_gaji';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'jenis_potongan',
        'jlh_potongan',
    ];
}
