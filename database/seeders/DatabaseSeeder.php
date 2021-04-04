<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*-------Descomentar para generar las tablas independientes de etnias, estado civil, nivel de instruccion y tipo de sangre-----*/
        //\App\Models\Etnia::factory(6)->create();
        //\App\Models\NivelDeInstruccion::factory(5)->create();
        //\App\Models\TipoDeSangre::factory(8)->create();
        //\App\Models\EstadoCivil::factory(5)->create();
        //\App\Models\Genero::factory(2)->create();
        //\App\Models\Subcategoria::factory(1)->create();
        /*---------------------------------------------------------------------------------------------------------------------------*/

        /*-------------GENERA TANTO PACIENTES COMO HISTORIAS COMO EVOLUCIONES CON SUS RESPECTIVAS ENFERMEDADES ASOCIADAS (RECOMENDADO)---------*/
        \App\Models\Evolucion::factory(100)->create();
        /*---------------------------------------------------------------------------------------------------------------------------*/


        //\App\Models\Evolucion::factory(2)->create();
    }
}
