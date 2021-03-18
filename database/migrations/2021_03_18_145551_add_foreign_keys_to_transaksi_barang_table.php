<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTransaksiBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_barang', function (Blueprint $table) {
            $table->foreign('uuid_barang', 'transaksi_barang_ibfk_1')->references('uuid')->on('barang')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('uuid_transaksi', 'transaksi_barang_ibfk_2')->references('uuid')->on('transaksi')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_barang', function (Blueprint $table) {
            $table->dropForeign('transaksi_barang_ibfk_1');
            $table->dropForeign('transaksi_barang_ibfk_2');
        });
    }
}
