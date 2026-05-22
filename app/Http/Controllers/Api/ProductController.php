<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\DynamicPricingService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(DynamicPricingService $pricingService)
    {
        $products = Product::with('stock')->get();

        $data = $products->map(function ($product) use ($pricingService) {

            return [
                'id' => $product->id,
                'name' => $product->name,
                'base_price' => $product->base_price,
                'dynamic_price' => $pricingService->calculate($product),
                'total_stock' => $product->stock->sum('quantity')
            ];
        });

        return response()->json($data);
    }
}
