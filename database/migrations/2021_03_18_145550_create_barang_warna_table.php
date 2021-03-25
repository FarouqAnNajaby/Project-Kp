<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangWarnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_warna', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->char('uuid_warna', 36);
            $table->char('uuid_barang', 36)->index('uuid_barang');
            $table->index(['uuid_warna', 'uuid_barang'], 'uuid_warna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_warna');
    }
}
