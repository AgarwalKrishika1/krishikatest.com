<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\SaleSliderController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RazorpayPaymentController;
// use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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

require __DIR__.'/auth.php';

//this raise a issue at registration if user no verified
// Auth::routes(['verify' => true]);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/test-products', [ProductController::class, 'index'])->name('testProducts');

// Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

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



Route::middleware(['auth'])->group(function () {

    Route::post('/custom-logout', [AuthenticatedSessionController::class, 'customLogout'])->name('custom.logout');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/{orderId}/shipping', [OrderController::class, 'shippingForm'])->name('order.shippingForm');
    Route::post('/order/save-shipping', [OrderController::class, 'saveShipping'])->name('order.saveShipping');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout')->middleware('verified');
    Route::get('payment/{orderId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show')->middleware('verified');
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
});

Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::get('/add-to-cart-view', [ProductController::class, 'addToCartView'])->name('products.addToCartView');
Route::delete('/add-to-cart/{index}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/fetch-products', [ProductController::class, 'fetchAndSaveProducts']);

// email verification

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    
    $request->fulfill();

    return redirect('login')->with('status', 'You are verified, please login to continue');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



// admin

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('home', [AdminController::class, 'index'])->name('admin.index');
    Route::get('product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.edit');
    Route::put('product/{id}', [AdminController::class, 'updateProduct'])->name('admin.update');
    Route::delete('product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.delete');

    Route::get('user/{id}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('user/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::delete('orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.order.delete');

    //slider
    Route::get('sliders', [SaleSliderController::class, 'index'])->name('admin.sliders.index');
    Route::get('sliders/create', [SaleSliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('sliders', [SaleSliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('sliders/{saleSlider}/edit', [SaleSliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('sliders/{saleSlider}', [SaleSliderController::class, 'update'])->name('admin.sliders.update');
    Route::delete('sliders/{saleSlider}', [SaleSliderController::class, 'destroy'])->name('admin.sliders.delete');

    Route::get('admin', function () {
        return view('adminHome');
    })->name('admin.home');


    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('products', function () {
        return view('admin.product');
    })->name('admin.products');

    Route::get('users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    Route::get('sliders', function () {
        return view('admin.sale_slider');
    })->name('admin.sliders');

});
