<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\CategoryController;
use App\Http\Controllers\Api\User\ProductController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\User\DashboardController;
use App\Http\Controllers\Api\User\TeamController;
// use App\Http\Controllers\Api\User\ProductController;
// use App\Http\Controllers\Api\User\AddressController;
// use App\Http\Controllers\Api\User\CartController;
// use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\AddressController;
use App\Http\Controllers\Api\User\SmartShopController;
use App\Http\Controllers\Api\User\SchemeController;


use App\Http\Controllers\Api\Vendor\AuthController as VendorAuth;
use App\Http\Controllers\Api\Vendor\InvoiceController;
use App\Http\Controllers\Api\Vendor\OrderController as VendorOrder;
use App\Http\Controllers\Api\Vendor\ProductController as VendorProduct;
use App\Http\Controllers\Api\Vendor\ShopController;
use App\Http\Controllers\Api\User\WishlistController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/add-to-cart', [CartController::class, 'store']);
Route::get('/view-cart', [CartController::class, 'cartdetails']);
Route::post('/order', [OrderController::class, 'placeOrder']);
Route::get('/orderslist', [OrderController::class, 'orderslist']);
Route::get('/order-details/{id}', [OrderController::class, 'orderdetails']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/smartshops', [SmartShopController::class, 'index']);
Route::post('/checkreferal', [TeamController::class, 'checkUser']);
Route::post('/getalldownlineusers', [TeamController::class, 'getdownlineList']);
Route::post('/add-new-customer', [SchemeController::class, 'store']);
Route::get('/customers', [SchemeController::class, 'index']);
Route::get('/payments', [SchemeController::class, 'paymentsList']);
// Route::get('/dashboard/liquor', [DashboardController::class, 'liquorsList']);
// Route::get('/dashboard/hookah', [DashboardController::class, 'hookahList']);
// Route::get('/dashboard/combos', [DashboardController::class, 'combos']);
// Route::get('/product/{id}', [ProductController::class, 'show']);
// Route::get('/productvariationdetails', [ProductController::class, 'productVariationDetails']);
// Route::resource('/adress', AddressController::class);
// Route::resource('/cart', CartController::class);
// Route::resource('/order', OrderController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/userdetails', [AuthController::class, 'userDetails']);
Route::get('/category/product/{id}', [ProductController::class, 'showCategoryProducts']);
Route::post('/add-address', [AddressController::class, 'store']);
Route::post('/update-address/{id}', [AddressController::class, 'update']);
Route::get('/get-address', [AddressController::class, 'index']);
Route::get('/delete-address/{id}', [AddressController::class, 'destroy']);

Route::post('/add-to-wishlist', [WishlistController::class, 'add']);
Route::get('/get-wishlist', [WishlistController::class, 'get']);
Route::get('/delete-wishlist/{id}', [WishlistController::class, 'remove']);



Route::post('/vendor/login', [VendorAuth::class, 'login']);
Route::post('/vendor/signup', [VendorAuth::class, 'register']);
Route::post('/vendor/update', [VendorAuth::class, 'update']);


Route::post('/vendor/product-add', [VendorProduct::class, 'store']);
Route::post('/vendor/products-list', [VendorProduct::class, 'index']);

Route::post('/vendor/shop-add', [ShopController::class, 'store']);
Route::get('/vendor/shops-list', [ShopController::class, 'index']);

Route::post('/vendor/orders-list', [VendorOrder::class, 'index']);

