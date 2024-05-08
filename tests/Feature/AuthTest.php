<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_admin_routes()
    {
        // Crear un usuario admin
        $adminUser = Usuario::factory()->create(['utenteable_type' => 'Admin']);

        // Autenticar al usuario admin
        $this->actingAs($adminUser);

        // Verificar acceso a una ruta de administrador
        $response = $this->get('/management/cliente/all');
        $response->assertStatus(200);
    }


    /** @test */
    public function an_empleado_can_access_empleado_routes(){
        // Crear un usuario empleado
        $empleadoUser = Usuario::factory()->create(['utenteable_type' => 'App\Models\Empleado']);

        // Autenticar al usuario empleado
        $this->actingAs($empleadoUser);

        // Verificar acceso a una ruta de empleado
        $response = $this->get('/management/vehiculo');
        $response->assertStatus(200);
    }


/** @test */
public function an_cliente_can_access_cliente_routes(){
    // Crear un usuario cliente
    $clienteUser = Usuario::factory()->create(['utenteable_type' => 'App\Models\Cliente']);

    // Autenticar al usuario cliente
    $this->actingAs($clienteUser);

    // Verificar acceso a una ruta de cliente
    $response = $this->get('/catalogo');
    $response->assertStatus(200);
}



}
