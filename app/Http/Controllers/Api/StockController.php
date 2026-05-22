<?php

namespace App\Http\Controllers\Api;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
            'expires_at' => 'nullable|date'
        ]);
        $stock = Stock::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'warehouse_id' => $request->warehouse_id,
            ],
            [
                'quantity' => $request->quantity,
                'expires_at' => $request->expires_at,
            ]
        );

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => $stock
        ]);
    }
}
