<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/dashboard', function () {
        return "ADMIN";
    });
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); //not working
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::get('/add-to-cart-view', [ProductController::class, 'addToCartView'])->name('products.addToCartView');
Route::delete('/add-to-cart/{index}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    // Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    // Route::post('cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/{orderId}/shipping', [OrderController::class, 'shippingForm'])->name('order.shippingForm');
    Route::post('/order/save-shipping', [OrderController::class, 'saveShipping'])->name('order.saveShipping');

    // Route::get('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    
   Route::get('payment/{orderId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
    // Route::post('payment/{orderId}', [PaymentController::class, 'processPayment'])->name('payment.process');

    // Route::get('product',[PaymentController::class,'index']);
 //   Route::post('razorpay-payment',[PaymentController::class,'store'])->name('razorpay.payment.store');


//  Route::get('payment',[RazorpayPaymentController::class,'index'])->name('payment.show');
// Route::post('payment/create',[RazorpayPaymentController::class,'store'])->name('razorpay.payment.store');
// Route::post('payment/failure',[RazorpayPaymentController::class,'failure'])->name('razorpay.payment.failure');
// Route::get('/402', function () {
//     return view('errors.402');
// });

//  Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('payment.show');

Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/fetch-products', [ProductController::class, 'fetchAndSaveProducts']);