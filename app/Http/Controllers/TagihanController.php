<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Tahun;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(){

        // $tagihan = Tagihan::all();
        $tagihan = Tagihan::with(['pelanggan','tahun'])->get();

        return view('tagihan.index', [
            'title' => 'Tagihan',
            'tagihan' => $tagihan
        ]);
    }

    public function viewTahun(){

        $tahun = Tahun::all();
        //$tagihan = Tagihan::with(['pelanggan','tahun'])->get();

        return view('tagihan.tahun', [
            'title' => 'Tahun Tagihan',
            'tahun' => $tahun
        ]);
    }
}
