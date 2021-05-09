<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Citas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('cita_id')->unique();
            $table->integer('paciente_id');
            $table->integer('medico_id');
            $table->timestamp('fecha');
            $table->time('hora');
            $table->text('motivo_cita')->nullable();

            //$table->timestamps();


            $table->foreign('paciente_id')->references('paciente_id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medico_id')->references('medico_id')->on('medicos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
