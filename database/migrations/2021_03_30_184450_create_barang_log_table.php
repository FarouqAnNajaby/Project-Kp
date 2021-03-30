<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_log', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->smallInteger('stok');
            $table->bigInteger('harga');
            $table->char('uuid_barang', 36)->index('uuid_barang');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_log');
    }
}
