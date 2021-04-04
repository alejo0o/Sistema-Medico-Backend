<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoriasClinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->increments('historia_clinica_id')->unique();
            $table->integer('paciente_id')->unique()->nullable();
            $table->text('alergias');
            $table->text('antecedentes_patologicos');
            $table->text('antecedentes_quirurgicos');
            $table->text('antecedentes_familiares');
            $table->text('medicamentos_subministrados');
            $table->char('gestas', 15)->nullable();
            $table->char('partos', 15)->nullable();
            $table->char('cesareas', 15)->nullable();
            $table->char('abortos', 15)->nullable();
            $table->char('metodo_anticonceptivo', 30);
            $table->text('habitos')->nullable();
            //$table->timestamps();


            $table->foreign('paciente_id')->references('paciente_id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias_clinicas');
    }
}
