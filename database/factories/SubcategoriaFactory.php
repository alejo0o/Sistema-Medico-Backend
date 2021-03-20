<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoria_id' => Categoria::factory(),
            'codigo' => $this->faker->randomElement(array('A00', 'A000', 'A001', 'A009', 'A01', 'A010')),
            'descripcion' => $this->faker->randomElement(array(
                'Colera',
                'Colera debido a Vibrio cholerae 01, biotipo cholerae',
                'Colera debido a Vibrio cholerae 01, biotipo el Tor',
                'Colera, no especificado',
                'Fiebres tifoidea y paratifoidea',
                'Fiebre tifoidea'
            ))
        ];
    }
}
