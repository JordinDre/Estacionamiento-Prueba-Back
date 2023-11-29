<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehiculo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'placa' => $this->faker->regexify('[A-Z]{2}-[0-9]{4}'), // Genera una placa ficticia
            'estado' => $this->faker->boolean, // Genera un valor booleano aleatorio
            'tipo_vehiculo_id' => function () {
                // Asegúrate de que tienes un factory para TipoVehiculo y que TipoVehiculo tenga registros
                return \App\Models\TipoVehiculo::inRandomOrder()->first()->id ?? null;
            },
            // 'created_at' y 'updated_at' se llenan automáticamente por Eloquent
        ];
    }
}
