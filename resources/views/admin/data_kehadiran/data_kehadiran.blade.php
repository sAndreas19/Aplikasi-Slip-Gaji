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

                    <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i>Tampilkan Data</button>
                    <a href="{{ route('admin.data_kehadiran.create') }}" class="btn btn-success mb-2 ml-3"><i class="fas fa-plus"></i> Input Kehadiran</a>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info">
            Menampilkan Data Kehadiran Pegawai Bulan <span class="font-weight-bold">{{ $bulanTerpilih ?? 'Semua' }}</span> Tahun <span class="font-weight-bold">{{ $tahunTerpilih ?? 'Semua' }}</span>
        </div>
        
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-centered">No</th>
                <th class="text-centered">NIK</th>
                <th class="text-centered">Nama Pegawai</th>
                <th class="text-centered">Jenis Kelamin</th>
                <th class="text-centered">Jabatan</th>
                <th class="text-centered">Hadir</th>
                <th class="text-centered">Sakit</th>
                <th class="text-centered">Alpha</th>
                <!-- <th class="text-centered">Aksi</th> -->
            </tr>

            @foreach ($absensi as $kehadiran)
                <tr>
                    <td class="text-centered">{{ $loop->iteration }}</td>
                    <td class="text-centered">{{ $kehadiran->nik }}</td>
                    <td class="text-centered">{{ $kehadiran->nama_pegawai }}</td>
                    <td class="text-centered">{{ $kehadiran->jenis_kelamin }}</td>
                    <td class="text-centered">{{ $kehadiran->nama_jabatan }}</td>
                    <td class="text-centered">{{ $kehadiran->hadir }}</td>
                    <td class="text-centered">{{ $kehadiran->sakit }}</td>
                    <td class="text-centered">{{ $kehadiran->alpha }}</td>

                    <!-- <td class="text-centered">
                        <a href="{{ route('admin.data_kehadiran.edit', $kehadiran->id_kehadiran) }}" class="btn btn-warning btn-sm">Edit <i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.data_kehadiran.destroy', $kehadiran->id_kehadiran) }}" 
                            method="POST" 
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Hapus <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td> -->
                </tr>
            @endforeach
        </table>

        @if($absensi->isEmpty())
            <div class="alert alert-danger">
                <i class="fas fa-info-circle mr-1"></i>Data Kehadiran Pegawai 
                Bulan <span class="font-weight-bold">{{ $bulanTerpilih ?? '...' }}</span> 
                Tahun <span class="font-weight-bold">{{ $tahunTerpilih ?? '...' }}</span> 
                masih kosong. Silahkan input data kehadiran pegawai.
            </div>
        @endif
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])
