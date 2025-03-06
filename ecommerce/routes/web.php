<?php

use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Auth;

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

require __DIR__.'/auth.php';

//this raise a issue at registration if user no verified
// Auth::routes(['verify' => true]);

Auth::routes(['verify' => true]);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');


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


// normal user
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('verified');

});

//admin user
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});

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
    
   Route::get('payment/{orderId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
                // ->middleware('verified');


Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});


Route::get('/fetch-products', [ProductController::class, 'fetchAndSaveProducts']);

Route::get('/', function () {
    return view('frontend.master');
})->name('home');




use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


// email verification

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    
    $request->fulfill();
    session()->flash('message', 'Your email has been successfully verified! Please log in.');
    return redirect('login');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
