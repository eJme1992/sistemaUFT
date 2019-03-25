<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id');
            $table->integer('contacto_id');           
            $table->string('mail');
            $table->string('user');
            $table->string('pass');
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->foreign('contacto_id')->references('id')->on('contacto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
