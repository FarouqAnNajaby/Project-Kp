<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->foreign('uuid_barang_kategori', 'barang_ibfk_1')->references('uuid')->on('barang_kategori')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('uuid_umkm', 'barang_ibfk_2')->references('uuid')->on('umkm')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropForeign('barang_ibfk_1');
            $table->dropForeign('barang_ibfk_2');
        });
    }
}
