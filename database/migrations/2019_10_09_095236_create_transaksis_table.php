<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_transaksi');
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('buku_id');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status',['pinjam','kembali']);
            $table->integer('jumlah_buku_dipinjam');
            $table->text('ket')->nullable();
            $table->timestamps();
        });

        Schema::table('transaksis', function($table) {
            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
