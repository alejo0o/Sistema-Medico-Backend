<?php

namespace Database\Factories;

use App\Models\Etnia;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtniaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etnia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'etnia' => $this->faker->unique()->randomElement(array('Afroecuatoriano/a', 'Blanco/a', 'Indígena', 'Mestizo/a', 'Montubio/a', 'Otro/a'))
        ];
    }
}
