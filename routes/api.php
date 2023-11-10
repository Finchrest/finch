<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\BannersController;
use App\Http\Controllers\api\OffersController;
use App\Http\Controllers\api\PlacesController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\LocationsController;
use App\Http\Controllers\api\PassportsController;
use App\Http\Controllers\api\OrdersController;
use App\Http\Controllers\api\HomeAddresses;
use App\Http\Controllers\api\PassportOrdersController;


Route::get('getBanners', [BannersController::class, 'index']);
Route::get('getOffers', [OffersController::class, 'index']);
Route::get('getPlaces', [PlacesController::class, 'index']);
Route::get('getPlaceDetail/{id}', [PlacesController::class, 'show']);
Route::get('getProducts', [ProductsController::class, 'index']);
Route::get('getProductDetail/{id}', [ProductsController::class, 'show']);
Route::get('getHomeProducts', [ProductsController::class, 'home_products']);
Route::get('getLocations', [LocationsController::class, 'index']);
Route::get('bearPassport', [PassportsController::class, 'index']);
Route::get('getPassportData', [PassportsController::class, 'get_passport_data']);

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::post('otp_verify', [ApiController::class, 'otp_verify']);
Route::post('resend_otp', [ApiController::class, 'resend_otp']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('check_token', [ApiController::class, 'check_token']);
    Route::get('cheaklowBalace', [ApiController::class, 'cheaklowBalace']);
    Route::Post('updateInfo', [ApiController::class, 'updateInfo']);
    Route::Post('sendPassportOtp', [ApiController::class, 'sendPassportOtp']);
    Route::post('passport_otp_verify', [ApiController::class, 'passport_otp_verify']);


    Route::Post('applyCoupon', [ApiController::class, 'applyCoupon']);

    Route::post('createOrder', [OrdersController::class, 'create_order']);
    Route::post('orderConfirm', [OrdersController::class, 'order_confirm']);
    Route::get('getDeliveryCharges', [OrdersController::class, 'getDeliveryCharges']);


    Route::post('saveUseraddress', [HomeAddresses::class, 'saveUseraddress']);
    Route::post('getUserAddress', [HomeAddresses::class, 'getUserAddress']);
    Route::post('getsingleAddress', [HomeAddresses::class, 'getsingleAddress']);
    Route::post('deletesingleAddress', [HomeAddresses::class, 'deletesingleAddress']);

    Route::get('getOrders', [ApiController::class, 'get_user_order']);
    Route::get('getOrderDetail/{id}', [ApiController::class, 'order_detail']);


    Route::post('createPassportOrder', [PassportOrdersController::class, 'create_passport_order']);
    Route::post('passportOrderConfirm', [PassportOrdersController::class, 'passport_order_confirm']);
    Route::post('passportTopup', [PassportOrdersController::class, 'passportTopup']);
    Route::post('getPassportFreeProduct', [PassportOrdersController::class, 'getPassportFreeProduct']);

    Route::get('getPassportOrders', [ApiController::class, 'get_user_passport_order']);
    Route::get('getPassportOrderDetail/{id}', [ApiController::class, 'passport_order_detail']);

    
});
