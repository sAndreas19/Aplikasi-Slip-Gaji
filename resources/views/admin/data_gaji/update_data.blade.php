@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>


        <div class="card" style="width: 60%; margin-bottom: 100px;">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.data_pegawai.update', $pegawai-> id_pegawai) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik', $pegawai->nik) }}" required>
                        @error('nik')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                        @error('nama_pegawai')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="{{ old('jenis_kelamin', $pegawai->jenis_kelamin) }}">{{ old('jenis_kelamin', $pegawai->jenis_kelamin) }}</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" class="form-control">
                            <option value="{{ old('jabatan', $pegawai->jabatan) }}">{{ old('jabatan', $pegawai->jabatan) }}</option>
                            @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->nama_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                        @error('jabatan')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk) }}" required>
                        @error('tanggal_masuk')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="{{ old('status', $pegawai->status) }}">{{ old('status', $pegawai->status) }}</option>
                            <option value="Pegawai Tetap">Pegawai Tetap</option>
                            <option value="Pegawai Tidak Tetap">Pegawai Tidak Tetap</option>
                        </select>
                        @error('status')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Upload Foto</label>
                        <input type="file" name="photo" class="form-control">
                        @error('photo')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>

                </form>

            </div>
        </div>
    
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])