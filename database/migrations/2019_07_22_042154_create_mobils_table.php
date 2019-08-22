<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->increments('id_mobil');
            $table->string('no_polisi', 20);
            $table->string('merk_mobil', 50);
            $table->string('jenis_mobil', 50);
            $table->bigInteger('harga');
            $table->enum('transmisi', ['Manual','Matic']);
            $table->integer('kapasitas');
            $table->integer('like');
            $table->integer('use');
            $table->enum('ketersediaan', ['1','0'])->default('1');
            $table->string('img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobils');
    }
}
