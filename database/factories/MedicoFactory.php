<?php

namespace Database\Factories;

use App\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'consultorio_id' => 1,
            'cedula' => $this->faker->unique()->numberBetween(1000, 9000),
            'nombres' =>  $this->faker->firstName('male' | 'female'),
            'apellidos' => $this->faker->lastName,
        ];
    }
}
