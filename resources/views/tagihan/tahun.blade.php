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
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <span aria-hidden="true">&times;</span> 
                            </button>
                        </div>
                    @endif
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tahun Tagihan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <a href="/tagihan/create/tahun" class="btn btn-primary"> + &nbspTambah Tahun</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th style="width:18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tahun as $dataTahun => $p)
                                        <tr>
                                            <td>{{ $p -> tahun }}</td>   
                                            <td>
                                                <a class="btn btn-icon btn-danger btn-active-light-primary w-30px h-30px" href="/tagihan/destroy/tahun/{{ $p->id }} " onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tahun {{ $p -> tahun   }} ?')">
                                                    Hapus
                                                </a>
                                                <a class="btn btn-icon btn-primary btn-active-light-primary w-30px h-30px" href="/{{$p->tahun}}-tagihan">
                                                    Lihat
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
@endsection