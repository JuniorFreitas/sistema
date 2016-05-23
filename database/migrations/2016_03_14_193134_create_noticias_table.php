<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
            $table->string('descricao',255);
            $table->text('materia');
            $table->string('imagem',255);
            $table->string('slug',255);
            $table->integer('categoria');
            $table->dateTime('dataCriado');
            $table->integer('usuarioCriado');
            $table->dateTime('dataAtualizado');
            $table->integer('usuarioAtualizado');
            $table->dateTime('dataProgramada');
            $table->integer('visto');
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
        Schema::drop('noticias');
    }
}
