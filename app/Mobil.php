<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = ['no_polisi', 'merk_mobil', 'jenis_mobil', 'harga', 'transmisi', 'kapasitas', 'like', 'use', 'ketersediaan', 'img'];
    protected $primaryKey = 'id_mobil';

    public function mobils()
    {
        return $this->hasOne(Pinjam::class);
    }
}
