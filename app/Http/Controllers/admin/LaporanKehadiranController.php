<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LaporanKehadiranController extends Controller
{
    public function index()
    {
        return view('admin.laporan_kehadiran', [
            'title' => 'Laporan Kehadiran'
        ]);
    }
}

