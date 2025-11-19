<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Cetak Daftar Gaji' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Minimal CSS untuk laporan cetak -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #111;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 10px; }
        h2, h4 {
        
            margin: 0; padding: 0;
        }
        .meta {
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 8px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .small {
            font-size: 11px;
            color: #555;
        }

        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">PT Siantar Codes Academy</h1>
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2>Daftar Gaji Pegawai</h2>
                <div class="small">Periode: 
                    {{ $bulanTerpilih ? ($daftarBulan[$bulanTerpilih] ?? $bulanTerpilih) : 'Semua' }}
                    {{ $tahunTerpilih ?? '' }}
                </div>
            </div>
            <div class="no-print">
                <button onclick="window.print()">Cetak / Print</button>
            </div>
        </div>

        @if(empty($daftarGaji) || $daftarGaji->isEmpty())
            <div style="margin-top:20px; padding:10px; background:#fff3cd; border:1px solid #ffeeba;">
                <strong>Perhatian:</strong> Tidak ada data gaji untuk bulan/tahun yang dipilih.
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th class="text-center">JK</th>
                        <th>Jabatan</th>
                        <th class="text-right">Gaji Pokok</th>
                        <th class="text-right">Transport</th>
                        <th class="text-right">Uang Makan</th>
                        <th class="text-right">Potongan</th>
                        <th class="text-right">Total (Net)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($daftarGaji as $row)
                        @php
                            $gaji_pokok = (float) $row->gaji_pokok;
                            $uang_transport = (float) $row->uang_transport;
                            $uang_makan = (float) $row->uang_makan;

                            $gross = $gaji_pokok + $uang_transport + $uang_makan;

                            $potonganAlpha = $potongans->where('jenis_potongan', 'Alpha')->first();
                            $jumlahPotonganPerAlpha = $potonganAlpha ? (float) $potonganAlpha->jlh_potongan : 0;

                            $totalPotongan = $row->alpha * $jumlahPotonganPerAlpha;

                            $net = $gross - $totalPotongan;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $row->nik }}</td>
                            <td>{{ $row->nama_pegawai }}</td>
                            <td class="text-center">{{ $row->jenis_kelamin }}</td>
                            <td>{{ $row->nama_jabatan }}</td>
                            <td class="text-right">{{ number_format($gaji_pokok,0,',','.') }}</td>
                            <td class="text-right">{{ number_format($uang_transport,0,',','.') }}</td>
                            <td class="text-right">{{ number_format($uang_makan,0,',','.') }}</td>
                            <td class="text-right">{{ number_format($totalPotongan,0,',','.') }}</td>
                            <td class="text-right">{{ number_format($net,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:18px; font-size:12px;">
                <div>Tanggal Cetak: {{ date('d-m-Y H:i') }}</div>
            </div>
            <table style="border: none;">
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none"; width="200px";>
                        Simalungun, {{ date('d-m-Y') }}, 
                        <br> Bidang Keuangan
                        <br><br><br>
                        <p>(___________________)</p>
                    </td>
                </tr>
            </table>
        @endif
    </div>
</body>
</html>
