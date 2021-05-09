<?php

namespace Database\Factories;

use App\Models\Consultorio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultorioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Consultorio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' =>  $this->faker->company,
            'descripcion' => $this->faker->text(150),
            'vision' => $this->faker->text(150),
            'mision' => $this->faker->text(150),
            'ruc' => $this->faker->unique()->numberBetween(1000, 9000),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'logo' => 'https://i.ibb.co/C2v0LPB/company.png',
            'correo' => 'avivanco368@puce.edu.ec',
            'red_social1' => 'https://www.facebook.com',
            'red_social2' => 'https://www.instagram.com'
        ];
    }
}
