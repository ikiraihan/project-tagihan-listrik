<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Exports\TagihanPelangganExport;
use App\Models\Bulan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Tahun;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){

        $pelanggan = Pelanggan::all();
        $yearNow = date('Y');
        
        return view('pelanggan.index', [
            'title' => 'Pelanggan',
            'pelanggan' => $pelanggan,
            'yearNow' => $yearNow,
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
        $getTahun = Tahun::orderBy('tahun')->get();

        $tahun = Tahun::where('tahun',$tahun)->first();
        
        //untuk chart bulan
        for ($i = 1; $i <= 12; $i++) {

            $labelBulan=Bulan::where('id',$i)
            ->value('bulan');

            $chartBulan[$labelBulan]=Tagihan::with(['pelanggan','tahun','bulan'])
            ->where('id_pelanggan',$id)
            ->where('id_tahun',$tahun->id)
            ->where('id_bulan', $i)
            ->value('total_tagihan');
            
            if($chartBulan[$labelBulan]==null){
                $chartBulan[$labelBulan]='0';
            }

        }

        $getYear = ($tahun->tahun)-5;
        //dd($yearNow);

        //untuk chart 5 tahun
        for ($k = 1; $k <= 6; $k++) {

            $valTahun= Tahun::where('tahun',$getYear)->value('id');
            $tambahTotalTagihan=0;

            //dd($valTahun);
            for ($j = 1; $j <= 12; $j++) {
    
                $totalTagihan=Tagihan::with(['pelanggan','tahun','bulan'])
                ->where('id_pelanggan',$id)
                ->where('id_tahun',$valTahun)
                ->where('id_bulan', $j)
                ->value('total_tagihan');
                
                if($totalTagihan==null){
                    $totalTagihan='0';
                }

                $tambahTotalTagihan=$tambahTotalTagihan+$totalTagihan;
    
            }

            $chartLimaTahun[$getYear]=$tambahTotalTagihan;
            
            if($chartLimaTahun[$getYear]==null){
                $chartLimaTahun[$getYear]='0';
            }

            $getYear=$getYear+1;
            //dd($getYear);

        }
        //dd($chartBulan);
        //dd($chartLimaTahun);

        $tagihan = Tagihan::with(['pelanggan','tahun'])
        ->where('id_pelanggan',$id)
        ->where('id_tahun',$tahun->id)
        ->orderByraw('CHAR_LENGTH(id_bulan) ASC')
        ->orderBy('id_bulan', 'ASC')
        ->get();

        return view('pelanggan.detail', [
            'title' => 'Pelanggan',
            'pelanggan' => $pelanggan,
            'getTahun' => $getTahun,
            'tahun' => $tahun,
            'tagihan' => $tagihan,
            'chartBulan' => $chartBulan,
            'chartLimaTahun' => $chartLimaTahun
        ]);
    }

    public function exportExcel()
	{   
		return Excel::download(new PelangganExport, 'pelanggan.xlsx');
	}

    public function exportExcelTagihanPelanggan($id,$tahun)
	{   
        $pelanggan = Pelanggan::findOrFail($id);
        $tahun = Tahun::findOrFail($tahun);
        // $tagihan = Tagihan::with(['pelanggan','tahun'])
        // ->where('id', $id)                        
        // ->where('id_tahun', $tahun)
        // ->get();
		return Excel::download(new TagihanPelangganExport($id,$tahun->id), 'tagihan-'.$pelanggan->nama.'-'.$tahun->tahun.'.xlsx');
	}

    // public function createTagihan($id,$tahun)
    // {
    //     //$tahun = Tahun::findOrFail($id);
    //     $pelanggan = Pelanggan::findOrFail($id);
    //     //dd($pelanggan);
    //     $getTahun = Tahun::orderBy('tahun')->get();
    //     $tagihan = Tagihan::with(['pelanggan','tahun'])
    //                     ->where('id_pelanggan',$id)
    //                     ->where('id_tahun', $tahun)
    //                     ->get();

    //     return view('pelanggan.create-tagihan', [
    //         'title' => 'Tambah tagihan',
    //         'tagihan' => $tagihan,
    //         'pelanggan' => $pelanggan,
    //         'getTahun' => $getTahun,
    //         'tahun' => $tahun,
    //     ]);
    // }

    // public function storeTagihan(Request $request,$id,$tahun)
    // {   
    //     $pelanggan = Pelanggan::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'id_pelanggan'  => 'required',
    //         'id_tahun'  => 'required',
    //         'bulan'  => 'required',
    //         'kwh'  => 'required',
    //         'kelas_tarif'  => 'required',
    //         'total_tagihan'  => 'required',
    //     ]);

    //     Tagihan::create($validatedData);
    //     // dd($validatedData);

    //     $request->session()->flash('success','Data Tagihan Berhasil ditambahkan!');

    //     return redirect("/pelanggan-$id-detail-$request->id_tahun");
    // }

    // public function editTagihan($id,$tahun,$tagihan)
    // {
    //     $tahun = Tahun::findOrFail($tahun);
    //     $pelanggan = Pelanggan::findOrFail($id);
    //     // $bulan = Bulan::findOrFail($id);
    //     // $tagihan = Tagihan::with(['pelanggan','tahun'])
    //     //                 ->where('id_tahun', $id)
    //     //                 ->where('bulan', $bulan)
    //     //                 ->get();
    //     $getTahun = Tahun::orderBy('tahun')->get();
    //     $tagihan = Tagihan::findOrFail($tagihan);

    //     return view('pelanggan.edit-tagihan', [
    //         'title' => 'Edit tagihan',
    //         'tagihan' => $tagihan,
    //         'pelanggan' => $pelanggan,
    //         'tahun' => $tahun,
    //         'getTahun' => $getTahun,
    //     ]);
    // }

    // public function updateTagihan(Request $request,$id,$tahun,$tagihan)
    // {
    //     $pelanggan = Pelanggan::findOrFail($id);

    //     Tagihan::where('id', $tagihan)->update([
    //         'id_pelanggan'  => $request->id_pelanggan,
    //         'id_tahun'  => $request->id_tahun,
    //         'bulan'  => $request->bulan,
    //         'kwh'  => $request->kwh,
    //         'kelas_tarif'  => $request->kelas_tarif,
    //         'total_tagihan'  => $request->total_tagihan,
    //     ]);

    //     $request->session()->flash('success', 'Data Tagihan Berhasil diupdate!');

    //     return redirect("/pelanggan-$id-detail-$request->id_tahun");
    // }

    // public function destroyTagihan($id,$tahun,$tagihan)
    // {
    //     Tagihan::destroy($tagihan);
		
    //     return redirect("/pelanggan-$id-detail-$tahun")->with('successDelete', 'Data Tagihan Berhasil dihapus!');
        
    // }
}
