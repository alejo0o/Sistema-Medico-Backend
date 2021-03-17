<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evoluciones', function (Blueprint $table) {
            $table->increments('evolucion_id')->unique();
            $table->integer('historia_clinica_id')->nullable();
            $table->date('fecha');
            $table->text('motivo_consulta');
            $table->date('fecha_ultima_menstruacion')->nullable();
            $table->text('procedimiento');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->date('proximo_control')->nullable();
            //$table->timestamps();


            $table->foreign('historia_clinica_id')->references('historia_clinica_id')->on('historias_clinicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evoluciones');
    }
}
