<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'tagihan';

    protected $fillable = [
        'id_pelanggan',
        'id_tahun',
        'id_bulan',
        'kwh',
        'kelas_tarif',
        'total_tagihan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id');
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'id_bulan', 'id');
    }
}
