<?php

namespace Database\Factories;

use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TratamientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tratamiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(array(
                'Cirugía para tratar el cáncer',
                'Radioterapia para tratar el cáncer',
                'Quimioterapia para tratar el cáncer',
                'Abdominoplastia',
                'Amigdalectomia',
                'Artroscopia',
                'Asistencia mecánica para la insuficiencia cardíaca',
                'Fototerapia',
                'Prostatectomía',
                'Rinoplastia'
            )),
            'precio' => $this->faker->numberBetween(5000, 15000)
        ];
    }
}
