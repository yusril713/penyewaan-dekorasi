<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\FurnishController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
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

Route::get('sign-up', [RegisterController::class, 'index'])->name('signup');
Route::post('sign-up', [RegisterController::class, 'store'])->name('signup');

Route::get('product/{id}/detail', [ProductController::class, 'detail'])->name('product.detail');
Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addtocart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('decor/manage', DecorController::class, ['as' => 'decor']);
    Route::resource('furnish/manage', FurnishController::class, ['as' => 'furnish']);

    Route::get('decor/manage/{id}/detail', [DecorController::class, 'indexImage'])->name('decor.manage.detail.index');
    Route::get('decor/manage/{id}/detail/create', [DecorController::class, 'createImage'])->name('decor.manage.detail.create');
    Route::post('decor/manage/{id}/detail', [DecorController::class, 'storeImage'])->name('decor.manage.detail.store');
    Route::delete('decor/manage/{id}/detail/{imageId}', [DecorController::class, 'destroyImage'])->name('decor.manage.detail.destroy');

    Route::get('furnish/manage/{id}/detail', [DecorController::class, 'indexImage'])->name('furnish.manage.detail.index');
    Route::get('furnish/manage/{id}/detail/create', [DecorController::class, 'createImage'])->name('furnish.manage.detail.create');
    Route::post('furnish/manage/{id}/detail', [DecorController::class, 'storeImage'])->name('furnish.manage.detail.store');
    Route::delete('furnish/manage/{id}/detail/{imageId}', [DecorController::class, 'destroyImage'])->name('furnish.manage.detail.destroy');
});
