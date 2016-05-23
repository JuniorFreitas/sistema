<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',255);
            $table->string('url',255);
            $table->string('slug',255);
            $table->integer('usuarioCriado');
            $table->dateTime('dataCriado');
            $table->integer('usuarioAtualizado');
            $table->dateTime('dataAtualizado');
            $table->string('visto');
            $table->string('ativo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');
    }
}
