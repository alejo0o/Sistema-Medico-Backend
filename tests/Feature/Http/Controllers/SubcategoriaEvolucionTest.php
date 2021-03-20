<?php

namespace Tests\Feature;

use App\Models\SubcategoriaEvolucion;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SubcategoriaEvolucionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_SubcategoriaEvolucion_crud()
    {
        //se corre el seeder para poblar la base de datos tablas dependientes (revisar el seeder para mas referencia)
        $this->seed(TestingSeeder::class);

        //Es necesario crear en la base en memoria registros que tengan relacion con la tabla 
        $subcategoria_evolucion = SubcategoriaEvolucion::factory()->makeOne()->toArray();

        //Se crean registros para probar obtener todos
        $subcategoria_evolucion2 = SubcategoriaEvolucion::factory()->makeOne()->toArray();

        //Comprueba que la peticion POST a la API de ejecute correctamente
        $this->postJson('/api/v1/subcategoriasevoluciones', $subcategoria_evolucion)
            ->assertStatus(201)
            ->assertJson($subcategoria_evolucion);
        $this->postJson('/api/v1/subcategoriasevoluciones', $subcategoria_evolucion2)
            ->assertStatus(201)
            ->assertJson($subcategoria_evolucion2);
        //Comprueba que los registros que se insertaron se encuentren disponibles en la base de datos
        $this->assertDatabaseHas('subcategorias_evoluciones', $subcategoria_evolucion);
        $this->assertDatabaseHas('subcategorias_evoluciones', $subcategoria_evolucion2);

        //Comprueba que la peticio GET ALL a la API se ejecuto correctamente
        //Una peticion get contiene meta y data(con los registros paginados) por lo que se comprueba que contenga esta información
        $this->getJson("/api/v1/subcategoriasevoluciones")
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('meta')
                    ->has(
                        'data',
                        2,
                        fn ($json) => //siempre trae el primer registro en la base
                        $json->where('evolucion_id', 1)
                            ->where('subcategoria_id', (string)$subcategoria_evolucion['subcategoria_id'])
                            ->etc()
                    )
            );

        //Comprueba que la peticion GET por ID a la API se ejecuto correctamente
        $this->getJson("/api/v1/subcategoriasevoluciones/1") //solo se inserta un registro en la base por eso se utiliza la PK de la tabla con 1
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('evolucion_id', 1)
                    ->where('subcategoria_id', (string)$subcategoria_evolucion['subcategoria_id'])
                    ->etc()
            );

        //Comprubea que la peticion PUT a la API se ejecuto correctamente 
        $this->putJson('api/v1/subcategoriasevoluciones/1', $subcategoria_evolucion)
            ->assertStatus(200)
            ->assertJson($subcategoria_evolucion);

        //Comprueba que la peticion DELETE a la API se ejectuo correctamente
        $this->deleteJson('api/v1/subcategoriasevoluciones/1')
            ->assertStatus(204);
        //Comprueba que el recurso se haya borrado de la base de datos

        $this->assertDatabaseMissing('subcategorias_evoluciones', $subcategoria_evolucion);
    }
}
