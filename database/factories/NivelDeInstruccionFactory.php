<?php

namespace Database\Factories;

use App\Models\NivelDeInstruccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class NivelDeInstruccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NivelDeInstruccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nivel_de_instruccion' => $this->faker->unique()->randomElement(array('Ninguno', 'Primaria', 'Secundaria', 'Superior', 'Otro'))
        ];
    }
}
