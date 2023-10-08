@extends('layouts.dashboard')

@section('content')
                    <!-- Custom styles for this template-->
                    <link href="{{ asset('css/sb-admin-2.min-detail.css') }}" rel="stylesheet">
                    <a href="/pelanggan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Kembali
                    </a>
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-1 text-gray-800">Data Pelanggan</h1>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <h6 class="m-0 text-gray-800">ID Pelanggan : {{ $pelanggan->id_pelanggan }}</h6>
                            <div class="dropdown-divider"></div>
                            <h6 class="m-0 text-gray-800">Nama : {{ $pelanggan->nama }}</h6>
                            <div class="dropdown-divider"></div>
                            <h6 class="m-0 text-gray-800">Alamat : {{ $pelanggan->alamat }}</h6>
                            <div class="dropdown-divider"></div>
                            <h6 class="m-0 text-gray-800">Daya : {{ $pelanggan->daya }}</h6>
                        </div>
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <span aria-hidden="true">&times;</span> 
                        </button>
                        </div>
                    @endif
                    @if (session()->has('successDelete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('successDelete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <span aria-hidden="true">&times;</span> 
                        </button>
                        </div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="h3 mb-1 text-gray-800">Data Tagihan Pelanggan Tahun {{ $tahun->tahun }}</h1>
                        </div>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <!-- <a href="/pelanggan-{{$pelanggan->id}}-detail-{{$tahun->id}}/tagihan/create" class="btn btn-primary"> + &nbspTambah Tagihan</a> -->
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Tahun {{ $tahun->tahun }}
                            </button>
                            <div class="dropdown-menu animated--fade-in"
                                aria-labelledby="dropdownMenuButton">
                                @foreach ($getTahun as $p)
                                <a class="dropdown-item" href="/pelanggan-{{ $pelanggan->id }}-detail-{{ $p->tahun }}">{{ $p->tahun }}</a>
                                @endforeach
                            </div>
                            <div>
                            <!-- </div> -->
                            <a class="btn btn-primary" href="/pelanggan-{{$pelanggan->id}}-detail-{{$tahun->id}}/tagihan/export">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                </svg>
                                Export Data
                            </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%;">No</th>
                                            <!-- <th>ID Pelanggan</th>
                                            <th>Nama</th> -->
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>KWH</th>
                                            <th>Kelas Tarif</th>
                                            <th>Total Tagihan</th>
                                            <!-- <th style="width:15%">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihan as $dataTagihan => $t)
                                        <tr>
                                            <td class="text-wrap text-center">{{ $dataTagihan + 1 }}</td>
                                            <!-- <td>{{ $t -> pelanggan -> id_pelanggan ?? '-' }}</td>
                                            <td>{{ $t -> pelanggan -> nama ?? '-' }}</td> -->
                                            <td>{{ $t -> tahun -> tahun ?? '-' }}</td>
                                            <td>{{ $t -> bulan -> bulan ?? '-'}}</td>
                                            <td>{{ $t -> kwh ?? '-' }}</td> 
                                            <td>{{ $t -> kelas_tarif ?? '-' }}</td> 
                                            <td>Rp. {{ number_format($t->total_tagihan, 0, ',', '.') ?? '-' }}</td>      
                                            <!-- <td>
												<a class="btn btn-icon btn-warning btn-sm btn-active-light-primary w-30px h-30px me-3" href="/pelanggan-{{$pelanggan->id}}-detail-{{$tahun->id}}/tagihan/edit/{{$t->id}}">
                                                Edit
                                                </a>
												<a class="btn btn-icon btn-danger btn-sm btn-active-light-primary w-30px h-30px" href="/pelanggan-{{$pelanggan->id}}-detail-{{$tahun->id}}/tagihan/destroy/{{$t->id}}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">
                                                Hapus
                                                </a>
											</td>                                -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-grey-800">Grafik Tagihan Pelanggan Tahun {{$tahun->tahun}}</h6>
                                </div>
                                <div class="card-body">
                                <canvas id="myChart" height="100px"></canvas>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  

<script type="text/javascript">

      //var labels =  {{ Js::from($tagihan) }};
      //var users =  {{ Js::from($pelanggan) }};
      const tagihan = {!! json_encode($chartBulan) !!};

      const data = {
        // labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober','November','Desember'],
        datasets: [
                {
                    label: 'Tagihan',
                    data: tagihan,
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    backgroundColor: ['rgba(255, 99, 132, 1)'],
                    fill: false,
                    pointRadius:7,
                },
        ]
      };

      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
</script>

@endsection