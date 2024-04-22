<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Vehiculo;
use App\Models\Alquiler;
use App\Models\Cliente;

class EloquentRelationshipsTest extends TestCase
{
    /**
     * Verifica que un vehículo puede tener múltiples alquileres.
     * Crea un vehículo y dos alquileres asociados a él.
     * Luego, verifica que el vehículo contiene ambos alquileres
     * y que el número total de alquileres asociados al vehículo es 2.
     */
    
    use DatabaseTransactions;

    /** @Test */
    public function a_vehicle_can_have_many_rentals()
    {
        $vehicle = Vehiculo::factory()->create();

        $alquiler1 = Alquiler::factory()->create(['vehiculoID' => $vehicle->id]);
        $alquiler2 = Alquiler::factory()->create(['vehiculoID' => $vehicle->id]);

        $this->assertTrue($vehicle->alquiler->contains($alquiler1));
        $this->assertTrue($vehicle->alquiler->contains($alquiler2));
        $this->assertEquals(2, $vehicle->alquiler->count());
    }

    /** @Test */
    public function a_rental_belongs_to_a_vehicle()
    {
        $vehicle = Vehiculo::factory()->create();

        $alquiler = Alquiler::factory()->create(['vehiculoID' => $vehicle->id]);

        $this->assertTrue($alquiler->vehiculo->is($vehicle));
    }

    /** @Test */
    public function a_rental_belongs_to_a_client()
    {
        $client = Cliente::factory()->create();

        $alquiler = Alquiler::factory()->create(['clienteID' => $client->id]);

        $this->assertTrue($alquiler->cliente->is($client));
    }
}
