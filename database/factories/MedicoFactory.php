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
            'telefono' => $this->faker->numberBetween(10000, 90000),
            'email' => $this->faker->unique()->safeEmail,
            'especialidades' => $this->faker->randomElement(array(
                '{"1":"Alergología","3":"Anatomía patológica","4":"Anestesiología"}',
                '{"7":"Cardiología","2":"Análisis clínico"}',
                '{"6":"Bioquímica clínica"}',
                '{"1":"Alergología","5":"Angiología"}',
                '{"7":"Cardiología","8":"Cirugía cardíaca","12":"Cirugía pediátrica"}'
            )),
        ];
    }
}
