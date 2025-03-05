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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SubscriptionController;


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

Route::get('/subscribed', function () {
    return view('subscribed');
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


require __DIR__.'/auth.php';

//this raise a issue at registration if user no verified
// Auth::routes(['verify' => true]);

Auth::routes(['verify' => true]);

// normal user
Route::middleware(['auth', 'user-access:user', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

});

//admin user
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => ['auth','admin']], function () {
//     Route::get('/dashboard', function () {
//         return "ADMIN";
//     });
// });

Route::get('/products', [ProductController::class, 'index'])->name('products.index');



Route::middleware(['auth'])->group(function () {

    Route::post('/custom-logout', [AuthenticatedSessionController::class, 'customLogout'])->name('custom.logout');
   
    Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/add-to-cart-view', [ProductController::class, 'addToCartView'])->name('products.addToCartView');
    Route::delete('/add-to-cart/{index}', [CartController::class, 'remove'])->name('cart.remove');

    
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/{orderId}/shipping', [OrderController::class, 'shippingForm'])->name('order.shippingForm');
    Route::post('/order/save-shipping', [OrderController::class, 'saveShipping'])->name('order.saveShipping');

    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    
   Route::get('payment/{orderId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show')->middleware('verified');


Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});


Route::get('/fetch-products', [ProductController::class, 'fetchAndSaveProducts']);



// email verification

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', function () {
    return view('frontend.master');
})->name('home');



Route::get('/subscribe', [SubscriptionController::class, 'showForm'])->name('subscribe');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe.submit');
