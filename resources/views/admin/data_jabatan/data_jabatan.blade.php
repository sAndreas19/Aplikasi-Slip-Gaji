@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid" style="margin-bottom: 100px;">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>

        <a href="{{ route('admin.data_jabatan.create') }}" class="btn btn-success btn-sm mb-3">Tambah Data <i class="fas fa-plus"></i></a>
                        <!-- /add_data' -->

        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-centered">No</th>
                <th class="text-centered">Nama Jabatan</th>
                <th class="text-centered">Gaji Pokok</th>
                <th class="text-centered">Uang Transport</th>
                <th class="text-centered">Uang Makan</th>
                <th class="text-centered">Total</th>
                <th class="text-centered">Aksi</th>
            </tr>

            @foreach ($jabatans as $jabatan)
                <tr>
                    <td class="text-centered">{{ $loop->iteration }}</td>
                    <td class="text-centered">{{ $jabatan->nama_jabatan }}</td>
                    <td class="text-centered">{{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</td>
                    <td class="text-centered">{{ number_format($jabatan->uang_transport, 0, ',', '.') }}</td>
                    <td class="text-centered">{{ number_format($jabatan->uang_makan, 0, ',', '.') }}</td>
                    <td class="text-centered">{{ number_format($jabatan->gaji_pokok + $jabatan->uang_transport + $jabatan->uang_makan, 0, ',', '.') }}</td>
                    <td class="text-centered">
                        <a href="{{ route('admin.data_jabatan.edit', $jabatan->id_jabatan) }}" class="btn btn-warning btn-sm">Edit <i class="fas fa-edit"></i></a>
                        <!-- /update_data'.jabatan->id_jabatan -->
                        <form action="{{ route('admin.data_jabatan.destroy', $jabatan->id_jabatan) }}" 
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
