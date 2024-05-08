<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;


class VehiculoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_vehicle()
    {
        $vehicle = Vehiculo::factory()->create([
            'matricula' => '1233KBC',
            'modelo' => 'Model X',
            'marca' => 'Tesla'
        ]);

        $this->assertDatabaseHas('vehiculo', [
            'matricula' => '1233KBC',
            'modelo' => 'Model X'
        ]);
    }
}