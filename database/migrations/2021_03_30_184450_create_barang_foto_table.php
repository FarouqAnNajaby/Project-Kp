<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_foto', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->string('file', 100);
            $table->boolean('is_highlight')->default(0);
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
        Schema::dropIfExists('barang_foto');
    }
}
