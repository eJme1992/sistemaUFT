<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id');           
            $table->string('dominio');
            $table->string('name');
            $table->string('user');
            $table->string('pass');
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbs');
    }
}
