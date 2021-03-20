<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\EstadoCivil;
use App\Models\Etnia;
use App\Models\NivelDeInstruccion;
use App\Models\Paciente;
use App\Models\TipoDeSangre;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;


class PacienteControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_Paciente_crud()
    {
        //se corre el seeder para poblar la base de datos tablas dependientes (revisar el seeder para mas referencia)
        $this->seed(TestingSeeder::class);

        //Es necesario crear en la base en memoria registros 
        $paciente = Paciente::factory()->makeOne()->toArray();

        //Se crean dos registros para probar obtener todos
        $paciente2 = Paciente::factory()->makeOne()->toArray();

        //Comprueba que la peticion POST a la API de ejecute correctamente
        $this->postJson('/api/v1/pacientes', $paciente)
            ->assertStatus(201)
            ->assertJson($paciente);
        $this->postJson('/api/v1/pacientes', $paciente2)
            ->assertStatus(201)
            ->assertJson($paciente2);
        //Comprueba que los registros que se insertaron se encuentren disponibles en la base de datos
        $this->assertDatabaseHas('pacientes', $paciente);
        $this->assertDatabaseHas('pacientes', $paciente2);

        //Comprueba que la peticio GET ALL a la API se ejecuto correctamente
        //Una peticion get contiene meta y data(con los registros paginados) por lo que se comprueba que contenga esta información
        $this->getJson("/api/v1/pacientes")
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('meta')
                    ->has(
                        'data',
                        2,
                        fn ($json) => //siempre trae el primer registro en la base
                        $json->where('paciente_id', 1)
                            ->where('nombres', $paciente['nombres'])
                            ->where('apellidos', $paciente['apellidos'])
                            ->etc()
                    )
            );

        //Comprueba que la peticion GET por ID a la API se ejecuto correctamente
        $this->getJson("/api/v1/pacientes/1") //solo se inserta un registro en la base por eso se utiliza la PK de la tabla con 1
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('paciente_id', 1)
                    ->where('nombres', $paciente['nombres'])
                    ->where('apellidos', $paciente['apellidos'])
                    ->etc()
            );

        //Comprubea que la peticion PUT a la API se ejecuto correctamente 
        $this->putJson('api/v1/pacientes/1', $paciente)
            ->assertStatus(200)
            ->assertJson($paciente);

        //Comprueba que la peticion DELETE a la API se ejectuo correctamente
        $this->deleteJson('api/v1/pacientes/1')
            ->assertStatus(204);
        //Comprueba que el recurso se haya borrado de la base de datos

        $this->assertDatabaseMissing('pacientes', $paciente);
    }
}
