<?php

use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\frontend\CareerController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ComparedController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HelpCenterController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OrderTrackingController;
use App\Http\Controllers\frontend\ProductListingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\WishlistController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product-discovery-hub', [ProductListingController::class, 'index'])->name('product.discovery');
Route::get('/product-view/{sku}', [ProductListingController::class, 'showProduct'])->name('product.view');
Route::get('/category/{slug}', [CategoryController::class, 'view'])
    ->name('category.view');
Route::get('/categories-with-count', [ProductListingController::class, 'getCategoriesWithProductCount']);
Route::get('/products/filter', [ProductListingController::class, 'filterProducts'])->name('products.filter');
Route::get('/products/filter-by-price', [ProductListingController::class, 'filterByPrice'])->name('products.filterByPrice');
Route::get('/products/min-max-price', function () {
    return response()->json([
        'min' => Product::min('price'),
        'max' => Product::max('price')
    ]);
});
Route::post('/enquiries/store', [ContactController::class, 'storeEnquiry'])->name('enquiries.store');


Route::get('/products/sort', [ProductListingController::class, 'sortProducts']);
Route::get('/products/brand/filter', [ProductListingController::class, 'brandFilter'])->name('products.filter');
Route::get('/brands/list', [ProductListingController::class, 'brandList'])->name('brands.list');
Route::get('/trending-suggestions', [ProductListingController::class, 'getTrendingSuggestions']);
Route::get('/products/price-range', [ProductListingController::class, 'getPriceRange']);
Route::get('/products/search', [ProductListingController::class, 'search'])->name('products.search');
Route::get('/products/main-filter', [ProductListingController::class, 'filter']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);


Route::get('/compare', [ProductListingController::class, 'compare'])->name('products.compare');
Route::get('/authentication', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/product-compare-center', [ComparedController::class, 'index'])->name('compare');
Route::get('/help-center', [HelpCenterController::class, 'index'])->name('help.center');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/shopping-cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout-process', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/shipping', [CheckoutController::class, 'storeShipping'])->name('checkout.shipping');
Route::post('/checkout/payment', [CheckoutController::class, 'storePayment'])->name('checkout.payment');
Route::post('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
Route::get('/order-tracking', [OrderTrackingController::class, 'index'])->name('order.tracking');
Route::post('/shipping-address/store', [CheckoutController::class, 'store'])->name('shipping-address.store');
Route::get('/shipping-addresses/{id}/edit', [CheckoutController::class, 'editShippingAddress'])->name('shipping-address.edit');
Route::put('/shipping-address/update/{id}', [CheckoutController::class, 'updateShippingAddress'])->name('shipping-address.update');
Route::get('/products/{product}/reviews', [ReviewController::class, 'fetchFiltered'])
    ->name('reviews.fetch');

// Start Authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/login', [AuthController::class, 'login'])->name('login-user');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/user/update-profile', [AuthController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/user/change-password', [AuthController::class, 'changePassword'])->name('user.change.password');
    Route::post('/profile/update', [AuthController::class, 'update'])->name('user.profile.update');
    Route::post('/profile/update-password', [AuthController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');
    Route::get('/wishlist', [WishlistController::class, 'getWishlist'])->name('wishlist.get');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
    Route::delete('/wishlist-clear', [WishlistController::class, 'clearAll'])->name('wishlist.clear');
    Route::post('/wishlist/undo-clear', [WishlistController::class, 'undoClear'])->name('wishlist.undoClear');
    Route::post('/wishlist/add-all-to-cart', [WishlistController::class, 'addAllToCart'])->name('wishlist.addAllToCart');
    Route::post('/wishlist/add-to-cart/{product}', [WishlistController::class, 'addToCart'])->name('wishlist.addToCart');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
    Route::post('/cart/add', [CartController::class, 'quickAdd'])->name('cart.quickAdd');
    Route::post('/cart/update-item/{id}', [CartController::class, 'updateItem'])->name('cart.updateItem');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
     Route::post('/cart/remove-all', [CartController::class, 'removeSelected'])
        ->name('cart.removeSelected');
        Route::get('/auth/user', [AuthController::class, 'getUser'])->name('auth.user');
    Route::post('/product-view/cart/add', [CartController::class, 'storeItem'])->name('cart.add');
    Route::post('/product-view/wishlist/add', [WishlistController::class, 'storeItem'])->name('wishlist.add');
    Route::post('/comparisons', [ComparisonController::class, 'store'])->name('comparisons.store');
    Route::get('/comparisons/{id}', [ComparisonController::class, 'show'])->name('comparisons.show');
    Route::delete('/comparisons/{id}', [ComparisonController::class, 'destroy'])->name('comparisons.destroy');
    Route::get('/api/product-id/{slug}', function($slug) {
    $product = Product::where('slug', $slug)->first();
    if (!$product) {
        return response()->json(['success' => false], 404);
    }
    return response()->json(['success' => true, 'productId' => $product->id]);
});

});
Route::get('/api/product-id/{slug}', [ComparisonController::class, 'getIdBySlug']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/popular-comparisons', [ComparisonController::class, 'getPopular'])->name('popular.comparisons');


Route::get('/sms/send', [SmsController::class, 'create'])->name('sms.create');
Route::post('/sms/send', [SmsController::class, 'send'])->name('sms.send');
// End Authentication routes
