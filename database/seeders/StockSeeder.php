<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::create([
            'product_id' => 1,
            'warehouse_id' => 1,
            'quantity' => 5,
            'expires_at' => Carbon::now()->addDays(5)
        ]);

        Stock::create([
            'product_id' => 2,
            'warehouse_id' => 1,
            'quantity' => 25,
            'expires_at' => Carbon::now()->addDays(15)
        ]);

        Stock::create([
            'product_id' => 3,
            'warehouse_id' => 2,
            'quantity' => 150,
            'expires_at' => Carbon::now()->addDays(30)
        ]);
    }
}
