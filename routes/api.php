<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::get('/logout', [RegisterController::class, 'logout']);
Route::post('/verify-otp', [RegisterController::class, 'verify_otp']);
Route::post('/otp-send', [RegisterController::class, 'otp_send']);
Route::post('/new-password-set', [RegisterController::class, 'new_password_set']);
Route::post('/new-password-create', [RegisterController::class, 'new_password_create']);


Route::get('/privacy-policy', [ApiController::class, 'privacy_policy']);
Route::get('/district', [LocationController::class, 'district']);
Route::get('/all-area', [LocationController::class, 'all_area']);
Route::get('/area/{id}', [LocationController::class, 'get_area']);


Route::middleware('auth:sanctum')->group( function () {
    Route::get('my-profile', [ApiController::class, 'my_profile']);
    Route::post('update-profile', [ApiController::class, 'update_profile']);

    Route::get('categories', [ApiController::class, 'category']);
    Route::get('company', [ApiController::class, 'company']);
    Route::resource('products', ProductController::class);

    Route::post('order', [ApiController::class, 'order']);
    Route::get('order-list', [ApiController::class, 'order_list']);
    Route::get('slider-list', [ApiController::class, 'slider_list']);
});
