<?php

namespace Database\Factories;

use App\Models\TipoDeSangre;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoDeSangreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoDeSangre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_sangre' => $this->faker->unique()->randomElement(array('A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-'))
        ];
    }
}
