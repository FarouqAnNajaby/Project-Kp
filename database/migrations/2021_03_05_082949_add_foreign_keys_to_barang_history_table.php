<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBarangHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_history', function (Blueprint $table) {
            $table->foreign('uuid_barang', 'barang_history_ibfk_1')->references('uuid')->on('barang')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_history', function (Blueprint $table) {
            $table->dropForeign('barang_history_ibfk_1');
        });
    }
}
