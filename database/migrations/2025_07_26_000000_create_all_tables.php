<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->bigIncrements('id_level');
            $table->string('nama_level');
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama_admin');
            $table->unsignedBigInteger('id_level');
            $table->foreign('id_level')->references('id_level')->on('level')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tarif', function (Blueprint $table) {
            $table->bigIncrements('id_tarif');
            $table->string('daya');
            $table->decimal('tarifperkwh', 10, 2);
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nomor_kwh');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->unsignedBigInteger('id_tarif');
            $table->foreign('id_tarif')->references('id_tarif')->on('tarif')->onDelete('cascade');
            $table->primary('id_pelanggan');
            $table->timestamps();
        });

        Schema::create('penggunaan', function (Blueprint $table) {
            $table->bigIncrements('id_penggunaan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('bulan');
            $table->year('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_ahir');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tagihan', function (Blueprint $table) {
            $table->bigIncrements('id_tagihan');
            $table->unsignedBigInteger('id_penggunaan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('bulan');
            $table->year('tahun');
            $table->integer('jumlah_meter');
            $table->string('status');
            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaan')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('id_tagihan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->date('tanggal_pembayaran');
            $table->string('bulan_bayar');
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_bayar', 10, 2);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('tagihan');
        Schema::dropIfExists('penggunaan');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('tarif');
        Schema::dropIfExists('user');
        Schema::dropIfExists('level');
    }
}
