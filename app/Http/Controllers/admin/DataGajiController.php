<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataPegawai;
use App\Models\DataJabatan;
use App\Models\PotonganGaji;

class DataGajiController extends Controller
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
    public function index(Request $request)
    {
        $bulanTerpilih = $request->input('bulan');
        $tahunTerpilih = $request->input('tahun');

        $gaji = collect([]);

        if ($bulanTerpilih && $tahunTerpilih) {
            $bulantahun = $bulanTerpilih . $tahunTerpilih; // pastikan bulan value adalah '01','02',...

            $gaji = DB::table('data_pegawai')
                ->join('data_kehadiran', 'data_kehadiran.nik', '=', 'data_pegawai.nik')
                ->join('data_jabatan', 'data_jabatan.nama_jabatan', '=', 'data_pegawai.jabatan')
                ->select(
                    'data_pegawai.nik',
                    'data_pegawai.nama_pegawai',
                    'data_pegawai.jenis_kelamin',
                    'data_jabatan.nama_jabatan',
                    'data_jabatan.gaji_pokok',
                    'data_jabatan.uang_transport',
                    'data_jabatan.uang_makan',
                    'data_kehadiran.alpha'
                )
                ->where('data_kehadiran.bulan', $bulantahun)
                ->orderBy('data_pegawai.nama_pegawai', 'ASC')
                ->get();
        }

        // ambil potongan jika mau ditampilkan di view
        $potongans = PotonganGaji::all();

        return view('admin.data_gaji.data_gaji', [
            'title' => 'Data Gaji Pegawai',
            'daftarTahun' => $this->daftarTahun,
            'daftarBulan' => $this->daftarBulan,
            'bulanTerpilih' => $bulanTerpilih,
            'tahunTerpilih' => $tahunTerpilih,
            'gaji' => $gaji,
            'potongans' => $potongans,
        ]);
    }

    public function cetakDataGaji(Request $request)
    {
        $bulanTerpilih = $request->input('bulan');
        $tahunTerpilih = $request->input('tahun');

        $daftarGaji = collect([]);

        if ($bulanTerpilih && $tahunTerpilih) {
            $bulantahun = $bulanTerpilih . $tahunTerpilih;

            $daftarGaji = DB::table('data_pegawai')
                ->join('data_kehadiran', 'data_kehadiran.nik', '=', 'data_pegawai.nik')
                ->join('data_jabatan', 'data_jabatan.nama_jabatan', '=', 'data_pegawai.jabatan')
                ->select(
                    'data_pegawai.nik',
                    'data_pegawai.nama_pegawai',
                    'data_pegawai.jenis_kelamin',
                    'data_jabatan.nama_jabatan',
                    'data_jabatan.gaji_pokok',
                    'data_jabatan.uang_transport',
                    'data_jabatan.uang_makan',
                    'data_kehadiran.alpha'
                )
                ->where('data_kehadiran.bulan', $bulantahun)
                ->orderBy('data_pegawai.nama_pegawai', 'ASC')
                ->get();
        }

        $potongans = PotonganGaji::all();

        return view('admin.data_gaji.cetak_data_gaji', [
            'title' => 'Cetak Daftar Gaji',
            'daftarTahun' => $this->daftarTahun,
            'daftarBulan' => $this->daftarBulan,
            'bulanTerpilih' => $bulanTerpilih,
            'tahunTerpilih' => $tahunTerpilih,
            'daftarGaji' => $daftarGaji,
            'potongans' => $potongans,
        ]);
    }


}

