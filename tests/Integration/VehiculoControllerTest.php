<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehiculoControllerTest extends TestCase{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_create_a_vehicle()
    {
        // Crear un usuario admin
        $adminUser = Usuario::factory()->create(['utenteable_type' => 'Admin']);

        // Autenticar al usuario admin
        $this->actingAs($adminUser);

        // Enviar la solicitud para crear un vehículo
        $response = $this->post('/vehiculo', [
            'matricula' => '9912MUD',
            'modelo' => 'Model S',
            'marca' => 'Tesla',
            'motor' => 'Electrico',
            'cambio' => 'Automatico',
            'equipamiento' => 'Full',
            'puertas' => 4,
            'asientos' => 5,
            'autonomia' => 400,
            'color' => 'Red',
            'foto' => null,
            'descripcion' => 'Brand new',
            'emision' => '2024-05-08',
            'vencimiento' => '2024-05-19',
            'costoDiario' => 50
        ]);

        // Verificar la redirección y que el vehículo se haya creado en la base de datos
        $response->assertRedirect(route("vehiculo.index"));
        $this->assertDatabaseHas('vehiculo', ['matricula' => '9912MUD']);
    }
}
