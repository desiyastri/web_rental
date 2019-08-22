<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pinjam;
use App\Mobil;
use App\Pelanggan;

use Carbon\Carbon;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_pinjam' => 'required',
            'tgl_mulai' => 'required',
            'lama_pinjam' => 'required',
            'status' => 'required',
            'id_mobil' => 'required',
            'id_pelanggan' => 'required',
        ]);

        $kode_pinjam = $request->input('kode_pinjam');
        $tgl_mulai = $request->input('tgl_mulai');
        $lama_pinjam = $request->input('lama_pinjam');
        //$jumlah_bayar = $request->input('jumlah_bayar');
        $denda = $request->input('denda');
        $status = $request->input('status');
        $id_mobil = $request->input('id_mobil');
        $id_pelanggan = $request->input('id_pelanggan');

        $tgl_selesai = date('Y-m-d', strtotime($tgl_mulai.' +'.$lama_pinjam.' days'));
        
        $car = Mobil::find($request->id_mobil);
        $jumlah_bayar = $car->harga*$lama_pinjam;
        $car->ketersediaan = '0';
        $car->save();

        $pelanggan = Pelanggan::find($request->id_pelanggan);
        $pelanggan->status_pinjam = '0';
        $pelanggan->save();

        $pinjam = new Pinjam([
            'kode_pinjam' => $kode_pinjam,
            'tgl_mulai' =>  $tgl_mulai,
            'lama_pinjam' => $lama_pinjam,
            'tgl_selesai' => $tgl_selesai,
            'jumlah_bayar' => $jumlah_bayar,
            'status' => $status,
            'id_mobil' => $id_mobil,
            'id_pelanggan' => $id_pelanggan
        ]);

        if($pinjam->save()){
            $pinjam->view_pinjam = [
                'href' => 'api/admin/pinjam/'.$pinjam->id_pinjam,
                'method' => 'GET'
            ];
            $message = [
                'msg' => 'Data Pinjaman Mobil berhasil Dibuat',
                'data' => $pinjam
            ];
            return response()->json($message, 201);
        }

        $response = [
            'msg' => 'Error during creationg'
        ];
        return response()->json($response, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pinjam(){
        $pinjam = Pinjam::join('pelanggans', 'pelanggans.id_pelanggan', '=', 'pinjams.id_pelanggan')->join('mobils', 'mobils.id_mobil', '=', 'pinjams.id_mobil')->get();
        
        return view('admin/pinjam', ['pinjam' => $pinjam]);
    }
}
