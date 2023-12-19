<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\InvestorController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\PrivacyPolicyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('home');
});
Route::get('/logout', function () {
    Auth::logout();
    return to_route('login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomersController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('investor', InvestorController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('product', ProductController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('area', AreaController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('privacy-policy', PrivacyPolicyController::class);
  
    Route::get('pending-order-list', [OrderController::class, 'pending_order_list'])->name('pending_order_list');
    Route::get('approved-order-list', [OrderController::class, 'approved_order_list'])->name('approved_order_list');
    Route::get('cancel-order-list', [OrderController::class, 'cancel_order_list'])->name('cancel_order_list');
    Route::get('delivered-order-list', [OrderController::class, 'delivered_order_list'])->name('delivered_order_list');
    Route::get('delivery-invoice', [OrderController::class, 'delivery_invoice'])->name('delivery_invoice');
    Route::get('sold-product', [OrderController::class, 'sold_product'])->name('sold_product');

    Route::get('approve/order/{id}', [OrderController::class, 'order_approve'])->name('order_approve');
    Route::get('cancel/order/{id}', [OrderController::class, 'order_cancel'])->name('order_cancel');
    Route::get('delivered/order/{id}', [OrderController::class, 'order_delivered'])->name('order_delivered');


    Route::get('order-invoice/{id}', [OrderController::class, 'order_invoice'])->name('order_invoice');

    Route::get('flash-sale', [OrderController::class, 'flash_sale'])->name('flash_sale');

    Route::get('edit-flash-sale', [OrderController::class, 'flash_sale_edit'])->name('flash_sale_edit');
    Route::post('update-flash-sale', [OrderController::class, 'update_flash_sale'])->name('update_flash_sale');

    Route::get('add-flash-sale', [OrderController::class, 'add_flash_sale'])->name('add_flash_sale');
    Route::post('save-flash-sale', [OrderController::class, 'save_flash_sale'])->name('save_flash_sale');

    Route::get('remove-flash-sale/{id}', [OrderController::class, 'remove_flash_sale'])->name('remove_flash_sale');
    Route::get('remove-all-flash-sale', [OrderController::class, 'remove_all_flash_sale'])->name('remove_all_flash_sale');

    Route::get('pending-user-list', [HomeController::class, 'user_list'])->name('user_list');
    Route::get('approved-user-list', [HomeController::class, 'approved_user_list'])->name('approved_user_list');
    Route::get('approved-user/{id}', [HomeController::class, 'approved_user'])->name('approved_user');
    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase_lists');
    Route::get('create_purchase', [PurchaseController::class, 'create'])->name('create_purchase');
  

});
