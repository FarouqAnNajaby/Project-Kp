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
		Schema::create('tb_barang', function (Blueprint $table) {
			$table->char('uuid', 36)->primary();
			$table->string('nama', 255);
			$table->smallInteger('stok_awal');
			$table->smallInteger('stok_sekarang');
			$table->bigInteger('harga')->default(0);
			$table->char('uuid_umkm', 36);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tb_barang');
	}
}
