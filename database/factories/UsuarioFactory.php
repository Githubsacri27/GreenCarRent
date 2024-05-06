<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Usuario>
 * 
 * Esta Factory se utiliza para generar instancias de usuarios con datos ficticios.
 */
class UsuarioFactory extends Factory{
    /**
     * Define el estado predeterminado del modelo de usuario.
     *
     * @return array<string, mixed> Un arreglo asociativo que contiene los valores predeterminados del modelo de usuario.
     */
    public function definition(): array{
        return [
            'id' => $this->faker->unique()->numberBetween(3, 5000), // Genera un ID único para el usuario.
            'username' => $this->faker->unique()->userName(), // Genera un nombre de usuario único.
            'password' => 'Focr12345@', // Establece una contraseña predeterminada.
            'remember_token' => Str::random(10), // Genera un token de recuerdo aleatorio.
        ];
    }
}
