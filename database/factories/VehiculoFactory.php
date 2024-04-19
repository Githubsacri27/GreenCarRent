<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => $this->faker->unique()->bothify('##??####'),
            'modelo' => $this->faker->word(),
            'marca' => $this->faker->company(),
            'motor' => 'Eléctrico',
            'cambio' => 'Automático',
            'equipamiento' => $this->faker->numberBetween(1, 5),
            'puertas' => $this->faker->numberBetween(2, 5),
            'asientos' => $this->faker->numberBetween(2, 7),
            'autonomia' => $this->faker->numberBetween(150, 600),
            'color' => $this->faker->safeColorName(),
            'foto' => 'storage/vehiculos/' . $this->faker->imageUrl(640, 480),
            'descripcion' => $this->faker->paragraph(),
            'emision' => $this->faker->dateTimeThisYear(),
            'vencimiento' => $this->faker->dateTimeInInterval('now', '+1 year'),
            'costoDiario' => $this->faker->randomFloat(2, 20, 100),
        ];
    }
}
