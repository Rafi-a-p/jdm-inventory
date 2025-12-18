<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sparepart>
 */
class SparepartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jdmMerks = ['NISMO', 'TRD', 'HKS', 'GReddy', 'Mugen', 'Spoon Sports', 'Tein', 'Kusco', 'Brembo', 'Enkei', 'Rays', 'Yokohama', 'NGK', 'Denso'];
        $jdmParts = [
            'Oil Filter', 'Spark Plug', 'Brake Pad', 'Coilover', 'Turbocharger',
            'Intercooler', 'Air Filter', 'Exhaust Manifold', 'Strut Bar', 'Clutch Kit',
            'Radiator', 'Fuel Pump', 'Brake Rotor', 'Camshaft', 'Forged Piston'
        ];

        return [
            'kode_part' => strtoupper($this->faker->unique()->bothify('JDM-####-??')),
            'nama_barang' => $this->faker->randomElement($jdmParts),
            'merk' => $this->faker->randomElement($jdmMerks),
            'stok' => $this->faker->numberBetween(0, 50),
            'harga' => $this->faker->numberBetween(100000, 15000000),
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
            'lokasi_rak' => $this->faker->bothify('RAK-##-?'),
            'stok_minimum' => $this->faker->numberBetween(2, 10),
        ];
    }
}
