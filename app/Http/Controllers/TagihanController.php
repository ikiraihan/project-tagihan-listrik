<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Tahun;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function indexxx(){

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

    public function viewBulan($id){

        $tahun = Tahun::findOrFail($id);
        // $bulan = Bulan::findOrFail($id);
        $tagihan = Tagihan::all();

        return view('tagihan.bulan', [
            'title' => 'Tahun Tagihan',
            'tahun' => $tahun,
            'tagihan' => $tagihan
        ]);
    }

    public function viewDataTagihan($id,$bulan){

        $tahun = Tahun::findOrFail($id);
        // $bulan = Bulan::findOrFail($id);
        $tagihan = Tagihan::with(['pelanggan','tahun'])
                        ->where('id_tahun', $id)
                        ->where('bulan', $bulan)
                        ->get();

        return view('tagihan.data-tagihan', [
            'title' => 'Tahun Tagihan',
            'tahun' => $tahun,
            'bulan' => $bulan,
            'tagihan' => $tagihan
        ]);
    }

    public function storeTahun(Request $request)
    {   
        
        $validatedData = $request->validate([
            'nama'  => 'required',
        ]);

        Tahun::create($validatedData);

        $request->session()->flash('success','Data Tahun Berhasil ditambahkan!');

        // return redirect('/tagihan/tahun');
    }

    public function create($id,$bulan)
    {
        $tahun = Tahun::findOrFail($id);
        $pelanggan = Pelanggan::all();
        // $bulan = Bulan::findOrFail($id);
        $tagihan = Tagihan::with(['pelanggan','tahun'])
                        ->where('id_tahun', $id)
                        ->where('bulan', $bulan)
                        ->get();

        return view('tagihan.create', [
            'title' => 'Tambah tagihan',
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ]);
    }

    public function store(Request $request,$id,$bulan)
    {   
        $tahun = Tahun::findOrFail($id);

        $validatedData = $request->validate([
            'id_pelanggan'  => 'required',
            'id_tahun'  => 'required',
            'bulan'  => 'required',
            'kwh'  => 'required',
            'kelas_tarif'  => 'required',
            'total_tagihan'  => 'required',
        ]);

        Tagihan::create($validatedData);
        // dd($validatedData);

        $request->session()->flash('success','Data tagihan Berhasil ditambahkan!');

        return redirect("/$tahun->id-tagihan-$bulan");
    }
}
