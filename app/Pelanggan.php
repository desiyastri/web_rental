<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = ['nama', 'alamat', 'jk', 'no_telp', 'email', 'password', 'status_pinjam'];
    protected $primaryKey = 'id_pelanggan';

    public function pelanggans()
    {
        return $this->hasOne(Pinjam::class);
    }
}
