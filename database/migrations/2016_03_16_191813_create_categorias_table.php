<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria',255);
            $table->string('slugCategoria',255);
            $table->DateTime('dataCadastro');
            $table->integer('userCadastro');
            $table->DateTime('dataAtualizado');
            $table->integer('userAtualizado');
            $table->string('ativo',255);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorias');
    }
}
