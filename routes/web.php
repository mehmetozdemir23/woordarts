<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\ProfileController;

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

Route::get('/', HomeController::class
)->name('home');

Route::prefix('/products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::prefix('/cart')->name('cart.')->group(
    function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'addItem'])->name('add');
        Route::post('/update', [CartController::class, 'updateItem'])->name('update');
        Route::post('/remove', [CartController::class, 'removeItem'])->name('remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        Route::post('/validateForCheckout',[CartController::class,'validateForCheckout'])->name('validate');
    }
);

Route::prefix('/checkout')->name('checkout.')->group(function () {
    Route::prefix('/auth')->name('auth.')->group(function(){
        Route::get('/form', [CheckoutController::class, 'showCheckoutFormForAuth'])->name('form');
        Route::post('/submit',[CheckoutController::class,'submitCheckoutFormForAuth'])->name('submit');
    });
    Route::prefix('/guest')->name('guest.')->group(function(){
        Route::get('/form', [CheckoutController::class, 'showCheckoutFormForGuest'])->name('form');
        Route::post('/submit',[CheckoutController::class,'submitCheckoutFormForGuest'])->name('submit');
    });
});

Route::prefix('/pay')->name('payment.')->group(function () {
    Route::post('/auth', [PaymentController::class, 'showPaymentFormForAuth'])->name('auth');
    Route::post('/guest', [PaymentController::class, 'showPaymentFormForGuest'])->name('guest');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'destroy'])->name('auth.logout');

    Route::prefix('/account')->name('account.')->group(function () {
        Route::get('/', function () {
            return redirect(route('account.profile.index'));
        });
        Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
        Route::prefix('/profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });
        Route::prefix('/addresses')->name('addresses.')->group(function () {
            Route::get('/', [UserAddressController::class, 'index'])->name('index');
            Route::get('/{address}/edit', [UserAddressController::class, 'edit'])->name('edit');
            Route::put('/{address}', [UserAddressController::class, 'update'])->name('update');
        });
        Route::prefix('/orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        });
    });
});

Route::middleware('guest')->name('auth.')->group(function () {
    Route::prefix('/register')->name('register.')->group(function () {

        Route::get('/create', [RegisterController::class, 'create'])->name('create');
        Route::post('/store', [RegisterController::class, 'store'])->name('store');
    });
    Route::prefix('/login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'create'])->name('create');
        Route::post('/store', [LoginController::class, 'store'])->name('store');
    });
});
