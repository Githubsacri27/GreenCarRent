<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseMigrationTest extends TestCase{
    use RefreshDatabase;

    /** @test */
    public function all_tables_are_created(){
        // Verificar que existe todas las tablas
        $this->assertTrue(Schema::hasTable('usuario'));
        $this->assertTrue(Schema::hasTable('cliente'));
        $this->assertTrue(Schema::hasTable('empleado'));
        $this->assertTrue(Schema::hasTable('vehiculo'));
        $this->assertTrue(Schema::hasTable('alquiler'));
    }
}
