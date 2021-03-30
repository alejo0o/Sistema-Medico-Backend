<?php

namespace Database\Factories;

use App\Models\Evolucion;
use App\Models\HistoriaClinica;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvolucionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evolucion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'historia_clinica_id' => HistoriaClinica::factory(),
            'fecha' => $this->faker->date('Y/m/d', 'now'),
            'motivo_consulta' => $this->faker->text(150),
            'fecha_ultima_menstruacion' => $this->faker->randomElement(array($this->faker->date('Y/m/d', 'now'), null)),
            'procedimiento' => $this->faker->text(150),
            'tratamiento' => $this->faker->text(150),
            'proximo_control' => $this->faker->randomElement(array($this->faker->date('Y/m/d', 'now'), null)),
        ];
    }
}
