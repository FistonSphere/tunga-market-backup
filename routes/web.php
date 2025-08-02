<?php

use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\frontend\CareerController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ComparedController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HelpCenterController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductListingController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product-discovery-hub', [ProductListingController::class, 'index'])->name('product.discovery');
Route::get('/product-view', [ProductListingController::class, 'showProduct'])->name('product.view');
Route::get('/authentication', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/product-compare-center', [ComparedController::class, 'index'])->name('compare');
Route::get('/help-center', [HelpCenterController::class, 'index'])->name('help.center');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/shopping-cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout-process', [CheckoutController::class, 'index'])->name('checkout');


// Start Authentication routes
Route::post('/register-user', [AuthController::class, 'register'])->name('register-user');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp');




// End Authentication routes
