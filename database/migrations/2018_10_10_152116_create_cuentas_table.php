<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('logo');
            $table->text('descripcion');
            $table->string('slug');
            $table->string('tipo');
            $table->string('crm');
            $table->string('industria');
            $table->string('calle');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('codigo_postal');
            $table->string('referido');
            $table->string('tema');
            $table->string('estado'); //activo eliminado
            $table->string('baja')->nullable();
            $table->string('correo');
            $table->string('telefono');
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
        Schema::dropIfExists('cuentas');
    }
}
