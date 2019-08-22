<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mobil;
use File;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobils = Mobil::all();
        foreach ($mobils as $mobil){
            $mobil->view_mobil = [
                'href' => 'api/admin/mobil/'.$mobil->id,
                'method' => 'GET'
            ];
        }

        $response = [
            'msg' => 'Daftar tabel Mobil',
            'mobil' => $mobils
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
            'no_polisi' => 'required',
            'merk_mobil' => 'required',
            'jenis_mobil' => 'required',
            'harga' => 'required',
            'transmisi' => 'required',
            'kapasitas' => 'required',
            'like' => 'required',
            'use' => 'required',
            'ketersediaan' => 'required',
            'img' => 'required'
        ]);

        $no_polisi = $request->input('no_polisi');
        $merk_mobil = $request->input('merk_mobil');
        $jenis_mobil = $request->input('jenis_mobil');
        $harga = $request->input('harga');
        $transmisi = $request->input('transmisi');
        $kapasitas = $request->input('kapasitas');
        $like = $request->input('like');
        $use = $request->input('use');
        $ketersediaan = $request->input('ketersediaan');
        $img = $request->file('img');

        $nama_file = time()."_".$img->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'img_rental';
        $img->move($tujuan_upload,$nama_file);

        $mobil = new Mobil([
            'no_polisi' => $no_polisi,
            'merk_mobil' => $merk_mobil,
            'jenis_mobil' => $jenis_mobil,
            'harga' => $harga,
            'transmisi' => $transmisi,
            'kapasitas' => $kapasitas,
            'like' => $like,
            'use' => $use,
            'ketersediaan' => $ketersediaan,
            'img' => $nama_file
        ]);

        if($mobil->save()) {
            $mobil->view_mobil = [
                'href' => 'api/admin/mobil/'.$mobil->id,
                'method' => 'GET'
            ];
            $message = [
                'msg' => 'Data Mobil berhasil Dibuat',
                'data' => $mobil
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
        $mobil = Mobil::where('id_mobil', $id)->first();

        $mobil->view_mobil = [
            'href' => 'api/admin/mobil',
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Informasi Mobil',
            'mobil' => $mobil
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
            'no_polisi' => 'required',
            'merk_mobil' => 'required',
            'jenis_mobil' => 'required',
            'harga' => 'required',
            'kapasitas' => 'required',
            'transmisi' => 'required',
            'like' => 'required',
            'use' => 'required',
            'ketersediaan' => 'required',
            'img' => 'required'
        ]);

        $no_polisi = $request->input('no_polisi');
        $merk_mobil = $request->input('merk_mobil');
        $jenis_mobil = $request->input('jenis_mobil');
        $harga = $request->input('harga');
        $transmisi = $request->input('transmisi');
        $kapasitas = $request->input('kapasitas');
        $like = $request->input('like');
        $use = $request->input('use');
        $ketersediaan = $request->input('ketersediaan');
        $img = $request->file('img');



        if(isset($img))
        { 
            $gambar = Mobil::where('id_mobil',$id)->first();
            unlink('img_rental/'.$gambar['img']);
            
            $filename = time()."_".$img->getClientOriginalName();
            $img->move('img_rental', $filename);
        }

        $mobil = Mobil::where('id_mobil', $id)->first();
        $mobil->no_polisi = $no_polisi;
        $mobil->merk_mobil = $merk_mobil;
        $mobil->jenis_mobil = $jenis_mobil;
        $mobil->harga = $harga;
        $mobil->transmisi = $transmisi;
        $mobil->kapasitas = $kapasitas;
        $mobil->like = $like;
        $mobil->use = $use;
        $mobil->ketersediaan = $ketersediaan;
        $mobil->img = $filename;

        if(!$mobil->update()){
            return response()->json([
                'msg' => 'Error during update'
            ], 404);
        };

        $mobil->view_mobil = [
            'href' => 'api/admin/mobil'.$mobil->id,
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Data Mobil ter-Update',
            'mobil' => $mobil
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
        // hapus file
        $mobil = Mobil::where('id_mobil',$id)->first();
        unlink('img_rental/'.$mobil['img']);

        if(!$mobil->delete()){
            return response()->json([
                'msg' => 'Deletion Failed'
            ], 404);
        }

        $response = [
            'msg' => 'Data Mobil Terhapus',
            'create' => [
                'href' => 'api/admin/mobil',
                'method' => 'POST',
                'params' => 'no_polisi, merk_mobil, jenis_mobil, harga, transmisi, kapasitas, like, use, ketersediaan, img'
            ]
        ];
        return response()->json($response, 200);

    }

    public function mobil()
    {
      $mobil = Mobil::all();

      return view('admin/mobil',['mobil' => $mobil]);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'no_polisi' => 'required',
            'merk_mobil' => 'required',
            'jenis_mobil' => 'required',
            'harga' => 'required',
            'transmisi' => 'required',
            'kapasitas' => 'required',
            'like' => 'required',
            'use' => 'required',
            'img' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
          ]);
    
          // menyimpan data file yang diupload ke variabel $file
          $file = $request->file('img');
    
          $nama_file = time()."_".$file->getClientOriginalName();
    
          // isi dengan nama folder tempat kemana file diupload
          $tujuan_upload = 'img_rental';
          $file->move($tujuan_upload,$nama_file);
    
          Mobil::create([
            'no_polisi' => $request->no_polisi,
            'merk_mobil' => $request->merk_mobil,
            'jenis_mobil' => $request->jenis_mobil,
            'harga' => $request->harga,
            'transmisi' => $request->transmisi,
            'kapasitas' => $request->kapasitas,
            'like' => $request->like,
            'use' => $request->use,
            'img' => $nama_file
          ]);
    
          return redirect('admin/mobil');
    }

    public function proses_update(Request $request)
    {
        $this->validate($request,[
            'no_polisi' => 'required',
            'merk_mobil' => 'required',
            'jenis_mobil' => 'required',
            'harga' => 'required',
            'transmisi' => 'required',
            'kapasitas' => 'required',
            'like' => 'required',
            'use' => 'required',
            'img' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            ]);
    
        $file = $request->file('img');
        
        
          if(!$file == "")
          { 
            $mobil = Mobil::where('id_mobil', $request->id_mobil)->first();
            unlink('img_rental/'.$mobil['img']);

            $filename = time()."_".$file->getClientOriginalName();
            $file->move("img_rental/", $filename);
            
          }
          
          Mobil::where('id_mobil', $request->id_mobil)->update([
            'no_polisi' => $request->no_polisi,
            'merk_mobil' => $request->merk_mobil,
            'jenis_mobil' => $request->jenis_mobil,
            'harga' => $request->harga,
            'transmisi' => $request->transmisi,
            'kapasitas' => $request->kapasitas,
            'like' => $request->like,
            'use' => $request->use,
            'ketersediaan' =>$request->ketersediaan,
            'img' => $filename
            ]);
          
          
          return redirect('admin/mobil');
    }

    public function hapus($id)
    {
      // hapus file
      $gambar = Mobil::where('id_mobil',$id)->first();
      File::delete('img_rental/'.$gambar->img);

      // hapus data
      Mobil::where('id_mobil',$id)->delete();

      return redirect('admin/mobil');
    }
}
