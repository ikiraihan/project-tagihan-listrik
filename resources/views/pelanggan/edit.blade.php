@extends('layouts.dashboard')

@section('content')
<div id="layout_content">
    <main>
        <div class="container">
            <a href="{{ url('/pelanggan') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Kembali
            </a>
            <div class="row justify">
                <div class="col-xl-20 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="h3 mt-2 mb-2 text-gray-800">Edit Pelanggan</h1>
                        </div>
						<div class="card-body">
                            <form action="/pelanggan/update/{{ $pelanggan->id }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id_pelanggan">ID Pelanggan</label>
                                    <input type="text" class="form-control @error('id_pelanggan') is-invalid @enderror" id="id_pelanggan" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}" placeholder="Masukkan ID Pelanggan" required>
                                    @error('id_pelanggan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama Pelanggan" value="{{ $pelanggan->nama }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pelanggan->alamat }}" placeholder="Masukkan Alamat Pelanggan" required>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="daya">Daya</label>
                                    <input type="number" class="form-control" id="daya" name="daya" value="{{ $pelanggan->daya }}" placeholder="Masukkan Jumlah Daya Pelanggan" required>
                                    @error('daya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>

@endsection