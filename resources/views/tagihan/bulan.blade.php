@extends('layouts.dashboard')

@section('content')
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Bulan Tagihan</h1>
                    <a href="/tagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Kembali
                    </a>
                   
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th style="width:8%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getBulan as $gt)
                                        <tr>
                                            <td>{{ $gt->bulan }}</td>   
                                            <td>
                                                <a class="btn btn-icon btn-primary btn-active-light-primary w-30px h-30px me-3" href="/{{$tahun->tahun}}-tagihan-{{ $gt->id }}">
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