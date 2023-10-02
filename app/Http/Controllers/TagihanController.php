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

        $request->session()->flash('success','Data Tagihan Berhasil ditambahkan!');

        return redirect("/$tahun->id-tagihan-$bulan");
    }

    public function edit($id,$bulan,$tagihan)
    {
        $tahun = Tahun::findOrFail($id);
        $pelanggan = Pelanggan::all();
        // $bulan = Bulan::findOrFail($id);
        // $tagihan = Tagihan::with(['pelanggan','tahun'])
        //                 ->where('id_tahun', $id)
        //                 ->where('bulan', $bulan)
        //                 ->get();
        $tagihan = Tagihan::findOrFail($tagihan);

        return view('tagihan.edit', [
            'title' => 'Edit tagihan',
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ]);
    }

    public function update(Request $request,$id,$bulan,$tagihan)
    {
        $tahun = Tahun::findOrFail($id);

        Tagihan::where('id', $tagihan)->update([
            'id_pelanggan'  => $request->id_pelanggan,
            'id_tahun'  => $request->id_tahun,
            'bulan'  => $request->bulan,
            'kwh'  => $request->kwh,
            'kelas_tarif'  => $request->kelas_tarif,
            'total_tagihan'  => $request->total_tagihan,
        ]);

        $request->session()->flash('success', 'Data Tagihan Berhasil diupdate!');

        return redirect("/$tahun->id-tagihan-$bulan");
    }

    public function destroy($id,$bulan,$tagihan)
    {
        Tagihan::destroy($tagihan);
		
        return redirect("/$id-tagihan-$bulan")->with('successDelete', 'Data Tagihan Berhasil dihapus!');
        
    }
}
