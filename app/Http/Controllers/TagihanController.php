<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Tahun;
use App\Exports\TagihanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class TagihanController extends Controller
{

    public function viewTahun(){

        $tahun = Tahun::all();
        //$tagihan = Tagihan::with(['pelanggan','tahun'])->get();

        return view('tagihan.tahun', [
            'title' => 'Tahun Tagihan',
            'tahun' => $tahun
        ]);
    }

    public function viewBulan($tahun){

        //$tahun = Tahun::findOrFail($tahun);
        $getBulan=Bulan::all();
        $tahun = Tahun::where('tahun',$tahun)->first();
        //dd($tahun);
        
        // $bulan = Bulan::findOrFail($id);
        $tagihan = Tagihan::all();

        return view('tagihan.bulan', [
            'title' => 'Tahun Tagihan',
            'tahun' => $tahun,
            'tagihan' => $tagihan,
            'getBulan' => $getBulan,
        ]);
    }

    public function viewDataTagihan($tahun,$bulan){

        $tahun = Tahun::where('tahun',$tahun)->first();
        $bulan = Bulan::findOrFail($bulan);

        $tagihan = Tagihan::with(['pelanggan','tahun','bulan'])
                        ->where('id_tahun', $tahun->id)
                        ->where('id_bulan', $bulan->id)
                        ->get();
        //dd($bulan->id);

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

    public function create($tahun,$bulan)
    {
        $tahun = Tahun::where('tahun',$tahun)->first();
        $pelanggan = Pelanggan::all();
        $bulan = Bulan::findOrFail($bulan);
        $tagihan = Tagihan::with(['pelanggan','tahun'])
                        ->where('id_tahun', $tahun->id)
                        ->where('id_bulan', $bulan->id)
                        ->get();

        return view('tagihan.create', [
            'title' => 'Tambah tagihan',
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'tahun' => $tahun,
            'bulan' => $bulan,
        ]);
    }

    public function store(Request $request,$tahun,$bulan)
    {   
        $validatedData = $request->validate([
            'id_pelanggan'  => 'required',
            'id_tahun'  => 'required',
            'id_bulan'  => 'required',
            'kwh'  => 'required',
            'kelas_tarif'  => 'required',
            'total_tagihan'  => 'required',
        ]);

        Tagihan::create($validatedData);
        // dd($validatedData);

        $request->session()->flash('success','Data Tagihan Berhasil ditambahkan!');

        return redirect("/$tahun-tagihan-$bulan");
    }

    public function edit($tahun,$bulan,$tagihan)
    {
        $tahun = Tahun::where('tahun',$tahun)->first();
        $pelanggan = Pelanggan::all();
        $bulan = Bulan::findOrFail($bulan);
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

    public function update(Request $request,$tahun,$bulan,$tagihan)
    {
        //$tahun = Tahun::findOrFail($tahun);

        Tagihan::where('id', $tagihan)->update([
            'id_pelanggan'  => $request->id_pelanggan,
            'id_tahun'  => $request->id_tahun,
            'id_bulan'  => $request->id_bulan,
            'kwh'  => $request->kwh,
            'kelas_tarif'  => $request->kelas_tarif,
            'total_tagihan'  => $request->total_tagihan,
        ]);

        $request->session()->flash('success', 'Data Tagihan Berhasil diupdate!');

        return redirect("/$tahun-tagihan-$bulan");
    }

    public function destroy($tahun,$bulan,$tagihan)
    {   
        // $tahun = Tahun::where('tahun',$tahun)->first();
        // $bulan = Bulan::findOrFail($bulan);

        Tagihan::destroy($tagihan);
		
        return redirect("/$tahun-tagihan-$bulan")->with('successDelete', 'Data Tagihan Berhasil dihapus!');
        
    }

    public function exportExcel($id,$bulan)
	{   
        $tahun = Tahun::findOrFail($id);
        // $tagihan = Tagihan::with(['pelanggan','tahun'])                        
        // ->where('id_tahun', $id)
        // ->where('bulan', $bulan)
        // ->get();
		return Excel::download(new TagihanExport($id,$bulan), 'tagihan-'.$bulan.'-'.$tahun->tahun.'.xlsx');
	}
}
