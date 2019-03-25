<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('sitio_web');
            $table->string('email');
            $table->string('usuario');
            $table->string('clave');
            $table->string('tipo');
            $table->string('modalidad');
            $table->string('pago');
            $table->string('observaciones');
            $table->string('fecha_suscripcion');
            $table->string('fecha_renovacion')->nullable();
            $table->string('estado');
            $table->string('fecha_de_cancelacion')->nullable();
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
        Schema::dropIfExists('software');
    }
}
