<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBarangWarnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_warna', function (Blueprint $table) {
            $table->foreign('uuid_barang', 'barang_warna_ibfk_1')->references('uuid')->on('barang')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('uuid_warna', 'barang_warna_ibfk_2')->references('uuid')->on('warna')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_warna', function (Blueprint $table) {
            $table->dropForeign('barang_warna_ibfk_1');
            $table->dropForeign('barang_warna_ibfk_2');
        });
    }
}
