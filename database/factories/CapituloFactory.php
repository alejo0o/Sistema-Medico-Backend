<?php

namespace Database\Factories;

use App\Models\Capitulo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapituloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Capitulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->randomElement(array('I', 'II', 'III', 'IV', 'V', 'VI')),
            'descripcion' => $this->faker->randomElement(array(
                'Ciertas enfermedades infecciosas y parasitarias',
                'Neoplasias',
                'Enfermedades de la sangre y de los organos hematopoyeticos y otros trastornos que afectan el mecanismo de la inmunidad',
                'Enfermedades endocrinas, nutricionales y metabolicas',
                'Trastornos mentales y del comportamiento',
                'Enfermedades del sistema nervioso'
            ))
        ];
    }
}
