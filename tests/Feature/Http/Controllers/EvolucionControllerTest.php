<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Evolucion;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EvolucionControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_Evolucion_crud()
    {
        //se corre el seeder para poblar la base de datos tablas dependientes (revisar el seeder para mas referencia)
        $this->seed(TestingSeeder::class);

        //Es necesario crear en la base en memoria registros que tengan relacion con la tabla 
        $evolucion = Evolucion::factory()->makeOne()->toArray();

        //Se crean registros para probar obtener todos
        $evolucion2 = Evolucion::factory()->makeOne()->toArray();

        //Comprueba que la peticion POST a la API de ejecute correctamente
        $this->postJson('/api/v1/evoluciones', $evolucion)
            ->assertStatus(201)
            ->assertJson($evolucion);
        $this->postJson('/api/v1/evoluciones', $evolucion2)
            ->assertStatus(201)
            ->assertJson($evolucion2);
        //Comprueba que los registros que se insertaron se encuentren disponibles en la base de datos
        $this->assertDatabaseHas('evoluciones', $evolucion);
        $this->assertDatabaseHas('evoluciones', $evolucion2);

        //Comprueba que la peticio GET ALL a la API se ejecuto correctamente
        //Una peticion get contiene meta y data(con los registros paginados) por lo que se comprueba que contenga esta información
        $this->getJson("/api/v1/evoluciones")
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('meta')
                    ->has(
                        'data',
                        2,
                        fn ($json) => //siempre trae el primer registro en la base
                        $json->where('evolucion_id', 1)
                            ->where('historia_clinica_id', (string) $evolucion['historia_clinica_id'])
                            ->where('fecha', $evolucion['fecha'])
                            ->etc()
                    )
            );

        //Comprueba que la peticion GET por ID a la API se ejecuto correctamente
        $this->getJson("/api/v1/evoluciones/1") //solo se inserta un registro en la base por eso se utiliza la PK de la tabla con 1
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('evolucion_id', 1)
                    ->where('historia_clinica_id', (string) $evolucion['historia_clinica_id'])
                    ->where('fecha', $evolucion['fecha'])
                    ->etc()
            );

        //Comprubea que la peticion PUT a la API se ejecuto correctamente 
        $this->putJson('api/v1/evoluciones/1', $evolucion)
            ->assertStatus(200)
            ->assertJson($evolucion);

        //Comprueba que la peticion DELETE a la API se ejectuo correctamente
        $this->deleteJson('api/v1/evoluciones/1')
            ->assertStatus(204);
        //Comprueba que el recurso se haya borrado de la base de datos

        $this->assertDatabaseMissing('evoluciones', $evolucion);
    }
}
