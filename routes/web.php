<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product-discovery-hub', [ProductListingController::class, 'index'])->name('product.discovery');
Route::get('/authentication', [AuthController::class, 'showLoginForm'])->name('login');