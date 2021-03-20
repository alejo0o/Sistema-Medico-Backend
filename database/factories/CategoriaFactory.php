<?php

namespace Database\Factories;

use App\Models\Capitulo;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'capitulo_id' => Capitulo::factory(),
            'codigo' => $this->faker->randomElement(array('A00', 'A01', 'A02', 'A03', 'A04', 'A05')),
            'descripcion' => $this->faker->randomElement(array(
                'Colera',
                'Fiebres tifoidea y paratifoidea',
                'Otras infecciones debidas a Salmonella',
                'Shigelosis',
                'Otras infecciones intestinales bacterianas',
                'Otras intoxicaciones alimentarias bacterianas, no clasificadas en otra parte'
            ))
        ];
    }
}
