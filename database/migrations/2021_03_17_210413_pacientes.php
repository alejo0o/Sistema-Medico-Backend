<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('paciente_id')->unique();
            $table->integer('tipo_de_sangre_id')->nullable();
            $table->integer('etnia_id')->nullable();
            $table->integer('nivel_de_instruccion_id')->nullable();
            $table->integer('estado_civil_id')->nullable();
            $table->char('nombres', 60);
            $table->char('apellidos', 60);
            $table->char('cedula', 15)->unique();
            $table->date('fechanacimiento');
            $table->char('lugarnacimiento', 50);
            $table->char('direccion', 50);
            $table->char('telefono', 15);
            $table->char('ocupacion', 100);
            $table->integer('numero_hijos');
            $table->char('contacto_emergencia_nombre', 100)->nullable();
            $table->char('contacto_emergencia_telefono', 15)->nullable();
            //$table->timestamps();


            $table->foreign('tipo_de_sangre_id')->references('tipo_de_sangre_id')->on('tipos_de_sangre');
            $table->foreign('etnia_id')->references('etnia_id')->on('etnias');
            $table->foreign('nivel_de_instruccion_id')->references('nivel_de_instruccion_id')->on('niveles_de_instruccion');
            $table->foreign('estado_civil_id')->references('estado_civil_id')->on('estados_civiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}