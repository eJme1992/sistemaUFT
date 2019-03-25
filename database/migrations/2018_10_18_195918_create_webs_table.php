<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('host_id');
            $table->integer('db_id');
            $table->string('tipo');
            $table->string('tipo_p');
            $table->string('pago')->nullable();;
            $table->string('url');
            $table->string('url_admin');
            $table->string('user');
            $table->string('pass');
            $table->timestamps();

        
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->foreign('db_id')->references('id')->on('dbs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webs');
    }
}
