<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $fillable = ['id_kembali', 'id_pinjam', 'id_user', 'bayar', 'uang_kembali'];
    protected $primaryKey = 'id_kembali';
}
