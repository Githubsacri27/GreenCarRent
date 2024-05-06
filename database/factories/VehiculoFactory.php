<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Vehiculo>
 * 
 * Esta Factory se utiliza para generar instancias de vehículos con datos ficticios.
 */
class VehiculoFactory extends Factory{
    /**
     * Define el estado predeterminado del modelo de vehículo.
     *
     * @return array<string, mixed> Un arreglo asociativo que contiene los valores predeterminados del modelo de vehículo.
     */
    public function definition(): array{
        return [
            'matricula' => $this->faker->unique()->bothify('##??####'), // Genera una matrícula única.
            'modelo' => $this->faker->word(), // Genera un modelo.
            'marca' => $this->faker->company(), // Genera una marca.
            'motor' => 'Eléctrico', // Define el tipo de motor como eléctrico.
            'cambio' => 'Automático', // Define el tipo de cambio como automático.
            'equipamiento' => $this->faker->numberBetween(1, 5), // Genera un número de equipamiento entre 1 y 5.
            'puertas' => $this->faker->numberBetween(4, 5), // Genera un número de puertas entre 4 y 5.
            'asientos' => $this->faker->numberBetween(2, 7), // Genera un número de asientos entre 2 y 7.
            'autonomia' => $this->faker->numberBetween(150, 600), // Genera una autonomía entre 150 y 600 km.
            'color' => $this->faker->safeColorName(), // Genera un color seguro.
            'foto' => 'storage/vehiculos/' . $this->faker->imageUrl(640, 480), // Genera una URL para la foto del vehículo.
            'descripcion' => $this->faker->paragraph(), // Genera una descripción.
            'emision' => $this->faker->dateTimeThisYear(), // Genera una fecha de emisión dentro de este año.
            'vencimiento' => $this->faker->dateTimeInInterval('now', '+1 year'), // Genera una fecha de vencimiento dentro de un año.
            'costoDiario' => $this->faker->randomFloat(2, 20, 100), // Genera un costo diario entre 20 y 100 con 2 decimales.
        ];
    }
}