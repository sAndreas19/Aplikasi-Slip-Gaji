<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataJabatan;
use Illuminate\Http\Request;

class DataJabatanController extends Controller
{
    public function index()
    {
        $jabatans = DataJabatan::all();
        return view('admin.data_jabatan.data_jabatan', [
            'title' => 'Data Jabatan',
            'jabatans' => $jabatans
        ]);
    }

    public function create()
    {
        return view('admin.data_jabatan.add_data', ['title' => 'Tambah Data Jabatan']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'uang_transport' => 'required',
            'uang_makan' => 'required',
        ]);

        DataJabatan::create($validated);

        return redirect()->route('admin.data_jabatan')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function edit(DataJabatan $dataJabatan)
    {
        return view('admin.data_jabatan.update_data', [
            'title' => 'Edit Jabatan',
            'jabatan' => $dataJabatan
        ]);
    }

    public function update(Request $request, DataJabatan $dataJabatan)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'uang_transport' => 'required',
            'uang_makan' => 'required',
        ]);

        $dataJabatan->update($validated);

        return redirect()->route('admin.data_jabatan')->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy(DataJabatan $dataJabatan)
    {
        $dataJabatan->delete();
        return redirect()->route('admin.data_jabatan')->with('success', 'Jabatan berhasil dihapus!');
    }
}
