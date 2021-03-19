<?php

namespace Database\Factories;

use App\Models\EstadoCivil;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoCivilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstadoCivil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estado_civil' => $this->faker->unique()->randomElement(array('Casado/a', 'Divorciado/a', 'Soltero/a', 'Unión de hecho', 'Viudo/a'))
        ];
    }
}
