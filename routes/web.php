<?php

use App\Http\Controllers\backend\AdminFlashDealsController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryAdminController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\backend\AdminOrderManagementController;
use App\Http\Controllers\backend\AdminProductIssueController;
use App\Http\Controllers\backend\AdminUserController;
use App\Http\Controllers\backend\HomeAdminController;
use App\Http\Controllers\backend\ProductManagementController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\FlashDealCartController;
use App\Http\Controllers\ForgotPasswordController;
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
use App\Http\Controllers\OrderDocumentController;
use App\Http\Controllers\ProductDiscoveryHubController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserSessionController;
use App\Http\Controllers\WishlistController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/market-pulse/rates', [HomeController::class, 'ratesJson'])->name('market.pulse.rates');
Route::get('/market-pulse/trending', [HomeController::class, 'trendingJson'])->name('market.pulse.trending');

Route::get('/categories/{slug}', [HomeController::class, 'show'])->name('categories.show');
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
Route::get('/support/ticket/{ticket}', [ContactController::class,  'showTicket'])->name('support.ticket.show');

Route::get('/products/sort', [ProductListingController::class, 'sortProducts']);
Route::get('/products/brand/filter', [ProductListingController::class, 'brandFilter'])->name('products.filter');
Route::get('/brands/list', [ProductListingController::class, 'brandList'])->name('brands.list');
Route::get('/trending-suggestions', [ProductListingController::class, 'getTrendingSuggestions']);
Route::get('/products/price-range', [ProductListingController::class, 'getPriceRange']);
Route::get('/products/search', [ProductListingController::class, 'search'])->name('products.search');
Route::get('/products/main-filter', [ProductListingController::class, 'filter']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);
// Route::get('/product-discovery-hub', [ProductDiscoveryHubController::class, 'index']);
// Route::get('/products/main-filter', [ProductDiscoveryHubController::class, 'filter']);
Route::get('/products/flash-deals/{product}/details', [ProductListingController::class, 'details']);



Route::get('/compare', [ProductListingController::class, 'compare'])->name('products.compare');
Route::get('/authentication', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/product-compare-center', [ComparedController::class, 'index'])->name('compare');
Route::get('/help-center', [HelpCenterController::class, 'index'])->name('help.center');
Route::get('/help-center/search', [HelpCenterController::class, 'search'])->name('help.center.search');
Route::get('/help-center/suggest', [HelpCenterController::class, 'suggest'])->name('help.center.suggest');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/shopping-cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout-process', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/shipping', [CheckoutController::class, 'storeShipping'])->name('checkout.shipping');
Route::post('/checkout/payment', [CheckoutController::class, 'storePayment'])->name('checkout.payment');
Route::post('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
Route::get('/order-tracking', [OrderTrackingController::class, 'index'])->name('order.tracking');
Route::post('/orders/store', [OrderTrackingController::class, 'store'])->name('order.store');
Route::get('/thank-you/{order}', [OrderTrackingController::class, 'thankYou'])->name('thankyou');

Route::post('/shipping-address/store', [CheckoutController::class, 'store'])->name('shipping-address.store');
Route::get('/shipping-addresses/{id}/edit', [CheckoutController::class, 'editShippingAddress'])->name('shipping-address.edit');
Route::put('/shipping-address/update/{id}', [CheckoutController::class, 'updateShippingAddress'])->name('shipping-address.update');
Route::get('/products/{product}/reviews', [ReviewController::class, 'fetchFiltered'])
    ->name('reviews.fetch');
Route::get('/orders/search/{orderNo}', [OrderTrackingController::class, 'searchByOrderNo'])
    ->name('orders.search');
Route::get('/flash-deals', [FlashDealCartController::class, 'index'])
    ->name('flash-deals.showcase');
    Route::get('/flash-deals/load', [FlashDealCartController::class, 'loadMore'])->name('flash-deals.load');
// Start Authentication routes
Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::post('/normal/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp-user');
Route::post('/normal/login', [AuthController::class, 'login'])->name('normal-login-user');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetOTP'])->name('password.email');

Route::get('/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp');

Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');


Route::post('/cookies/accept', [UserActivityController::class, 'acceptCookies'])->name('cookies.accept');
Route::post('/activity/log', [UserActivityController::class, 'logActivity'])->name('activity.log');
Route::get('/policies/cookies', function() {
    return view('frontend.policies.cookies');
})->name('policies.cookies');
Route::get('/home/products/{id}/details', [HomeController::class, 'getDetails']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/home/cart/add', [CartController::class, 'AddCartFromHome'])->name('home.cart.add');
     Route::get('/user/sessions', [UserSessionController::class, 'index']);
    Route::post('/user/sessions', [UserSessionController::class, 'store']);
    Route::delete('/user/sessions/{id}', [UserSessionController::class, 'destroy']);
    Route::delete('/user/sessions', [UserSessionController::class, 'destroyAll']);
    Route::get('/orders/{product}/details', [AuthController::class, 'details']);
    Route::get('/orders/{order}', [OrderTrackingController::class, 'show'])->name('orders.show');
    Route::get('/orders/by-id/{orderId}', [OrderTrackingController::class, 'showById'])->name('orders.showById');

    Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/user/update-profile', [AuthController::class, 'updateProfile'])->name('user.update.profile');
    Route::post('/user/change-password', [AuthController::class, 'changePassword'])->name('user.change.password');
    Route::post('/profile/update', [AuthController::class, 'update'])->name('user.profile.update');
    Route::post('/profile/update-password', [AuthController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/delete', [AuthController::class, 'deleteAccount'])->name('profile.delete');

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
Route::post('/orders/{order}/reorder', [OrderTrackingController::class, 'reorder'])->name('orders.reorder');
Route::get('/profile/orders/filter', [OrderTrackingController::class, 'filter'])->name('profile.orders.filter');
Route::post('/orders/{order}/report-issue', [OrderTrackingController::class, 'reportIssue'])
    ->name('orders.reportIssue');
Route::post('/products/{product}/reviews', [ReviewController::class, 'OrderReviewStore'])
    ->name('products.reviews.store');
Route::post('/flash-deals/cart/add', [FlashDealCartController::class, 'add'])
    ->name('flash-deals.cart.add');

    // admin dashboard routes
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');


    //end admin dashboard routes
});
Route::get('/flash-deals/filter', [FlashDealCartController::class, 'filter'])->name('flash-deals.filter');


Route::get('/flash-deal/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/api/product-id/{slug}', [ComparisonController::class, 'getIdBySlug']);
Route::post('/normal/logout', [AuthController::class, 'logout'])->name('normal.logout');
Route::get('/popular-comparisons', [ComparisonController::class, 'getPopular'])->name('popular.comparisons');


Route::get('/sms/send', [SmsController::class, 'create'])->name('sms.create');
Route::post('/sms/send', [SmsController::class, 'send'])->name('sms.send');
// End Authentication routes


Route::prefix('orders')->group(function () {
    Route::get('{order}/invoice', [OrderDocumentController::class, 'invoice'])->name('orders.invoice');
    Route::get('{order}/invoice/download', [OrderDocumentController::class, 'downloadInvoice'])->name('orders.invoice.download');

    Route::get('{order}/receipt', [OrderDocumentController::class, 'receipt'])->name('orders.receipt');
    Route::get('{order}/receipt/download', [OrderDocumentController::class, 'downloadReceipt'])->name('orders.receipt.download');
});
Route::get('/receipt/verify/{order}', action: [OrderDocumentController::class, 'verifyReceipt'])->name('receipt.verify');
Route::get('/orders/{id}/get-order-no', [OrderTrackingController::class, 'getOrderNo']);
Route::post('/flash-deals/cart/add', [CartController::class, 'addToCartDeal'])->name('cart.add.deal');
 Route::get('/cart/items/refresh', [CartController::class, 'refreshCartItems'])->name('cart.items.refresh');
Route::get('/terms-and-conditions', function() {
    return view('frontend.policies.terms-condition');
})->name('terms.and.conditions');

Route::get('/privacy-policy', function() {
    return view('frontend.policies.privacy-policy');
})->name('privacy.policy');




// admin with no authentication middleware routes
Route::get('/account/admin/login', function() {
    return view('admin.auth.login');
})->name('admin.login');
Route::get('/account/admin/register', function() {
    return view('admin.auth.register');
})->name('admin.register');
Route::post('/admin/register', [AdminUserController::class, 'store'])->name('admin.register.store');

Route::post('account/admin/login', [AdminUserController::class, 'login'])->name('admin.login.submit');
Route::middleware(['middleware'=>'auth'])->prefix('admin')->group(function () {
Route::post('/logout', [AdminUserController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', [HomeAdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/send-reminder/{user}', [HomeAdminController::class, 'sendReminder'])->name('admin.sendReminder');

//start products route
Route::prefix('products')->controller(ProductManagementController::class)->group(function(){
Route::get('/listing','index')->name('admin.product.listing');
Route::get('/{id}', 'show')->name('admin.products.show');
Route::get('/{id}/edit/', 'edit')->name('admin.products.edit');
Route::put('/products/{id}', 'update')->name('admin.products.update');
Route::delete('/products/{id}/delete', 'destroy')->name('products.destroy');
Route::post('/products', 'store')->name('products.store');
Route::get('/filter', 'filter')->name('products.filter');
Route::get('/products/print-pdf', 'printPDF')->name('admin.products.printPDF');
Route::get('/products/save-pdf', 'savePDF')->name('admin.products.savePDF');
Route::get('/products/save-excel', 'saveExcel')->name('admin.products.saveExcel');

});
Route::get('/new-product',  [ProductManagementController::class,'create'])->name('admin.products.create');
//end products route

//start flash deals route
Route::prefix('/flash-deals')->controller(AdminFlashDealsController::class)->group(function(){
Route::get('/overview','index')->name('admin.flashDeals.index');
Route::get('/create', function(){
    return view('admin.category.create');
})->name('admin.flash-deals.create');
Route::get('/{id}/edit/', 'edit')->name('admin.flash-deals.edit');
Route::put('/{id}/update', 'update')->name('admin.flash-deals.update');
Route::delete('/{id}/delete', 'destroy')->name('admin.flash-deals.destroy');
});

//end flash deals route

//start category route
Route::prefix('/category')->controller(CategoryAdminController::class)->group(function(){
Route::get('/overview', 'index')->name('category.admin.index');
Route::delete('/{id}/delete', 'destroy')->name('category.destroy');
Route::get('/create', function(){
    return view('admin.category.create');
})->name('admin.category.create');
Route::get('/{id}/edit/', 'edit')->name('admin.category.edit');
Route::put('/{id}/update', 'update')->name('admin.category.update');
Route::post('/store', 'store')->name('admin.category.store');
Route::delete('/{id}/delete', 'destroy')->name('admin.category.destroy');


});
//end category route

//start brand route
Route::prefix('/brand')->controller(BrandController::class)->group(function(){
Route::get('/overview', 'index')->name('admin.brand.index');
Route::delete('/{id}/delete', 'destroy')->name('admin.brand.destroy');
Route::get('/create', function(){
return view('admin.brand.create');
})->name('admin.brand.create');
Route::get('/{id}/edit/', 'edit')->name('admin.brand.edit');
Route::put('/{id}/update', 'update')->name('admin.brand.update');
Route::post('/store', 'store')->name('admin.brand.store');
});
//end brand route

//start product issue route
Route::prefix('/product-issues')->controller(AdminProductIssueController::class)->group(function(){
    Route::get('/overview', 'index')->name('admin.productIssue.index');
    Route::post('/product-issues/reply', 'reply')->name('admin.product-issues.reply');
    Route::get('/orders/{orderId}/items', 'getOrderItems')->name('admin.orders.items');
    Route::get('/{id}/timeline', 'getTimeline');

});
//end product issue route


//start orders route
Route::prefix('/orders')->controller(AdminOrderManagementController::class)->group(function(){
Route::get('/overview', 'index')->name('admin.orders.list');
Route::get('/items', 'OrderItems')->name('admin.orders.items');
Route::get('/{id}/show',  'show')->name('admin.orders.show');
Route::post('/contact-buyer', 'contactBuyer')->name('admin.orders.contact-buyer');
Route::post('/{order}/status', 'updateStatus')->name('admin.orders.updateStatus');

});
//end orders route




});
// admin with no authentication middleware routes
