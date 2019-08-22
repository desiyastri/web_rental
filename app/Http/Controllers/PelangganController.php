<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        foreach ($pelanggans as $pelanggan){
            $pelanggan->view_pelanggan = [
                'href' => 'api/admin/pelanggan'.$pelanggan->id_pelanggan,
                'method' => 'GET'
            ];
        }

        $response =[
            'msg' => 'Daftar tabel Pelanggan',
            'pelanggan' => $pelanggans
        ];

        return response()->json($response, 200);
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
            'nama' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $jk = $request->input('jk');
        $no_telp = $request->input('no_telp');
        $email = $request->input('email');
        $password = $request->input('password');
        
        $pelanggan = new Pelanggan([
            'nama' => $nama,
            'alamat' => $alamat,
            'jk' => $jk,
            'no_telp' => $no_telp,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        if($pelanggan->save()){
            $pelanggan->view_pelanggan = [
                'href' => 'api/admin/pelanggan/'.$pelanggan->id_pelanggan,
                'method' => 'GET'
            ];
            $message = [
                'msg' => 'Data Pelanggan berhasil dibuat',
                'data' => $pelanggan
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
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->view_pelanggan = [
            'href' => 'api/admin/pelanggan',
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Informasi Pelanggan',
            'pelanggan' => $pelanggan
        ];

        return response()->json($response, 200);
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
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $jk = $request->input('jk');
        $no_telp = $request->input('no_telp');
        $email = $request->input('email');
        $password = $request->input('password');

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->nama = $nama;
        $pelanggan->alamat = $alamat;
        $pelanggan->jk = $jk;
        $pelanggan->no_telp = $no_telp;
        $pelanggan->email = $email;
        $pelanggan->password = bcrypt($password);

        if(!$pelanggan->update()){
            return response()->json([
                'msg' => 'Error during update'
            ], 404);
        };

        $pelanggan->view_pelanggan = [
            'href' => 'api/admin/pelanggan'.$pelanggan->id_pelanggan,
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Data Pelanggan ter-Update',
            'pelanggan' => $pelanggan
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        if(!$pelanggan->delete()){
            return response()->json([
                'msg' => 'Deletion Failed'
            ], 404);
        }

        $response = [
            'msg' => 'Data Pelanggan Terhapus',
            'create' => [
                'href' => 'api/admin/pelanggan',
                'method' => 'POST',
                'params' => 'nama, alamat, jk, no_telp, email, password'
            ]
        ];
        return response()->json($response, 200);
    }

    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();

        return view('admin/pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('admin/pelanggan');
    }

    public function proses_update(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        Pelanggan::where('id_pelanggan', $request->id_pelanggan)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('admin/pelanggan');
    }

    public function hapus($id)
    {
      // hapus data
      Pelanggan::where('id_pelanggan',$id)->delete();

      return redirect('admin/pelanggan');
    }
}
