@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])
@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])

<div class="container-fluid" style="margin-bottom: 100px;">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Gaji Pegawai
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="staticEmail2">Bulan:</label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        @foreach ($daftarBulan as $nilaiBulan => $namaBulan)
                            <option value="{{ $nilaiBulan }}" @if($bulanTerpilih == $nilaiBulan) selected @endif>{{ $namaBulan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2 ml-4">
                    <label for="staticEmail2">Tahun: </label>
                    <select class="form-control ml-3" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        @foreach ($daftarTahun as $tahun)
                            <option value="{{ $tahun }}" @if($tahunTerpilih == $tahun) selected @endif>{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
                @if($gaji->isNotEmpty())
                    <a href="{{ route('admin.data_gaji.print', ['bulan' => $bulanTerpilih, 'tahun' => $tahunTerpilih]) ?? route('admin.data_kehadiran') }}" 
                    class="btn btn-success mb-2 ml-3" target="_blank">
                        <i class="fas fa-print"></i> Cetak Daftar Gaji
                    </a>
                @else
                    <button type="button" class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-print"></i> Cetak Daftar Gaji
                    </button>
                @endif

            </form>
        </div>
    </div>

    <div class="alert alert-info">
        Menampilkan Data Kehadiran Pegawai Bulan 
        <span class="font-weight-bold">{{ $bulanTerpilih ? ($daftarBulan[$bulanTerpilih] ?? $bulanTerpilih) : 'Semua' }}</span> 
        Tahun <span class="font-weight-bold">{{ $tahunTerpilih ?? 'Semua' }}</span>
    </div>

    @if(empty($gaji) || $gaji->isEmpty())
        <div class="alert alert-warning">
            <strong>Perhatian:</strong> Tidak ada data gaji untuk bulan dan tahun yang dipilih. Silahkan mengisi data kehadiran terlebih dahulu.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Gaji Pokok</th>
                    <th class="text-center">Uang Transport</th>
                    <th class="text-center">Uang Makan</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Total Gaji <br>(Gross - Potongan)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gaji as $row)
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
                        <td class="text-center">{{ $row->nik }}</td>
                        <td>{{ $row->nama_pegawai }}</td>
                        <td class="text-center">{{ $row->jenis_kelamin }}</td>
                        <td class="text-center">{{ $row->nama_jabatan }}</td>
                        <td class="text-right">{{ number_format($gaji_pokok, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($uang_transport, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($uang_makan, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($totalPotongan, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($net, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data gaji kosong, silahkan memilih bulan dan tahun lain, atau mengisi data kehadiran pada bulan dan tahun yang dipilih.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])
