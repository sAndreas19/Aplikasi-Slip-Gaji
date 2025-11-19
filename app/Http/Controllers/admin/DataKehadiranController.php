<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataPegawai;

class DataKehadiranController extends Controller
{
    protected $daftarTahun;
    protected $daftarBulan;

    public function __construct()
    {
        $tahunSekarang = date('Y');
        $this->daftarTahun = range($tahunSekarang - 5, $tahunSekarang);
        $this->daftarBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
    }

    private function getAbsensi($bulan, $tahun)
    {   
        if (!$bulan || !$tahun) {
            return collect([]);
        }

        $bulantahun = $bulan . $tahun;

        return DB::table('data_kehadiran')
            ->join('data_pegawai', 'data_kehadiran.nik', '=', 'data_pegawai.nik')
            ->join('data_jabatan', 'data_pegawai.jabatan', '=', 'data_jabatan.nama_jabatan')
            ->select(
                'data_kehadiran.*',
                'data_pegawai.nama_pegawai',
                'data_pegawai.jenis_kelamin',
                'data_pegawai.jabatan as nama_jabatan'
            )
            ->where('data_kehadiran.bulan', $bulantahun)
            ->orderBy('data_pegawai.nama_pegawai', 'ASC')
            ->get();
    }

    private function getInputAbsensi($bulan, $tahun)
    {
        if (!$bulan || !$tahun) {
            return collect([]);
        }
        $bulantahun = $bulan . $tahun;

        return DB::table('data_pegawai')
            ->join('data_jabatan', 'data_pegawai.jabatan', '=', 'data_jabatan.nama_jabatan')
            ->whereNotExists(function ($query) use ($bulantahun) {
                $query->select(DB::raw(1))
                    ->from('data_kehadiran')
                    ->whereColumn('data_kehadiran.nik', 'data_pegawai.nik')
                    ->where('data_kehadiran.bulan', $bulantahun);
            })
            ->orderBy('data_pegawai.nama_pegawai', 'ASC')
            ->select(
                'data_pegawai.*',
                'data_jabatan.nama_jabatan'
            )
            ->get();
    }

        
    public function index(Request $request)
    {
        $kehadirans = DataKehadiran::all();

        $bulanTerpilih = $request->input('bulan');
        $tahunTerpilih = $request->input('tahun');
        $absensi = $this->getAbsensi($bulanTerpilih, $tahunTerpilih);

        return view('admin.data_kehadiran.data_kehadiran', [
            'title' => 'Data Absensi Pegawai',
            'kehadirans' => $kehadirans,
            'daftarTahun' => $this->daftarTahun,
            'daftarBulan' => $this->daftarBulan,
            'bulanTerpilih' => $bulanTerpilih,
            'tahunTerpilih' => $tahunTerpilih,
            'absensi' => $absensi,
        ]);
    }

    public function create(Request $request)
    {   
        $bulanTerpilih = $request->input('bulan');
        $tahunTerpilih = $request->input('tahun');
        $input_absensi = $this->getInputAbsensi($bulanTerpilih, $tahunTerpilih);
        return view('admin.data_kehadiran.add_data', [
            'title' => 'Input Data Kehadiran',
            'daftarBulan' => $this->daftarBulan,
            'daftarTahun' => $this->daftarTahun,
            'bulanTerpilih' => $bulanTerpilih,
            'tahunTerpilih' => $tahunTerpilih,
            'input_absensi' => $input_absensi,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'nik' => 'required|array',
            'nik.*' => 'required|string',
            'hadir' => 'required|array',
            'hadir.*' => 'nullable|integer|min:0',
            'sakit' => 'required|array',
            'sakit.*' => 'nullable|integer|min:0',
            'alpha' => 'required|array',
            'alpha.*' => 'nullable|integer|min:0',
        ]);

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $bulantahun = $bulan . $tahun;

        $niks = $request->input('nik', []);
        $hadirs = $request->input('hadir', []);
        $sakits = $request->input('sakit', []);
        $alphas = $request->input('alpha', []);

        // ambil data pegawai untuk semua nik yang dikirim (sekali query)
        $pegawais = DataPegawai::whereIn('nik', $niks)
                ->get()
                ->keyBy('nik'); // agar mudah lookup berdasar nik

        $rows = [];
        foreach ($niks as $i => $nik) {
            if (! $nik) continue;

            // jika pegawai tidak ditemukan, lewati (atau tangani sesuai kebutuhan)
            if (! isset($pegawais[$nik])) {
                continue;
            }

            $pegawai = $pegawais[$nik];

            $rows[] = [
                'bulan' => $bulantahun,
                'nik' => $nik,
                'nama_pegawai' => $pegawai->nama_pegawai,
                'jenis_kelamin' => $pegawai->jenis_kelamin,
                'nama_jabatan' => $pegawai->jabatan,
                'hadir' => isset($hadirs[$i]) ? (int)$hadirs[$i] : 0,
                'sakit' => isset($sakits[$i]) ? (int)$sakits[$i] : 0,
                'alpha' => isset($alphas[$i]) ? (int)$alphas[$i] : 0,
            ];
        }

        if (empty($rows)) {
            return redirect()->back()->with('error', 'Tidak ada data valid untuk disimpan.');
        }

        $existingNiks = DB::table('data_kehadiran')
            ->where('bulan', $bulantahun)
            ->whereIn('nik', array_column($rows, 'nik'))
            ->pluck('nik')
            ->toArray();

        $rows = array_filter($rows, function($r) use ($existingNiks) {
            return ! in_array($r['nik'], $existingNiks);
        });

        if (empty($rows)) {
            return redirect()->route('admin.data_kehadiran')
                ->with('info', 'Tidak ada data baru — semua pegawai sudah memiliki data pada bulan tersebut.');
        }

        DB::transaction(function () use ($rows) {
            DataKehadiran::insert($rows);
        });

        return redirect()->route('admin.data_kehadiran')->with('success', 'Data kehadiran berhasil diperbaharui!');
    }

    public function edit(DataKehadiran $dataKehadiran)
    {
        return view('admin.data_kehadiran.update_data', [
            'title' => 'Edit Data Kehadiran',
            'kehadiran' => $dataKehadiran
        ]);
    }

    public function update(Request $request, DataKehadiran $dataKehadiran)
    {
        $validated = $request->validate([
            'bulan' => 'required',
            'nik' => 'required',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'nama_jabatan' => 'required',
            'hadir' => 'required|integer',
            'sakit' => 'required|integer',
            'alpha' => 'required|integer',
        ]);

        $dataKehadiran->update($validated);

        return redirect()->route('admin.data_kehadiran')->with('success', 'Data kehadiran berhasil diperbarui!');
    }

    public function destroy(DataKehadiran $dataKehadiran)
    {
        $dataKehadiran->delete();
        return redirect()->route('admin.data_kehadiran')->with('success', 'Data kehadiran berhasil dihapus!');
    }
}
