<?php

namespace Database\Factories;

use App\Models\Evolucion;
use App\Models\SubcategoriaEvolucion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoriaEvolucionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubcategoriaEvolucion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'evolucion_id' => Evolucion::factory(),
            'subcategoria_id' => $this->faker->numberBetween(1, 14418),
        ];
    }
}
