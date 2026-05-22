<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'log.request'])->group(function () {

    Route::get('/products', [ProductController::class, 'index']);

    Route::post('/stock', [StockController::class, 'store']);

    Route::get('/warehouses/{id}/report', [WarehouseController::class, 'report']);
});