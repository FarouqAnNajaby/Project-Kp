<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_review', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->enum('rating', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']);
            $table->text('deskripsi');
            $table->char('uuid_barang', 36)->index('uuid_barang');
            $table->char('uuid_user', 36);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['uuid_user', 'uuid_barang'], 'uuid_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_review');
    }
}
