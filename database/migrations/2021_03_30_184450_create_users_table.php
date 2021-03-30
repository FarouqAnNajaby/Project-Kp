<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->string('nama');
            $table->string('email', 320)->unique();
            $table->string('nomor_telepon', 20)->nullable();
            $table->enum('jenis_kelamin', ['laki_laki', 'perempuan'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
