<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'alamat',
        'daya',
    ];

    public function tagihans()
    {
	return $this->hasMany(Tagihan::class,'id','id_pelanggan');
    }
}
