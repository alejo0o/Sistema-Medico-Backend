<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NivelesDeInstruccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles_de_instruccion', function (Blueprint $table) {
            $table->increments('nivel_de_instruccion_id')->unique();
            $table->char('nivel_de_instruccion', 25);
            //$table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveles_de_instruccion');
    }
}
