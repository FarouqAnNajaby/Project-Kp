<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_barang', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->smallInteger('jumlah');
            $table->bigInteger('harga');
            $table->char('uuid_barang', 36)->index('uuid_barang');
            $table->char('uuid_transaksi', 36);
            $table->timestamp('created_at')->nullable();
            $table->index(['uuid_transaksi', 'uuid_barang'], 'uuid_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_barang');
    }
}
