<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'name' => 'Kochi Warehouse',
            'latitude' => 9.9312,
            'longitude' => 76.2673
        ]);

        Warehouse::create([
            'name' => 'Bangalore Warehouse',
            'latitude' => 12.9716,
            'longitude' => 77.5946
        ]);
    }
}
