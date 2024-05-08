<?php

namespace Database\Factories;

use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * El nombre del modelo que la fábrica crea.
     *
     * @var string
     */
    protected $model = Vehiculo::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'matricula' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'modelo' => $this->faker->word,
            'marca' => $this->faker->company,
            'motor' => 'Electrico',
            'cambio' => 'Automatico',
            'equipamiento' => $this->faker->word,
            'puertas' => $this->faker->numberBetween(2, 5),
            'asientos' => $this->faker->numberBetween(2, 7),
            'autonomia' => $this->faker->numberBetween(100, 500),
            'color' => $this->faker->safeColorName,
            'foto' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->paragraph,
            'emision' => $this->faker->date(),
            'vencimiento' => $this->faker->date(),
            'costoDiario' => $this->faker->randomFloat(2, 50, 500)
        ];
    }
}
