<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CitaControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Cita_crud()
    {
        //se corre el seeder para poblar la base de datos tablas dependientes (revisar el seeder para mas referencia)
        $this->seed(TestingSeeder::class);
        //se crea un usuario para realizar la autenticación
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        //Es necesario crear en la base en memoria registros 
        $cita = Cita::factory()->makeOne()->toArray();

        //Se crean dos registros para probar obtener todos
        $cita2 = Cita::factory()->makeOne()->toArray();

        //Comprueba que la peticion POST a la API de ejecute correctamente
        $this->postJson('/api/v1/citas', $cita)
            ->assertStatus(201)
            ->assertJson($cita);
        $this->postJson('/api/v1/citas', $cita2)
            ->assertStatus(201)
            ->assertJson($cita2);
        //Comprueba que los registros que se insertaron se encuentren disponibles en la base de datos
        $this->assertDatabaseHas('citas', $cita);
        $this->assertDatabaseHas('citas', $cita2);

        //Comprueba que la peticio GET ALL a la API se ejecuto correctamente
        //Una peticion get contiene data(con los registros paginados) por lo que se comprueba que contenga esta información
        $this->getJson("/api/v1/citas")
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'data',
                    2,
                    fn ($json) => //siempre trae el primer registro en la base
                    $json->where('cita_id', '1')
                        ->where('paciente_id', (string)$cita['paciente_id'])
                        ->where('medico_id', (string)$cita['medico_id'])
                        ->etc()
                )
            );

        //Comprueba que la peticion GET por ID a la API se ejecuto correctamente
        $this->getJson("/api/v1/citas/1") //solo se inserta un registro en la base por eso se utiliza la PK de la tabla con 1
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('cita_id', '1')
                    ->where('paciente_id', (string)$cita['paciente_id'])
                    ->where('medico_id', (string)$cita['medico_id'])
                    ->etc()
            );

        //Comprubea que la peticion PUT a la API se ejecuto correctamente 
        $this->putJson('api/v1/citas/1', $cita)
            ->assertStatus(200)
            ->assertJson($cita);

        //Comprueba que la peticion DELETE a la API se ejectuo correctamente
        $this->deleteJson('api/v1/citas/1')
            ->assertStatus(204);
        //Comprueba que el recurso se haya borrado de la base de datos

        $this->assertDatabaseMissing('citas', $cita);
    }
}
