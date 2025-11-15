<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SlipGajiController extends Controller
{
    public function index()
    {
        return view('admin.slip_gaji', [
            'title' => 'Slip Gaji'
        ]);
    }
}

