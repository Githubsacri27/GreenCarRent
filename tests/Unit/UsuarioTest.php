<?php

namespace Tests\Unit;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UsuarioTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_create_and_save_a_usuario()
    {
        // Crear un usuario y guardarlo en la base de datos
        $usuario = Usuario::factory()->create([
            'username' => 'usuariotest',
            'password' => Hash::make('test'), 
            'utenteable_id' => 999, 
            'utenteable_type' => 'Empleado', 
        ]);

        // Verificar que el usuario se haya creado en la base de datos
        $this->assertDatabaseHas('usuario', ['username' => 'usuariotest']);
    }
}