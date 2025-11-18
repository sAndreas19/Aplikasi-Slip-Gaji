@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid" style="margin-bottom: 100px;">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                Filter Data Absensi Pegawai
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group mb-2">
                        <label for="staticEmail2">Bulan:</label>
                        <select class="form-control ml-3" name="bulan">
                            <option value="">--Pilih Bulan--</option>
                            @foreach ($daftarBulan as $nilaiBulan => $namaBulan)
                                <option value="{{ $nilaiBulan }}">{{ $namaBulan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 ml-4">
                        <label for="staticEmail2">Tahun: </label>
                        <select class="form-control ml-3" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            @foreach ($daftarTahun as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i>Generate</button>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info">
            Menampilkan Data Kehadiran Pegawai Bulan <span class="font-weight-bold">{{ $bulanTerpilih ?? '...' }}</span> Tahun <span class="font-weight-bold">{{ $tahunTerpilih ?? '...' }}</span>
        </div>

        <form method="POST" action="{{ route('admin.data_kehadiran.store') }}">
            @csrf
            <input type="hidden" name="bulan" value="{{ $bulanTerpilih }}">
            <input type="hidden" name="tahun" value="{{ $tahunTerpilih }}">
            <button type="submit" class="btn btn-success mb-3" name="submit">Simpan</button>

            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-centered">No</th>
                    <th class="text-centered">NIK</th>
                    <th class="text-centered">Nama Pegawai</th>
                    <th class="text-centered">Jenis Kelamin</th>
                    <th class="text-centered">Jabatan</th>
                    <th class="text-centered" width="10%">Hadir</th>
                    <th class="text-centered" width="10%">Sakit</th>
                    <th class="text-centered" width="10%">Alpha</th>
                </tr>

                @foreach ($input_absensi as $kehadiran)
                    <tr>
                        <td class="text-centered">{{ $loop->iteration }}</td>
                        <td class="text-centered">
                            {{ $kehadiran->nik }}
                            <input type="hidden" name="nik[]" value="{{ $kehadiran->nik }}">
                        </td>
                        <td class="text-centered">{{ $kehadiran->nama_pegawai }}</td>
                        <td class="text-centered">{{ $kehadiran->jenis_kelamin }}</td>
                        <td class="text-centered">{{ $kehadiran->nama_jabatan }}</td>
                        <td><input type="number" name="hadir[]" class="form-control" value="0"></td>
                        <td><input type="number" name="sakit[]" class="form-control" value="0"></td>
                        <td><input type="number" name="alpha[]" class="form-control" value="0"></td> 
                    </tr>
                @endforeach
            </table>
        </form>

        @if($input_absensi->isEmpty())
            <div class="alert alert-danger">
                <i class="fas fa-info-circle mr-1"></i>Data Kehadiran Pegawai 
                Bulan <span class="font-weight-bold">{{ $bulanTerpilih ?? '...' }}</span> 
                Tahun <span class="font-weight-bold">{{ $tahunTerpilih ?? '...' }}</span> 
                sudah diupdate, silahkan memilih bulan dan tahun lainnya.
            </div>
        @endif
    
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])