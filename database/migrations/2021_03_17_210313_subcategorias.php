<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subcategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->increments('subcategoria_id')->unique();
            $table->integer('categoria_id')->nullable();
            $table->char('codigo', 5);
            $table->char('descripcion', 256);
            //$table->timestamps();


            $table->foreign('categoria_id')->references('categoria_id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategorias');
    }
}
