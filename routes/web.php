<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* FRONTEND CONTROLLERS */

use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ReviewController;

/* ADMIN CONTROLLERS */

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

/* AUTHENTICATION */

require __DIR__.'/auth.php';

/* ADMIN LOGIN PAGE - Check if user is already logged in */

Route::get('/admin/login', function(){
    if (Auth::check()) {
        if (Auth::user()->is_admin == '1') {
            return redirect('/admin');
        } else {
            return redirect('/')->with('error', 'You are already logged in as a regular user. Please logout to access admin login.');
        }
    }
    return view('auth.admin-login');
});

/* OTP VERIFICATION */

Route::middleware('auth')->group(function(){
    Route::get('/verify-otp', [App\Http\Controllers\Auth\OTPController::class, 'showVerifyPage'])->name('otp.verifypage');
    Route::post('/verify-otp', [App\Http\Controllers\Auth\OTPController::class, 'verify'])->name('otp.verify');
    Route::post('/resend-otp', [App\Http\Controllers\Auth\OTPController::class, 'resend'])->name('otp.resend');
});


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class,'home']);

Route::get('/products', [ProductController::class,'index']);

Route::get('/product/{id}', [ProductController::class,'show']);

/* CONTACT */

Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class,'index']);

Route::post('/contact', [App\Http\Controllers\Frontend\ContactController::class,'submit'])->name('contact.submit');

/* CART */

Route::get('/cart', [CartController::class,'cart']);

Route::get('/add-to-cart/{id}', [CartController::class,'add']);

Route::get('/remove-cart/{id}', [CartController::class,'remove']);

Route::post('/update-cart', [CartController::class,'update']);


/* CATEGORY */

Route::get('/category/{slug}', [CategoryController::class,'show']);

/* REVIEWS */

Route::post('/review', [ReviewController::class,'store']);


/* CHECKOUT */

Route::get('/checkout', [CheckoutController::class,'checkout']);

Route::post('/place-order', [CheckoutController::class,'placeOrder']);

Route::post('/payment/create', [PaymentController::class,'createOrder']);

Route::post('/payment/callback', [PaymentController::class,'paymentCallback']);



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('admin')->group(function(){

/* DASHBOARD */

Route::get('/', [DashboardController::class,'index']);


/* SLIDERS */

Route::get('/sliders', [SliderController::class,'index']);

Route::get('/sliders/create', [SliderController::class,'create']);

Route::post('/sliders/store', [SliderController::class,'store']);

Route::get('/sliders/edit/{id}', [SliderController::class,'edit']);

Route::post('/sliders/update/{id}', [SliderController::class,'update']);

Route::get('/sliders/delete/{id}', [SliderController::class,'destroy']);


/* ORDERS */

Route::get('/orders', [AdminOrderController::class,'index']);

Route::get('/orders/{id}', [AdminOrderController::class,'show']);

Route::post('/orders/{id}/status', [AdminOrderController::class,'updateStatus']);


/* PRODUCTS */

Route::get('/products', [AdminProductController::class,'index']);

Route::get('/products/create', [AdminProductController::class,'create']);

Route::post('/products/store', [AdminProductController::class,'store']);

Route::get('/products/edit/{id}', [AdminProductController::class,'edit']);

Route::post('/products/update/{id}', [AdminProductController::class,'update']);

Route::get('/products/delete/{id}', [AdminProductController::class,'destroy']);


/* CATEGORIES */

Route::get('/categories', [AdminCategoryController::class,'index']);

Route::get('/categories/create', [AdminCategoryController::class,'create']);

Route::post('/categories/store', [AdminCategoryController::class,'store']);

Route::get('/categories/edit/{id}', [AdminCategoryController::class,'edit']);

Route::post('/categories/update/{id}', [AdminCategoryController::class,'update']);

Route::get('/categories/delete/{id}', [AdminCategoryController::class,'destroy']);


/* USERS */

Route::get('/users', [UserController::class,'index']);

Route::get('/users/edit/{id}', [UserController::class,'edit']);

Route::post('/users/update/{id}', [UserController::class,'update']);

Route::get('/users/delete/{id}', [UserController::class,'destroy']);

/* REVIEWS */

Route::get('/reviews', [AdminReviewController::class,'index']);

Route::post('/reviews/{id}/status', [AdminReviewController::class,'updateStatus']);

Route::delete('/reviews/{id}', [AdminReviewController::class,'destroy']);


/* CONTACTS */

Route::get('/contacts', [ContactController::class,'index']);

Route::get('/contacts/{id}', [ContactController::class,'show']);

Route::post('/contacts/{id}/status', [ContactController::class,'updateStatus']);

Route::get('/contacts/delete/{id}', [ContactController::class,'destroy']);


/* SETTINGS */

Route::get('/settings', [SettingsController::class,'index']);

Route::post('/settings/update', [SettingsController::class,'update']);


/* ANALYTICS */

Route::get('/analytics', [AnalyticsController::class,'index']);


});