<?php

namespace App\Exports;

use App\Models\Tagihan;
use App\Models\Tahun;
use App\Models\Pelanggan;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TagihanPelangganExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithColumnWidths
{
/**
    * @return \Illuminate\Support\Collection
    */
    private $id;
    private $tahun;
    public function __construct($id,$tahun){
        $this->id = $id;
        $this->tahun = $tahun;
    }

    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama Pelanggan',
            'Tahun',
            'Bulan',
            'KWH',
            'kelas Tarif',
            'Total Tagihan'
        ];
    }
    public function collection()
    {   
        // $tahun = Tahun::findOrFail($this->id);
        // $pelanggan = Pelanggan::all();
        return Tagihan::with(['pelanggan','tahun'])->where('id_pelanggan',$this->id)->where('id_tahun',$this->tahun)->get();
    }

    public function map($tagihan):array
    {
        return[
            $tagihan->pelanggan->id_pelanggan,
            $tagihan->pelanggan->nama,
            $tagihan->tahun->tahun,
            $tagihan->bulan,
            $tagihan->KWH,
            $tagihan->kelas_tarif,
            $tagihan->total_tagihan,
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold'=> true
                    ]
                    ]);
            },
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 5,
            'G' => 15

        ];
    }
}
