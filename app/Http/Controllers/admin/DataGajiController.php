<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DataGajiController extends Controller
{
    public function index()
    {
        return view('admin.data_gaji', [
            'title' => 'Data Gaji'
        ]);
    }
}

