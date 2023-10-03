<?php

namespace App\Exports;

use App\Models\Pelanggan;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PelangganExport implements FromCollection, WithMapping, WithHeadings, WithEvents, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama Pelanggan',
            'Alamat',
            'Daya',
        ];
    }
    public function collection()
    {   
        // $tahun = Tahun::findOrFail($this->id);
        // $pelanggan = Pelanggan::all();
        return Pelanggan::all();
    }

    public function map($pelanggan):array
    {
        return[
            $pelanggan->id_pelanggan,
            $pelanggan->nama,
            $pelanggan->alamat,
            $pelanggan->daya,
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
            'A' => 20,
            'B' => 20,
            'C' => 25,
            'D' => 10,
        ];
    }
}
