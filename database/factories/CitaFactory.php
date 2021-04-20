<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paciente_id' => Paciente::factory(),
            'medico_id' => Medico::factory(),
            'fecha' =>  $this->faker->iso8601('now'),
            'hora' => $this->faker->time('H:i:s', 'now'),
            'motivo_cita' =>  $this->faker->randomElement(array('Dolor abdominal', 'Jaqueca aguda', 'Problemas de colón', 'Problemas respiratorios', 'Posible rotura de brazo', 'Presión alta', 'Dolor agudo en espalda', 'sin especificar')),

        ];
    }
}
