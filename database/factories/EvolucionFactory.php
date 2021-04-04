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
            'diagnostico' => $this->faker->randomElement(array(
                '[{"codigo":"A099","descripcion":"Gastroenteritis y colitis de origen no especificado"},{"codigo":"A051","descripcion":"Botulismo"},{"codigo":"A083","descripcion":"Otras enteritis virales"}]',
                '[{"codigo":"A070","descripcion":"Balantidiasis"},{"codigo":"A073","descripcion":"Isosporiasis"},{"codigo":"A083","descripcion":"Otras enteritis virales"}]',
                '[{"codigo":"A051","descripcion":"Botulismo"},{"codigo":"A06","descripcion":"Amebiasis"},{"codigo":"A067","descripcion":"Amebiasis cutánea"}]',
                '[{"codigo":"A020","descripcion":"Enteritis debida a Salmonella"},{"codigo":"A03","descripcion":"Shigelosis"},{"codigo":"A031","descripcion":"Shigelosis debida a Shigella flexneri"}]',
                '[{"codigo":"A00","descripcion":"Cólera"},{"codigo":"A009","descripcion":"Cólera, no especificado"},{"codigo":"A010","descripcion":"Fiebre tifoidea"}]'
            )),
            'tratamiento' => $this->faker->text(150),
            'proximo_control' => $this->faker->randomElement(array($this->faker->date('Y/m/d', 'now'), null)),
        ];
    }
}
