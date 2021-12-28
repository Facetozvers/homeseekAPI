<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id')->on('users');
            $table->string('id_properti')->unique();
            $table->string('nama_listing');
            $table->string('jenis_listing');
            $table->string('kota');
            $table->string('wilayah');
            $table->bigInteger('harga');
            $table->longText('desc');
            $table->integer('kamar');
            $table->integer('kamar_mandi');
            $table->integer('garasi');
            $table->integer('luas');
            $table->string('TipePenjualan');
            $table->string('statusTanah');
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
        Schema::dropIfExists('listings');
    }
}
