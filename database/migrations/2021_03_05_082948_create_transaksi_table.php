<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->enum('jenis', ['offline', 'online'])->default('online');
            $table->enum('status', ['pending', 'selesai']);
            $table->text('alamat');
            $table->bigInteger('total');
            $table->char('uuid_user', 36)->index('uuid_user');
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
        Schema::dropIfExists('transaksi');
    }
}
