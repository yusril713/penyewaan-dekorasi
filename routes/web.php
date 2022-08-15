<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FurnishController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('redirect', [HomeController::class, 'redirect']);

Route::get('sign-up', [RegisterController::class, 'index'])->name('signup');
Route::post('sign-up', [RegisterController::class, 'store'])->name('signup');

Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('product/{id}/detail', [ProductController::class, 'detail'])->name('product.detail');
Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addtocart');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove.from.cart');

Route::get('flush-session', function(Request $request) {
    $request->session()->flush();

    return redirect('/');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|owner'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('decor/manage', DecorController::class, ['as' => 'decor']);
    Route::resource('furnish/manage', FurnishController::class, ['as' => 'furnish']);
    Route::resource('employee/manage', EmployeeController::class, ['as' => 'employee']);

    Route::get('employe/{userId}/reset-password', [CustomerController::class, 'resetPassword'])->name('employee.resetPassword');

    Route::get('decor/manage/{id}/detail', [DecorController::class, 'indexImage'])->name('decor.manage.detail.index');
    Route::get('decor/manage/{id}/detail/create', [DecorController::class, 'createImage'])->name('decor.manage.detail.create');
    Route::post('decor/manage/{id}/detail', [DecorController::class, 'storeImage'])->name('decor.manage.detail.store');
    Route::delete('decor/manage/{id}/detail/{imageId}', [DecorController::class, 'destroyImage'])->name('decor.manage.detail.destroy');

    Route::get('furnish/manage/{id}/detail', [DecorController::class, 'indexImage'])->name('furnish.manage.detail.index');
    Route::get('furnish/manage/{id}/detail/create', [DecorController::class, 'createImage'])->name('furnish.manage.detail.create');
    Route::post('furnish/manage/{id}/detail', [DecorController::class, 'storeImage'])->name('furnish.manage.detail.store');
    Route::delete('furnish/manage/{id}/detail/{imageId}', [DecorController::class, 'destroyImage'])->name('furnish.manage.detail.destroy');

    Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::put('booking/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::put('booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::put('transaction/{id}/borrowed', [TransactionController::class, 'borrowed'])->name('transaction.borrowed');
    Route::put('transaction/{id}/returned', [TransactionController::class, 'returned'])->name('transaction.returned');
    Route::get('transaction/history', [TransactionController::class, 'history'])->name('transaction.history');

    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('customer/{userId}/reset-password/', [CustomerController::class, 'resetPassword'])->name('customer.resetPassword');
    Route::get('/transaction/report', [ReportController::class, 'index'])->name('transaction.report.index');
    Route::get('/transaction/report/print', [ReportController::class, 'print'])->name('transaction.report.print');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:owner|customer|admin'
])->group(function() {
    Route::get('profile', [ProfilController::class, 'index'])->name('profile.index');
    Route::post('profile/update-password', [ProfilController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('profile/{id}', [ProfilController::class, 'updateProfile'])->name('profile.updateProfile');

    Route::get('process-to-checkout', [CartController::class, 'processToCheckout'])->name('processToCheckout');
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::put('checkout/{id}/receipt-of-transfer', [CheckoutController::class, 'uploadReceiptOfTransfer'])->name('checkout.receiptOfTransfer');

    Route::get('my-transaction', [UserTransactionController::class, 'index'])->name('user.transaction');
    Route::get('my-transaction/{id}', [UserTransactionController::class, 'show'])->name('user.transaction.show');
});
