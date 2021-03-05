<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBarangFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_foto', function (Blueprint $table) {
            $table->foreign('uuid_barang', 'barang_foto_ibfk_1')->references('uuid')->on('barang')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_foto', function (Blueprint $table) {
            $table->dropForeign('barang_foto_ibfk_1');
        });
    }
}
