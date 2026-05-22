<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WarehouseController extends Controller
{

    public function report($id)
    {
        $warehouse = Warehouse::with('stock.product')->findOrFail($id);

        $products = $warehouse->stock->map(function ($stock) {

            return [
                'product' => $stock->product->name,
                'quantity' => $stock->quantity,
                'expires_at' => $stock->expires_at,
                'near_expiry' => $stock->expires_at &&
                    Carbon::parse($stock->expires_at)->lte(now()->addDays(7))
            ];
        });

        return response()->json([
            'warehouse' => $warehouse->name,
            'products' => $products,
            'total_quantity' => $warehouse->stock->sum('quantity')
        ]);
    }
}
