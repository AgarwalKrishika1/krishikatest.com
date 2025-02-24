<?php

use App\Http\Controllers\TemplateController;
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
    return view('frontend.master');
});

Route::get('about', function () {
    return view('about');
});

Route::get('testimonial', function () {
    return view('testimonial');
});

Route::get('blog', function () {
    return view('blog_list');
});


Route::get('contact', function () {
    return view('contact');
});

Route::get('/a', [TemplateController::class,'index'])->name('templateHome');

Route::get('/dashboard', function () {
    return view('frontend.home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

// normal user
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

//admin user
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/dashboard', function () {
        return "ADMIN";
    });
});


Route::middleware('auth')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    Route::get('/products/{category}', [ProductController::class, 'fetchProductsByCategory']);
    
    Route::get('/sortedProducts', [ProductController::class, 'fetchSortedProducts']);

    Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/add-to-cart-view', [ProductController::class, 'addToCartView'])->name('products.addToCartView');
    Route::delete('/add-to-cart/{index}', [CartController::class, 'remove'])->name('cart.remove');
    
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/{orderId}/shipping', [OrderController::class, 'shippingForm'])->name('order.shippingForm');
    Route::post('/order/save-shipping', [OrderController::class, 'saveShipping'])->name('order.saveShipping');

    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    
   Route::get('payment/{orderId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');


Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});


Route::get('/fetch-products', [ProductController::class, 'fetchAndSaveProducts']);



// email

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); //not working
 // Route::get('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
 // Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
    // Route::post('cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    // Route::post('payment/{orderId}', [PaymentController::class, 'processPayment'])->name('payment.process');
    // Route::get('product',[PaymentController::class,'index']);
 //   Route::post('razorpay-payment',[PaymentController::class,'store'])->name('razorpay.payment.store');
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//  Route::get('payment',[RazorpayPaymentController::class,'index'])->name('payment.show');
// Route::post('payment/create',[RazorpayPaymentController::class,'store'])->name('razorpay.payment.store');
// Route::post('payment/failure',[RazorpayPaymentController::class,'failure'])->name('razorpay.payment.failure');
// Route::get('/402', function () {
//     return view('errors.402');
// });
//  Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('payment.show');