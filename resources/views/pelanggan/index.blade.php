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
                    <h1 class="h3 mb-2 text-gray-800">Tabel Pelanggan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="/pelanggan/create" class="btn btn-primary"> + &nbspTambah Pelanggan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%;">No</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Daya</th>
                                            <th style="width:20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelanggan as $dataPelanggan => $p)
                                        <tr>
                                            <td class="text-wrap text-center">{{ $dataPelanggan + 1 }}</td>
                                            <td>{{ $p -> id_pelanggan ?? '-'}}</td>
                                            <td>{{ $p -> nama ?? '-' }}</td>
                                            <td>{{ $p -> alamat ?? '-' }}</td>
                                            <td>{{ $p -> daya ?? '-' }}</td>      
                                            <td>
                                                <a class="btn btn-icon btn-success btn-sm btn-active-light-primary w-30px h-30px me-3" href="/">
                                                Detail
                                                </a>
												<a class="btn btn-icon btn-warning btn-sm btn-active-light-primary w-30px h-30px me-3" href="/pelanggan/edit/{{ $p->id }}">
                                                Edit
                                                </a>
												<a class="btn btn-icon btn-danger btn-sm btn-active-light-primary w-30px h-30px" href="/pelanggan/destroy/{{ $p->id }}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">
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