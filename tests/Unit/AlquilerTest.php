<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\Alquiler;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlquilerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_rental(){

    $cliente = Cliente::factory()->create();
    $vehiculo = Vehiculo::factory()->create();

    $alquiler = Alquiler::factory()->create([
        'clienteID' => $cliente->id, 
        'vehiculoID' => $vehiculo->id, 
        'fechaRecogida' => now(),
        'fechaEntrega' => now()->addDays(3),
        'importe' => 100.50,
        'lugarRecogida' => 'Aeropuerto de El Prat de Llobregat',
        'horaRecogida' => '10:00',
        'lugarEntrega' => 'Aeropuerto de El Prat de Llobregat',
        'horaEntrega' => '14:00',
        'activo' => 1
    ]);

    $this->assertDatabaseHas('alquiler', [
        'clienteID' => $cliente->id, 
        'vehiculoID' => $vehiculo->id 
    ]);
}
}