<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Medicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('medico_id')->unique();
            $table->integer('consultorio_id')->nullable();
            $table->char('cedula', 15);
            $table->char('nombres', 60);
            $table->char('apellidos', 60);
            $table->char('telefono', 25);
            $table->char('email', 100);
            $table->json('especialidades');
            //$table->timestamps();


            $table->foreign('consultorio_id')->references('consultorio_id')->on('consultorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}
