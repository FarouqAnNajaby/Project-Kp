<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('nama_pemilik');
            $table->string('email', 320);
            $table->string('nomor_telp', 20);
            $table->string('logo', 100)->nullable();
            $table->char('uuid_umkm_kategori', 36)->index('uuid_umkm_kategori');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umkm');
    }
}
