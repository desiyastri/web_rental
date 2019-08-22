<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kembali;
use App\Pinjam;
use App\Mobil;
use App\Pelanggan;
use DateTime;

class KembaliController extends Controller
{
    public function kembali(){
        $pinjam = Pinjam::join('pelanggans', 'pelanggans.id_pelanggan', '=', 'pinjams.id_pelanggan')->join('mobils', 'mobils.id_mobil', '=', 'pinjams.id_mobil')->get();
        
        return view('admin/kembali/kembali', ['pinjam' => $pinjam]);
    }

    public function informasi(Request $request)
    {
        $kode_pinjam = $request->kode_pinjam;

        if($kode_pinjam == '')
        {
            $request->sesion()->confirm('Select data from table');
            return redirect()->route('admin/kembali/kembali');
        }

        $table_pinjam = Pinjam::where('kode_pinjam', $kode_pinjam)->first();

        if($table_pinjam->tgl_selesai < date('Y-m-d'))
        {
            $tgl_selesai = new DateTime($table_pinjam->tgl_selesai);
            $pengembalian = new DateTime(date('Y-m-d'));
            $selisih = $tgl_selesai->diff($pengembalian);
            for($i=0.5; $i<=$selisih->days; $i++){
                $denda = ($table_pinjam->jumlah_bayar * $i.'0')/10;
            }
            $data['denda'] = $denda;
            $data['telat'] = $selisih->days;
        } else {
            $data['denda'] = null;
            $data['telat'] = null;
        }

        // $data['pembayaran'] = Kembali::where('kode_pinjam', $kode_pinjam)->get()->first();
        $data['data'] = $table_pinjam;
        $data['pelanggan'] = Pelanggan::find($table_pinjam->id_pelanggan);
        $data['mobil'] = Mobil::find($table_pinjam->id_mobil);
        $data['total'] = $table_pinjam->jumlah_bayar + $data['denda'];

        return view('admin/kembali/informasi', $data);


    }
}
