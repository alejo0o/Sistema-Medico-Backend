<?php

namespace Database\Factories;

use App\Models\Paciente;
use App\Models\TipoDeSangre;
use App\Models\EstadoCivil;
use App\Models\NivelDeInstruccion;
use App\Models\Etnia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_de_sangre_id' => $this->faker->randomElement(array(1, 2, 3, 4, 5, 6, 7, 8)),
            'etnia_id' =>  $this->faker->randomElement(array(1, 2, 3, 4, 5, 6)),
            'nivel_de_instruccion_id' => $this->faker->randomElement(array(1, 2, 3, 4, 5)),
            'estado_civil_id' => $this->faker->randomElement(array(1, 2, 3, 4, 5)),
            'genero_id' => $this->faker->randomElement(array(1, 2)),
            'nombres' => $this->faker->firstName('male' | 'female'),
            'apellidos' => $this->faker->lastName,
            'cedula' => $this->faker->unique()->numberBetween(1000, 9000),
            'fechanacimiento' => $this->faker->date('Y/m/d', 'now'),
            'lugarnacimiento' => $this->faker->country,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->numberBetween(10000, 90000),
            'ocupacion' => $this->faker->randomElement(array('Abogado/a', 'Doctor/a', 'Sin Ocupación', 'Ingeniero/a', 'Administrador/a de empresas', 'Vendedor/a', 'Costurero/a')),
            'numero_hijos' => $this->faker->numberBetween(1, 10),
            'contacto_emergencia_nombre' =>  $this->faker->randomElement(array($this->faker->firstName('male' | 'female'), null)),
            'contacto_emergencia_telefono' => $this->faker->randomElement(array($this->faker->numberBetween(10000, 90000), null))
        ];
    }
}
