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
            'title' => 'Bulan Tagihan',
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
            'title' => 'Data Tagihan',
            'tahun' => $tahun,
            'bulan' => $bulan,
            'tagihan' => $tagihan
        ]);
    }

    public function createTahun(){

        //$tahun = Tahun::all();
        //$tagihan = Tagihan::with(['pelanggan','tahun'])->get();

        return view('tagihan.create-tahun', [
            'title' => 'Tambah Tahun Tagihan',
        ]);
    }

    public function storeTahun(Request $request)
    {   
        
        $validatedData = $request->validate([
            'tahun'  => 'required|unique:tahun',
        ]);

        Tahun::create($validatedData);

        $request->session()->flash('success','Data Tahun Berhasil ditambahkan!');

        return redirect('/tagihan');
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
        $tahun = Tahun::where('tahun',$tahun)->first();
        $bulan = Bulan::where('id',$bulan)->first();
        $total_tagihan = \Str::remove('.', $request->total_tagihan);
        $getPelanggan=Pelanggan::where('id',$request->id_pelanggan)->first();

        $validatedData = $request->validate([
            'id_pelanggan'  => 'required',
            'id_tahun'  => 'required',
            'id_bulan'  => 'required',
            'kwh'  => 'required',
            'kelas_tarif'  => 'required',
            'total_tagihan'  => 'required',
        ]);

        $getBulan=Tagihan::where('id_pelanggan',$request->id_pelanggan)
        ->where('id_tahun',$tahun->id)
        ->get();
        $hitung=0;

        foreach($getBulan as $gb){
            if($gb->id_bulan==$request->id_bulan){
                $hitung=$hitung+1;
            }
        }
        //dd($hitung);

        if($hitung==0){
        //Tagihan::create($validatedData);

        $createTagihan = Tagihan::create([
            'id_pelanggan'  => $request->id_pelanggan,
            'id_tahun'  => $request->id_tahun,
            'id_bulan'  => $request->id_bulan,
            'kwh'  => $request->kwh,
            'kelas_tarif'  => $request->kelas_tarif,
            'total_tagihan'  => $total_tagihan,
        ]);
        // dd($validatedData);

        $request->session()->flash('success','Data Tagihan Berhasil ditambahkan!');

        return redirect("/$tahun->tahun-tagihan-$bulan->bulan");
        }else{
            //
            $request->session()->flash('error','Gagal menambahkan data! ID pelanggan '.$getPelanggan->id_pelanggan.' sudah memiliki data tagihan pada Tahun '.$tahun->tahun.' Bulan '.$bulan->bulan.'');

            return redirect("/$tahun->tahun-tagihan-$bulan->id/create");
        }
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
        $tahun = Tahun::where('tahun',$tahun)->first();

        $total_tagihan = \Str::remove('.', $request->total_tagihan);

        Tagihan::where('id', $tagihan)->update([
            'id_pelanggan'  => $request->id_pelanggan,
            'id_tahun'  => $request->id_tahun,
            'id_bulan'  => $request->id_bulan,
            'kwh'  => $request->kwh,
            'kelas_tarif'  => $request->kelas_tarif,
            'total_tagihan'  => $total_tagihan,
        ]);

        $request->session()->flash('success', 'Data Tagihan Berhasil diupdate!');

        return redirect("/$tahun->tahun-tagihan-$bulan");
    }

    public function destroy($tahun,$bulan,$tagihan)
    {   
        // $tahun = Tahun::where('tahun',$tahun)->first();
        // $bulan = Bulan::findOrFail($bulan);

        Tagihan::destroy($tagihan);
		
        return redirect("/$tahun->id-tagihan-$bulan")->with('successDelete', 'Data Tagihan Berhasil dihapus!');
        
    }

    public function exportExcel($tahun,$bulan)
	{   
        $tahun = Tahun::where('tahun',$tahun)->first();
        $bulan = Bulan::findOrFail($bulan);
        //dd($bulan);
        // $tagihan = Tagihan::with(['pelanggan','tahun'])                        
        // ->where('id_tahun', $id)
        // ->where('bulan', $bulan)
        // ->get();
		return Excel::download(new TagihanExport($tahun->id,$bulan->id), 'tagihan-'.$bulan->bulan.'-'.$tahun->tahun.'.xlsx');
	}
}
