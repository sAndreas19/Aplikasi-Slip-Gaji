@include('templates_admin.header', ['title' => $title ?? 'Dashboard'])

@include('templates_admin.sidebar', ['title' => $title ?? 'Dashboard'])
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title ?? 'Dashboard' }}</h1>

        </div>


        <div class="card" style="width: 60%; margin-bottom: 100px;">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.potongan_gaji.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_potongan">Jenis Potongan</label>
                        <input type="text" name="jenis_potongan" class="form-control" required>
                        @error('jenis_potongan')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jlh_potongan">Jumlah Potongan</label>
                        <input type="number" name="jlh_potongan" class="form-control" required>
                        @error('jlh_potongan')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    
    </div>

@include('templates_admin.footer', ['title' => $title ?? 'Dashboard'])