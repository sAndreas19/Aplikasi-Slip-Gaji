@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>


        <div class="card" style="width: 60%; margin-bottom: 100px;">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.data_jabatan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" required>
                        @error('nama_jabatan')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" required>
                        @error('gaji_pokok')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="uang_transport">Uang Transport</label>
                        <input type="number" name="uang_transport" class="form-control" required>
                        @error('uang_transport')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="uang_makan">Uang Makan</label>
                        <input type="number" name="uang_makan" class="form-control" required>
                        @error('uang_makan')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])