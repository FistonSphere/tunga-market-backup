<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\ProductListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product_discovery_hub', [ProductListingController::class, 'index'])->name('product.discovery');