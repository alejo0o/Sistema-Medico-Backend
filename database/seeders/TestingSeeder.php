<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Etnia::factory(6)->create();
        \App\Models\NivelDeInstruccion::factory(5)->create();
        \App\Models\TipoDeSangre::factory(8)->create();
        \App\Models\EstadoCivil::factory(5)->create();
        \App\Models\Genero::factory(2)->create();
        \App\Models\Subcategoria::factory(6)->create();
        \App\Models\Consultorio::factory(1)->create();
    }
}
