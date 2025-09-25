<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Services\ShopifyService;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;

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
    return redirect()->route('products.index');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/api/checkout-url', [CheckoutController::class, 'generateUrl']);

Route::get('/shopify/storefront-token', function () {
    return response()->json([
        'token' => env('STOREFRONT_API_ACCESS_TOKEN'),
        'store' => env('SHOPIFY_STORE_DOMAIN'),
        'api_version' => env('SHOPIFY_API_VERSION', '2025-01'),
    ]);
});
