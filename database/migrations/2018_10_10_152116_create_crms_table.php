<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id'); 
            $table->integer('contacto_id'); 
            $table->integer('mail_id'); 
            $table->string('seguridad');
            $table->string('roles');
            $table->string('user');
            $table->string('pass');
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->foreign('mail_id')->references('id')->on('mails');
            $table->foreign('contacto_id')->references('id')->on('contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crms');
    }
}
