<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Tahun;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){

        $pelanggan = Pelanggan::all();

        return view('pelanggan.index', [
            'title' => 'Pelanggan',
            'pelanggan' => $pelanggan
        ]);
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();

        return view('pelanggan.create', [
            'title' => 'Tambah Pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }

    public function store(Request $request)
    {   
        
        $validatedData = $request->validate([
            'id_pelanggan'  => 'required|unique:pelanggan',
            'nama'  => 'required',
            'alamat'  => 'required',
            'daya'  => 'required',
        ]);

        Pelanggan::create($validatedData);

        $request->session()->flash('success','Data Pelanggan Berhasil ditambahkan!');

        return redirect('/pelanggan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        
        return view('pelanggan.edit',[
            'title' => 'Edit Pelanggan',
            'pelanggan' => $pelanggan
        ]);
    }

    public function update(Request $request, $id)
    {
        Pelanggan::where('id', $id)->update([
            'id_pelanggan'  => $request->id_pelanggan,
            'nama'  => $request->nama,
            'alamat'  => $request->alamat,
            'daya'  => $request->daya,
        ]);
        
        $request->session()->flash('success', 'Data Pelanggan Berhasil diedit!');

        return redirect('/pelanggan');
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);
		
        return redirect('/pelanggan')->with('successDelete', 'Data Pelanggan Berhasil dihapus!');
        
    }

    public function detail($id,$tahun)
    {   

        $pelanggan = Pelanggan::findOrFail($id);
        $getTahun = Tahun::all();

        $tagihanJanuari = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Januari')->value('total_tagihan');
        $tagihanFebruari = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Februari')->value('total_tagihan');
        $tagihanMaret = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Maret')->value('total_tagihan');
        $tagihanApril = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','April')->value('total_tagihan');
        $tagihanMei = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Mei')->value('total_tagihan');
        $tagihanJuni = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Juni')->value('total_tagihan');
        $tagihanJuli = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Juli')->value('total_tagihan');
        $tagihanAgustus = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Agustus')->value('total_tagihan');
        $tagihanSeptember = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','September')->value('total_tagihan');
        $tagihanOktober = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Oktober')->value('total_tagihan');
        $tagihanNovember = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','November')->value('total_tagihan');
        $tagihanDesember = Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$id)->where('id_tahun',$tahun)->where('bulan','Desember')->value('total_tagihan');

        //dd($tagihanJanuari);

        //BELOM DIKASI HANDLING KALO MISAL ADA 2 KOLOM BULAN DI TAHUN YANG SAMA 

        $tagihan = Tagihan::with(['pelanggan','tahun'])
        ->where('id_pelanggan',$id)
        ->where('id_tahun',$tahun)
        ->get();

        $tahun = Tahun::findOrFail($tahun);
        return view('pelanggan.detail', [
            'title' => 'Pelanggan',
            'pelanggan' => $pelanggan,
            'getTahun' => $getTahun,
            'tahun' => $tahun,
            'tagihan' => $tagihan,
            'tagihanJanuari' => $tagihanJanuari,
            'tagihanFebruari' => $tagihanFebruari,
            'tagihanMaret' => $tagihanMaret,
            'tagihanApril' => $tagihanApril,
            'tagihanMei' => $tagihanMei,
            'tagihanJuni' => $tagihanJuni,
            'tagihanJuli' => $tagihanJuli,
            'tagihanAgustus' => $tagihanAgustus,
            'tagihanSeptember' => $tagihanSeptember,
            'tagihanOktober' => $tagihanOktober,
            'tagihanNovember' => $tagihanNovember,
            'tagihanDesember' => $tagihanDesember,
        ]);
    }

    public function createTagihan($id,$tahun)
    {
        //$tahun = Tahun::findOrFail($id);
        $pelanggan = Pelanggan::findOrFail($id);
        //dd($pelanggan);
        $getTahun = Tahun::all();
        $tagihan = Tagihan::with(['pelanggan','tahun'])
                        ->where('id_pelanggan',$id)
                        ->where('id_tahun', $tahun)
                        ->get();

        return view('pelanggan.create-tagihan', [
            'title' => 'Tambah tagihan',
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'getTahun' => $getTahun,
            'tahun' => $tahun,
        ]);
    }

    public function storeTagihan(Request $request,$id,$tahun)
    {   
        $pelanggan = Pelanggan::findOrFail($id);

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

        return redirect("/pelanggan-$id-detail-$request->id_tahun");
    }

    public function editTagihan($id,$tahun,$tagihan)
    {
        $tahun = Tahun::findOrFail($tahun);
        $pelanggan = Pelanggan::findOrFail($id);
        // $bulan = Bulan::findOrFail($id);
        // $tagihan = Tagihan::with(['pelanggan','tahun'])
        //                 ->where('id_tahun', $id)
        //                 ->where('bulan', $bulan)
        //                 ->get();
        $getTahun = Tahun::all();
        $tagihan = Tagihan::findOrFail($tagihan);

        return view('pelanggan.edit-tagihan', [
            'title' => 'Edit tagihan',
            'tagihan' => $tagihan,
            'pelanggan' => $pelanggan,
            'tahun' => $tahun,
            'getTahun' => $getTahun,
        ]);
    }

    public function updateTagihan(Request $request,$id,$tahun,$tagihan)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        Tagihan::where('id', $tagihan)->update([
            'id_pelanggan'  => $request->id_pelanggan,
            'id_tahun'  => $request->id_tahun,
            'bulan'  => $request->bulan,
            'kwh'  => $request->kwh,
            'kelas_tarif'  => $request->kelas_tarif,
            'total_tagihan'  => $request->total_tagihan,
        ]);

        $request->session()->flash('success', 'Data Tagihan Berhasil diupdate!');

        return redirect("/pelanggan-$id-detail-$request->id_tahun");
    }

    public function destroyTagihan($id,$tahun,$tagihan)
    {
        Tagihan::destroy($tagihan);
		
        return redirect("/pelanggan-$id-detail-$tahun")->with('successDelete', 'Data Tagihan Berhasil dihapus!');
        
    }

    public function exportExcel()
	{   
		return Excel::download(new PelangganExport, 'pelanggan.xlsx');
	}
}
