<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubcategoriasEvoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategorias_evoluciones', function (Blueprint $table) {
            $table->integer('evolucion_id');
            $table->integer('subcategoria_id');

            //$table->timestamps();

            $table->primary(['evolucion_id', 'subcategoria_id']);
            $table->foreign('evolucion_id')->references('evolucion_id')->on('evoluciones');
            $table->foreign('subcategoria_id')->references('subcategoria_id')->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategorias_evoluciones');
    }
}
