<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        foreach ($users as $user){
            $user->view_user = [
                'href' => 'api/admin/user'.$user->id_user,
                'method' => 'GET'
            ];
        }

        $response =[
            'msg' => 'Daftar tabel Admin',
            'user' => $users
        ];

        return response()->json($response, 200);
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
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $nama = $request->input('nama');
        $jk = $request->input('jk');
        $alamat = $request->input('alamat');
        $email = $request->input('email');
        $password = $request->input('password');
        
        $user = new User([
            'nama' => $nama,
            'jk' => $jk,
            'alamat' => $alamat,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        if($user->save()){
            $user->view_user = [
                'href' => 'api/admin/user/'.$user->id_user,
                'method' => 'GET'
            ];
            $message = [
                'msg' => 'Data User berhasil dibuat',
                'data' => $user
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
        $user = User::findOrFail($id);

        $user->view_user = [
            'href' => 'api/admin/user',
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Informasi Admin',
            'user' => $user
        ];

        return response()->json($response, 200);
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
        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $nama = $request->input('nama');
        $jk = $request->input('jk');
        $alamat = $request->input('alamat');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::findOrFail($id);
        $user->nama = $nama;
        $user->jk = $jk;
        $user->alamat = $alamat;
        $user->email = $email;
        $user->password = bcrypt($password);

        if(!$user->update()){
            return response()->json([
                'msg' => 'Error during update'
            ], 404);
        };

        $user->view_user = [
            'href' => 'api/admin/user'.$user->id_user,
            'method' => 'GET'
        ];

        $response = [
            'msg' => 'Data Admin ter-Update',
            'user' => $user
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
        $user = User::findOrFail($id);

        if(!$user->delete()){
            return response()->json([
                'msg' => 'Deletion Failed'
            ], 404);
        }

        $response = [
            'msg' => 'Data Admin Terhapus',
            'create' => [
                'href' => 'api/admin/user',
                'method' => 'POST',
                'params' => 'nama, jk, alamat, email, password'
            ]
        ];
        return response()->json($response, 200);
    }

    public function user()
    {
        $user = User::all();

        return view('admin/user', ['user' => $user]);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('admin/user');
    }

    public function proses_update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::where('id_user', $request->id_user)->update([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('admin/user');
    }

    public function hapus($id)
    {
      // hapus data
      User::where('id_user',$id)->delete();

      return redirect('admin/user');
    }
}
