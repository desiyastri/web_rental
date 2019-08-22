<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//route mobil
Route::get('admin/mobil', 'MobilController@mobil');
Route::post('/mobilAction','MobilController@upload');
Route::put('/mobilUpdate', 'MobilController@proses_update');
Route::get('admin/mobil/hapus/{id}', 'MobilController@hapus');


//route pelanggan
Route::get('admin/pelanggan', 'PelangganController@pelanggan');
Route::post('/pelangganAction', 'PelangganController@upload');
Route::put('/pelangganUpdate', 'PelangganController@proses_update');
Route::get('admin/pelanggan/hapus/{id}', 'PelangganController@hapus');

//route pegawai
Route::get('admin/user', 'UserController@user');
Route::post('/pegawaiAction', 'UserController@upload');
Route::put('/userUpdate', 'UserController@proses_update');
Route::get('admin/user/hapus/{id}', 'UserController@hapus');

Route::get('admin/pinjam', 'PinjamController@pinjam');

Route::get('admin/kembali', 'KembaliController@kembali');
Route::get('admin/kembali/informasi', ['as' => 'kembali.informasi', 'uses' => 'KembaliController@informasi']);