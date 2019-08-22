<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->increments('id_pinjam');
            $table->string('kode_pinjam');
            $table->date('tgl_mulai');
            $table->integer('lama_pinjam');
            $table->date('tgl_selesai');
            $table->date('tgl_kembali')->nullable();
            $table->integer('jumlah_bayar');
            $table->integer('denda')->nullable();
            $table->enum('status', ['proses', 'telat', 'selesai', 'batal']);
            $table->integer('id_mobil');
            $table->integer('id_pelanggan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjams');
    }
}
