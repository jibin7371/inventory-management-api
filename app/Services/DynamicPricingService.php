<?php
namespace App\Services;

use Carbon\Carbon;

class DynamicPricingService
{
    public function calculate($product)
    {
        $basePrice = $product->base_price;

        $totalStock = $product->stock->sum('quantity');

        $price = $basePrice;

        // stock based pricing
        if ($totalStock < 10) {
            $price += ($basePrice * 0.30);
        } elseif ($totalStock >= 10 && $totalStock <= 50) {
            $price += ($basePrice * 0.10);
        } elseif ($totalStock > 100) {
            $price -= ($basePrice * 0.20);
        }

        // near expiry
        $nearExpiry = $product->stock
            ->where('expires_at', '<=', Carbon::now()->addDays(7));

        if ($nearExpiry->count()) {
            $price -= ($basePrice * 0.25);
        }

        return round($price, 2);
    }
}