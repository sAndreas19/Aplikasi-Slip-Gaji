<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;

class DataKehadiranController extends Controller
{
    public function index()
    {
        $kehadirans = DataKehadiran::all();
        return view('admin.data_kehadiran.index', [
            'title' => 'Data Kehadiran',
            'kehadirans' => $kehadirans
        ]);
    }

    public function create()
    {
        return view('admin.data_kehadiran.create', ['title' => 'Tambah Kehadiran']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'required',
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'nama_jabatan' => 'required',
            'hadir' => 'required|integer',
            'sakit' => 'required|integer',
            'alpha' => 'required|integer',
        ]);

        DataKehadiran::create($validated);

        return redirect()->route('admin.data_kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan!');
    }

    public function edit(DataKehadiran $dataKehadiran)
    {
        return view('admin.data_kehadiran.edit', [
            'title' => 'Edit Kehadiran',
            'kehadiran' => $dataKehadiran
        ]);
    }

    public function update(Request $request, DataKehadiran $dataKehadiran)
    {
        $validated = $request->validate([
            'bulan' => 'required',
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'nama_jabatan' => 'required',
            'hadir' => 'required|integer',
            'sakit' => 'required|integer',
            'alpha' => 'required|integer',
        ]);

        $dataKehadiran->update($validated);

        return redirect()->route('admin.data_kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui!');
    }

    public function destroy(DataKehadiran $dataKehadiran)
    {
        $dataKehadiran->delete();
        return redirect()->route('admin.data_kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus!');
    }
}
