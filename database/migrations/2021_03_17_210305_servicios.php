<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('servicio_id')->unique();
            $table->integer('consultorio_id')->nullable();
            $table->char('titulo', 80);
            $table->char('imagen', 150);
            $table->text('descripcion');
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
        Schema::dropIfExists('servicios');
    }
}
