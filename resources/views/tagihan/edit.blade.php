@extends('layouts.dashboard')

@section('content')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"><div id="layout_content">

    <main>
        <div class="container">
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
            @endif
            <a href="/{{$tahun->tahun}}-tagihan-{{$bulan->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Kembali
            </a>
            <div class="row justify">
                <div class="col-xl-20 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="h3 mt-2 mb-2 text-gray-800">Edit Tagihan</h1>
                        </div>
						<div class="card-body">
                            <form action="/{{$tahun->tahun}}-tagihan-{{$bulan->id}}/update/{{$tagihan->id}}" method="post">
                                {{ csrf_field() }}
                                <!-- <div class="form-group">
                                    <label for="id_tahun">Tahun</label>
                                    <input type="text" class="form-control" id="id_tahun" name="id_tahun" value="{{ $tahun-> id }}" readonly>
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tahun</label>
                                    <select class="form-control" id="id_tahun" name="id_tahun" readonly>
                                        <option value="{{ $tahun-> id }}"> {{ $tahun->tahun }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Bulan</label>
                                    <select class="form-control" id="id_bulan" name="id_bulan" readonly>
                                        <option value="{{ $bulan-> id }}"> {{ $bulan->bulan }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Pelanggan</label><br>
                                    <select class="selectpicker" id="id_pelanggan" name="id_pelanggan"  data-live-search="true" showSubtext="true" data-width="100%">
                                        <option value="{{ $tagihan->id_pelanggan }}">{{ $tagihan-> pelanggan -> id_pelanggan }} / {{ $tagihan -> pelanggan -> nama }}</option>
                                        @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}"> {{ $p->id_pelanggan }} / {{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pelanggan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kwh">KWH</label>
                                    <input type="number" class="form-control" id="kwh" name="kwh" value="{{ $tagihan->kwh }}" placeholder="Masukkan Jumlah KWH" required>
                                    @error('kwh')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kelas_tarif">Kelas Tarif</label>
                                    <input type="text" class="form-control" id="kelas_tarif" name="kelas_tarif" value="{{ $tagihan->kelas_tarif }}"  placeholder="Masukkan Kelas Tarif" required>
                                    @error('kelas_tarif')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_tagihan">Total Tagihan</label>
                                    <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" value="{{ number_format($tagihan->total_tagihan, 0, ',', '.') }}"  placeholder="Masukkan Total Tagihan" required>
                                    @error('total_tagihan')
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
<script type="text/javascript">
		
		var rupiah = document.getElementById('total_tagihan');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value);
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
		}
	</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
@endsection