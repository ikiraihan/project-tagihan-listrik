<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = 'tahun';

    protected $fillable = [
        'nama',
    ];

    public function tagihans()
    {
	return $this->hasMany(Tagihan::class,'id','id_tahun');
    }
}
