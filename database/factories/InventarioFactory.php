<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(array(
                'Máquina de ECG',
                'Camas para pacientes',
                'Esterilizadores',
                'Desfibriladores',
                'Monitores de pacientes',
                'Gafa Nasal Oxigem Adultos',
                'Sonda Aspiracion Ch-8',
                'Tubo De Guedel Esteril Plastico Nº5',
                'Electrocardiógrafos',
                'Mesas quirúrgicas'
            )),
            'costo_unitario' => $this->faker->numberBetween(50, 10000),
            'cantidad' => $this->faker->numberBetween(5, 50),
        ];
    }
}
