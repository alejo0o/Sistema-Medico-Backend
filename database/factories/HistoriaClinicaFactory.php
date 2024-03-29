<?php

namespace Database\Factories;

use App\Models\HistoriaClinica;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoriaClinicaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistoriaClinica::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paciente_id' => Paciente::factory(),
            'alergias' => $this->faker->randomElement(array('Alergia al polen', 'Alergia a los acaros', 'Alergia a los alimentos', 'Alergia a la caspa de los animales', 'Alergia al latex', 'Rinitis alergica', 'Urticaria cronica', 'Ninguna')),
            'antecedentes_patologicos' =>  $this->faker->randomElement(array('Hipertiroidismo', 'Hemorragia digestiva', 'Diverticulo de Meckel', 'Tumores neuroendocrinos', 'Linfedema', 'Hidrocefalia', 'Ninguno')),
            'antecedentes_quirurgicos' => $this->faker->randomElement(array('Cancer', 'Disfagia oro-faríngea', 'Esofago de Barrett', 'Hernias de hiato', 'Reconstrucciones complejas del esofago', 'Ninguno')),
            'antecedentes_familiares' =>  $this->faker->randomElement(array('Diabetes', 'Hipertensión', 'Asma', 'Miopia', 'Daltonismo', 'Fibrosis quistica', 'Anemia falciforme', 'Ninguno')),
            'medicamentos_subministrados' => $this->faker->randomElement(array('Cannabidiol', 'Simvastatina', 'Aspirina', 'Omeprazol', 'Rosiglitazona', 'Lexotiroxina sodica', 'Ramipril', 'Amlodipina', 'Paracetamol', 'Ninguno')),
            'gestas' => $this->faker->numberBetween(0, 10),
            'partos' => $this->faker->numberBetween(0, 10),
            'cesareas' => $this->faker->numberBetween(0, 5),
            'abortos' => $this->faker->numberBetween(0, 5),
            'metodo_anticonceptivo' => $this->faker->randomElement(array('Preservativo', 'Dispositivo Intrauterino (DIU)', 'Pastillas', 'Ligadura Tubaria', 'Vasectomía', 'Implante subdérmico', 'Ninguno')),
            'habitos' => $this->faker->randomElement(array('Ejercicio', 'Mal comer', 'Mala postura', 'Fumar', 'Ingerir alchool', 'Mal cuidado dental', 'No desayunar', 'Dormir Poco', 'Ninguno', null)),
        ];
    }
}
