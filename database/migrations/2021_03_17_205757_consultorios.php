<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consultorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->increments('consultorio_id')->unique();
            $table->char('nombre', 60);
            $table->text('descripcion');
            $table->text('vision')->nullable();
            $table->text('mision')->nullable();
            $table->char('ruc', 15);
            $table->char('direccion', 100);
            $table->char('telefono', 15);
            $table->char('logo', 250);
            $table->char('correo', 100)->nullable();
            $table->char('red_social1', 100)->nullable();
            $table->char('red_social2', 100)->nullable();
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
        Schema::dropIfExists('consultorios');
    }
}
