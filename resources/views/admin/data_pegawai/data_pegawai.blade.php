@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid" style="margin-bottom: 100px;">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>

        <a href="{{ route('admin.data_pegawai.create') }}" class="btn btn-success btn-sm mb-3">Tambah Data <i class="fas fa-plus"></i></a>
                        <!-- /add_data' -->

        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-centered">No</th>
                <th class="text-centered">NIK</th>
                <th class="text-centered">Nama Pegawai</th>
                <th class="text-centered">Jenis Kelamin</th>
                <th class="text-centered">Jabatan</th>
                <th class="text-centered">Tanggal Masuk</th>
                <th class="text-centered">Status</th>
                <th class="text-centered">Foto</th>
                <th class="text-centered">Aksi</th>
            </tr>

            @foreach ($pegawais as $pegawai)
                <tr>
                    <td class="text-centered">{{ $loop->iteration }}</td>
                    <td class="text-centered">{{ $pegawai->nik }}</td>
                    <td class="text-centered">{{ $pegawai->nama_pegawai }}</td>
                    <td class="text-centered">{{ $pegawai->jenis_kelamin }}</td>
                    <td class="text-centered">{{ $pegawai->jabatan }}</td>
                    <td class="text-centered">{{ $pegawai->tanggal_masuk }}</td>
                    <td class="text-centered">{{ $pegawai->status }}</td>
                    <td class="text-centered"><img style="max-width: 60px; height: 60px;" src="{{ asset('storage/'.$pegawai->photo) }}" alt=""></td>
                    <td class="text-centered">
                        <a href="{{ route('admin.data_pegawai.edit', $pegawai->id_pegawai) }}" class="btn btn-warning btn-sm">Edit <i class="fas fa-edit"></i></a>
                        <!-- /update_data'.pegawai->id_pegawai -->
                        <form action="{{ route('admin.data_pegawai.destroy', $pegawai->id_pegawai) }}" 
                            method="POST" 
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Hapus <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])
