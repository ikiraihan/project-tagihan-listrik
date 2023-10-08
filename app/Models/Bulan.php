<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    use HasFactory;
    protected $table = 'bulan';

    protected $fillable = [
        'bulan',
    ];

    public function tagihans()
    {
	return $this->hasMany(Tagihan::class,'id','id_bulan');
    }
}
