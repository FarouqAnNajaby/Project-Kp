<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->string('kode', 20)->unique('kode');
            $table->string('nama', 100);
            $table->smallInteger('stok');
            $table->bigInteger('harga');
            $table->text('deskripsi_singkat');
            $table->longText('deskripsi');
            $table->char('uuid_barang_kategori', 36);
            $table->char('uuid_umkm', 36)->index('uuid_umkm');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['uuid_barang_kategori', 'uuid_umkm'], 'uuid_barang_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
