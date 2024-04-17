<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaNacimiento = $this->faker->dateTimeBetween("-70 years", "-19 years");
        return [
            'id' => $this->faker->unique()->numberBetween(3, 5000),
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'domicilio' => $this->faker->state(),
            'ocupacion' => date_diff(Carbon::now(), $fechaNacimiento)->y <= 25 ? "Estudiante" : $this->faker->randomElement(['No especificado', 'Empleado', 'Autonomo', 'Desempleado']),
            'fechaNacimiento' => $fechaNacimiento->format("Y-m-d"),
            'foto' => "storage/avatar.png",
        ];
    }
}
