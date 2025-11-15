<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataJabatan;
use App\Models\DataPegawai;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $data = DataPegawai::all();
        $jumlah_pegawai = DataPegawai::count();
        $jumlah_admin = DataPegawai::where('jabatan', 'Admin')->count();
        $data_jabatan = DataJabatan::count();
        $data_kehadiran = DataKehadiran::count();


        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'data' => $data,
            'jumlah_pegawai' => $jumlah_pegawai,
            'jumlah_admin' => $jumlah_admin,
            'data_jabatan' => $data_jabatan,
            'data_kehadiran' => $data_kehadiran
        ]);
    }
}
