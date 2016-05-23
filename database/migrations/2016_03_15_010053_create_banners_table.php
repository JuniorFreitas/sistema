<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',255);
            $table->string('imagem',255);
            $table->integer('posicao');
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
        Schema::drop('banners');
    }
}
