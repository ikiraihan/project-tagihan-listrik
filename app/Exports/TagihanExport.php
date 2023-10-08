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

class TagihanExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $tahun;
    private $bulan;
    public function __construct($tahun,$bulan){
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama Pelanggan',
            'Tahun',
            'Bulan',
            'KWH',
            'Kelas Tarif',
            'Total Tagihan'
        ];
    }
    public function collection()
    {   
        // $tahun = Tahun::findOrFail($this->id);
        // $pelanggan = Pelanggan::all();
        return Tagihan::with(['pelanggan','tahun'])
        ->where('id_tahun',$this->tahun)
        ->where('id_bulan',$this->bulan)
        ->get();
    }

    public function map($tagihan):array
    {
        return[
            $tagihan->pelanggan->id_pelanggan,
            $tagihan->pelanggan->nama,
            $tagihan->tahun->tahun,
            $tagihan->bulan->bulan,
            $tagihan->kwh,
            $tagihan->kelas_tarif,
            $tagihan->total_tagihan,
            //number_format($tagihan->total_tagihan, 0, ',', '.'),
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
