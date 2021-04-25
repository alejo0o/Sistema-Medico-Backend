<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiciosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'consultorio_id' => 1,
            'titulo' => $this->faker->randomElement(array('Chequeo Médico', 'Exámenes de Laboratorio', 'Oftalmología', 'Pediatría', 'Optometría', 'Ginecología')),
            'descripcion' => $this->faker->text(120),
            'imagen' => $this->faker->randomElement(array(
                'https://i.pinimg.com/736x/98/8e/6b/988e6b65ba3d060975d6038521b1a43f.jpg',
                'https://image.freepik.com/vecteurs-libre/icones-hopital-medecin-service-medical_18591-6198.jpg',
                'https://cdn.nohat.cc/thumb/f/720/b302f353f5f84b279095.jpg',
                'https://image.freepik.com/free-vector/medical-background-design_1212-116.jpg',
                'https://cdn.nohat.cc/thumb/f/720/7595c9a3cb624b0fbd2f.jpg',
                'https://cdn.nohat.cc/thumb/f/720/48d112f4b308419884c7.jpg'
            ))
        ];
    }
}
