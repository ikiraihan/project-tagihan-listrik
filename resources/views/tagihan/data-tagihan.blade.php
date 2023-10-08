@extends('layouts.dashboard')

@section('content')
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Tagihan {{ $bulan->bulan }} {{ $tahun->tahun }}</h1>
                    <a href="/{{ $tahun->tahun }}-tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Kembali
                    </a>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="/{{$tahun->tahun}}-tagihan-{{$bulan->id}}/create" class="btn btn-primary"> + &nbspTambah Tagihan</a>
                            <div>
                            <a class="btn btn-primary" href="/{{ $tahun->id }}-tagihan-{{ $bulan }}/export">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                </svg>
                                Export Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%;">No</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <!-- <th>Tahun</th>
                                            <th>Bulan</th> -->
                                            <th>KWH</th>
                                            <th>Kelas Tarif</th>
                                            <th>Total Tagihan</th>
                                            <th style="width:15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihan as $dataTagihan => $t)
                                        <tr>
                                            <td class="text-wrap text-center">{{ $dataTagihan + 1 }}</td>
                                            <td>{{ $t -> pelanggan -> id_pelanggan ?? '-' }}</td>
                                            <td>{{ $t -> pelanggan -> nama ?? '-' }}</td>
                                            <!-- <td>{{ $t -> tahun -> tahun ?? '-' }}</td>
                                            <td>{{ $t -> bulan ?? '-'}}</td> -->
                                            <td>{{ $t -> kwh ?? '-' }}</td> 
                                            <td>{{ $t -> kelas_tarif ?? '-' }}</td> 
                                            <td>{{ $t -> total_tagihan ?? '-' }}</td>      
                                            <td>
                                                <!-- <a class="btn btn-icon btn-success btn-sm btn-active-light-primary w-30px h-30px me-3" href="/">
                                                Detail
                                                </a> -->
												<a class="btn btn-icon btn-warning btn-sm btn-active-light-primary w-30px h-30px me-3" href="/{{$tahun->tahun}}-tagihan-{{$bulan->id}}/edit/{{$t->id}}">
                                                Edit
                                                </a>
												<a class="btn btn-icon btn-danger btn-sm btn-active-light-primary w-30px h-30px" href="/{{$tahun->tahun}}-tagihan-{{$bulan->id}}/destroy/{{$t->id}}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">
                                                Hapus
                                                </a>
											</td>                               
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection