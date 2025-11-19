@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid" style="margin-bottom: 100px;">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>

        <a href="{{ route('admin.potongan_gaji.create') }}" class="btn btn-success btn-sm mb-3">Tambah Data <i class="fas fa-plus"></i></a>

        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-centered">No</th>
                <th class="text-centered">Jenis Potongan</th>
                <th class="text-centered">Jumlah Potongan</th>
                <th class="text-centered">Aksi</th>
            </tr>

            @foreach ($list_potongans as $potongan)
                <tr>
                    <td class="text-centered">{{ $loop->iteration }}</td>
                    <td class="text-centered">{{ $potongan->jenis_potongan }}</td>
                    <td class="text-centered">Rp. {{ number_format($potongan->jlh_potongan, 0, ',', '.') }}</td>
                    <td class="text-centered">
                        <a href="{{ route('admin.potongan_gaji.edit', $potongan->id) }}" class="btn btn-warning btn-sm">Edit <i class="fas fa-edit"></i></a>

                        <form action="{{ route('admin.potongan_gaji.destroy', $potongan->id) }}" 
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
