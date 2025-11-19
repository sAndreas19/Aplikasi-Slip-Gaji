<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DataPegawaiController extends Controller
{
    public function index() 
    {
        $pegawais = DataPegawai::all();
        return view('admin.data_pegawai.data_pegawai', [
            'title' => 'Data Pegawai',
            'pegawais' => $pegawais
        ]);
    }

    public function create()
    {
        $jabatans = \App\Models\DataJabatan::all();
        return view('admin.data_pegawai.add_data', [
            'title' => 'Tambah Pegawai',
            'jabatans' => $jabatans,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('pegawai', $filename, 'public');
            $validated['photo'] = $path;
        }

        DataPegawai::create($validated);

        return redirect()->route('admin.data_pegawai')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function edit(DataPegawai $dataPegawai)
    {
        $jabatans = \App\Models\DataJabatan::all();

        return view('admin.data_pegawai.update_data', [
            'title' => 'Edit Pegawai',
            'pegawai' => $dataPegawai,
            'jabatans' => $jabatans,
        ]);
    }

    public function update(Request $request, DataPegawai $dataPegawai)
    {
        $validated = $request->validate([
            'nik' => 'required',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($dataPegawai->photo && Storage::disk('public')->exists($dataPegawai->photo)) {
                Storage::disk('public')->delete($dataPegawai->photo);
            }

            $file = $request->file('photo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('pegawai', $filename, 'public');
            $validated['photo'] = $path;
        }

        $dataPegawai->update($validated);

        return redirect()->route('admin.data_pegawai')->with('success', 'Pegawai berhasil diperbarui!');
    }

    public function destroy(DataPegawai $dataPegawai)
    {
        if ($dataPegawai->photo && Storage::disk('public')->exists($dataPegawai->photo)) {
            Storage::disk('public')->delete($dataPegawai->photo);
        }

        $dataPegawai->delete();
        return redirect()->route('admin.data_pegawai')->with('success', 'Pegawai berhasil dihapus!');
    }
}
