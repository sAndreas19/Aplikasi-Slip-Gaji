<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;

class PotonganGajiController extends Controller
{
    public function index()
    {
        $list_potongans = PotonganGaji::all();

        return view('admin.potongan_gaji.potongan_gaji', [
            'title' => 'Setting Potongan Gaji',
            'list_potongans' => $list_potongans
        ]);
    }

    public function create()
    {
        return view('admin.potongan_gaji.add_data', [
            'title' => 'Tambah Potongan Gaji'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_potongan' => 'required',
            'jlh_potongan' => 'required',
        ]);

        PotonganGaji::create($validated);

        return redirect()->route('admin.potongan_gaji')->with('success', 'Data potongan berhasil ditambahkan!');
    }

    public function edit(PotonganGaji $potonganGaji)
    {
        return view('admin.potongan_gaji.update_data', [
            'title' => 'Edit Potongan Gaji',
            'potongan' => $potonganGaji
        ]);
    }

    public function update(Request $request, PotonganGaji $potonganGaji)
    {
        $validated = $request->validate([
            'jenis_potongan' => 'required',
            'jlh_potongan' => 'required',
        ]);

        $potonganGaji->update($validated);

        return redirect()->route('admin.potongan_gaji')->with('success', 'Data potongan berhasil diperbarui!');
    }

    public function destroy(PotonganGaji $potonganGaji)
    {
        $potonganGaji->delete();

        return redirect()->route('admin.potongan_gaji')->with('success', 'Data potongan berhasil dihapus!');
    }
}
