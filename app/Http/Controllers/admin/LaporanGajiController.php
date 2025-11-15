<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LaporanGajiController extends Controller
{
    public function index()
    {
        return view('admin.laporan_gaji', [
            'title' => 'Laporan Gaji'
        ]);
    }
}

