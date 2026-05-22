<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'iPhone 15',
            'base_price' => 80000
        ]);

        Product::create([
            'name' => 'Samsung S24',
            'base_price' => 70000
        ]);

        Product::create([
            'name' => 'MacBook Air M3',
            'base_price' => 120000
        ]);
    }
}
