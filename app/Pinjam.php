<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $fillable = [
        'kode_pinjam', 'tgl_mulai', 'lama_pinjam', 'tgl_selesai', 'tgl_kembali', 'jumlah_bayar', 'denda', 'status', 'id_mobil', 'id_pelanggan'
    ];

    protected $primaryKey = 'id_pinjam';

    public function p_pelanggan()
    {
        return $this->belongsTo('App\Pelanggan');
    }

    public function p_mobil()
    {
        return $this->belongsTo('App\Mobil');
    }
}
