<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EspecialidadesMedicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidades_medicos', function (Blueprint $table) {
            $table->integer('medico_id');
            $table->integer('especialidad_id');

            //$table->timestamps();

            $table->primary(['medico_id', 'especialidad_id']);

            $table->foreign('especialidad_id')->references('especialidad_id')->on('especialidades');
            $table->foreign('medico_id')->references('medico_id')->on('medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidades_medicos');
    }
}
