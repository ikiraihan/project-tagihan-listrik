<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
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

    public function show($id)
    {
        //
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
}
