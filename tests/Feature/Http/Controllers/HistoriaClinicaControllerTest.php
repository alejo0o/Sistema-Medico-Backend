<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Etnia;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class HistoriaClinicaControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_HistoriaClinica_crud()
    {
        //se corre el seeder para poblar la base de datos tablas dependientes (revisar el seeder para mas referencia)
        $this->seed(TestingSeeder::class);

        //Es necesario crear en la base en memoria registros que tengan relacion con la tabla 
        $historia_clinica = HistoriaClinica::factory()->makeOne()->toArray();

        //Se crean dos registros para probar obtener todos
        $historia_clinica2 = HistoriaClinica::factory()->makeOne()->toArray();

        //Comprueba que la peticion POST a la API de ejecute correctamente
        $this->postJson('/api/v1/historiasclinicas', $historia_clinica)
            ->assertStatus(201)
            ->assertJson($historia_clinica);
        $this->postJson('/api/v1/historiasclinicas', $historia_clinica2)
            ->assertStatus(201)
            ->assertJson($historia_clinica2);
        //Comprueba que los registros que se insertaron se encuentren disponibles en la base de datos
        $this->assertDatabaseHas('historias_clinicas', $historia_clinica);
        $this->assertDatabaseHas('historias_clinicas', $historia_clinica2);

        //Comprueba que la peticio GET ALL a la API se ejecuto correctamente
        //Una peticion get contiene meta y data(con los registros paginados) por lo que se comprueba que contenga esta información
        $this->getJson("/api/v1/historiasclinicas")
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('meta')
                    ->has(
                        'data',
                        2,
                        fn ($json) => //siempre trae el primer registro en la base
                        $json->where('historia_clinica_id', 1)
                            ->where('paciente_id', (string) $historia_clinica['paciente_id'])
                            ->where('alergias', $historia_clinica['alergias'])
                            ->etc()
                    )
            );

        //Comprueba que la peticion GET por ID a la API se ejecuto correctamente
        $this->getJson("/api/v1/historiasclinicas/1") //solo se inserta un registro en la base por eso se utiliza la PK de la tabla con 1
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('historia_clinica_id', 1)
                    ->where('paciente_id', (string) $historia_clinica['paciente_id'])
                    ->where('alergias', $historia_clinica['alergias'])
                    ->etc()
            );

        //Comprubea que la peticion PUT a la API se ejecuto correctamente 
        $this->putJson('api/v1/historiasclinicas/1', $historia_clinica)
            ->assertStatus(200)
            ->assertJson($historia_clinica);

        //Comprueba que la peticion DELETE a la API se ejectuo correctamente
        $this->deleteJson('api/v1/historiasclinicas/1')
            ->assertStatus(204);
        //Comprueba que el recurso se haya borrado de la base de datos

        $this->assertDatabaseMissing('historias_clinicas', $historia_clinica);
    }
}
