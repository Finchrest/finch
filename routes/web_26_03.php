<?php

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

Route::get('/clear-cache', function () {
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('route:clear');
	// return what you want
});


Route::get('razorpay-payment', [App\Http\Controllers\RazorpayPaymentController::class, 'index'])->name('razorpay.payment.payment_view');
Route::post('razorpay-payment', [App\Http\Controllers\RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test_home', [App\Http\Controllers\HomeController::class, 'test_home'])->name('test_home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/all-products', [App\Http\Controllers\HomeController::class, 'product'])->name('front.all-products');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
Route::get('/information', [App\Http\Controllers\HomeController::class, 'information'])->name('information');
Route::get('/information_details/{id}', [App\Http\Controllers\HomeController::class, 'information_details'])->name('information_details');
Route::post('/get_products', [App\Http\Controllers\HomeController::class, 'get_products'])->name('get_products');
Route::post('/productView', [App\Http\Controllers\HomeController::class, 'productView'])->name('productView');
Route::post('/changeLocations', [App\Http\Controllers\HomeController::class, 'changeLocations'])->name('changeLocations');
Route::post('/setLocations', [App\Http\Controllers\HomeController::class, 'setLocations'])->name('setLocations');
Route::post('/cloaseLocationsModal', [App\Http\Controllers\HomeController::class, 'cloaseLocationsModal'])->name('cloaseLocationsModal');
Route::post('/ageSubmit', [App\Http\Controllers\HomeController::class, 'ageSubmit'])->name('ageSubmit');
Route::post('/profileView', [App\Http\Controllers\HomeController::class, 'profileView'])->name('profileView');
Route::post('/updateUser', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('updateUser');
Route::post('/contact_form', [App\Http\Controllers\HomeController::class, 'contact_form'])->name('contact_form');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/our_services', [App\Http\Controllers\HomeController::class, 'our_services'])->name('our_services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/instagram-feeds', [App\Http\Controllers\HomeController::class, 'instagram_feeds'])->name('instagram_feeds');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');

Route::group(['middleware' => 'auth:web'], function () {
	Route::get('/my-orders', [App\Http\Controllers\UserController::class, 'get_user_order'])->name('my_orders');
	Route::get('/my-passports', [App\Http\Controllers\UserController::class, 'get_user_passports'])->name('my_passports');
	Route::post('/orderDetails', [App\Http\Controllers\UserController::class, 'get_user_order_details'])->name('orderDetails');
	Route::post('/passportDetails', [App\Http\Controllers\UserController::class, 'get_user_passport_details'])->name('passportDetails');
	Route::post('/profile-update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('profile_update');
	Route::post('/codeView', [App\Http\Controllers\UserController::class, 'codeView'])->name('codeView');
	Route::post('/sendPassportOtp', [App\Http\Controllers\UserController::class, 'sendPassportOtp'])->name('sendPassportOtp');
	Route::post('/passportOtpVerify', [App\Http\Controllers\UserController::class, 'passportOtpVerify'])->name('passportOtpVerify');
	Route::post('/applyCouponCode', [App\Http\Controllers\UserController::class, 'applyCouponCode'])->name('applyCouponCode');

	Route::post('/showPassportPage', [App\Http\Controllers\FrontPassportController::class, 'showPassportPage'])->name('showPassportPage');
	Route::post('/getPassportView', [App\Http\Controllers\FrontPassportController::class, 'getPassportView'])->name('getPassportView');
	Route::post('/passportSubmit', [App\Http\Controllers\FrontPassportController::class, 'passportOrderSubmit'])->name('passportSubmit');
	Route::post('/getPassportConfirmView', [App\Http\Controllers\FrontPassportController::class, 'getPassportConfirmView'])->name('getPassportConfirmView');
	Route::post('/passportConfirmSubmit', [App\Http\Controllers\FrontPassportController::class, 'passportConfirmSubmit'])->name('passportConfirmSubmit');
	Route::post('/getPassportSummaryView', [App\Http\Controllers\FrontPassportController::class, 'getPassportSummaryView'])->name('getPassportSummaryView');
	Route::post('/passport_payment_submit', [App\Http\Controllers\FrontPassportController::class, 'payment_submit'])->name('passport.passport_payment_submit');

	Route::post('/addToCart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
	Route::post('/updateCart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('updateCart');
	Route::get('/setCartData', [App\Http\Controllers\CartController::class, 'setCartData'])->name('setCartData');
	Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
	Route::get('/getCheckoutData', [App\Http\Controllers\CartController::class, 'getCheckoutData'])->name('getCheckoutData');
	Route::post('/removeItem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeItem');
	Route::post('/changeItem', [App\Http\Controllers\CartController::class, 'changeItem'])->name('changeItem');
	Route::post('/cartProcess', [App\Http\Controllers\CartController::class, 'cartProcess'])->name('cartProcess');
	Route::post('/changeCartQuantity', [App\Http\Controllers\CartController::class, 'changeCartQuantity'])->name('changeCartQuantity');
	Route::post('/cart_checkout_view', [App\Http\Controllers\CartController::class, 'cart_checkout_view'])->name('cart_checkout_view');
	Route::post('/payment_submit', [App\Http\Controllers\CartController::class, 'payment_submit'])->name('cart.payment_submit');

	Route::post('/updateQty', [App\Http\Controllers\CartController::class, 'updateQty'])->name('updateQty');
});

Route::post('/showLoginPage', [App\Http\Controllers\Auth\LoginController::class, 'showLoginPage'])->name('showLoginPage');
Route::post('/submitLoginDetails', [App\Http\Controllers\Auth\LoginController::class, 'submitLoginDetails'])->name('submitLoginDetails');
Route::post('/viewOtpPage', [App\Http\Controllers\Auth\LoginController::class, 'viewOtpPage'])->name('viewOtpPage');
Route::post('/otpSubmit', [App\Http\Controllers\Auth\LoginController::class, 'otpSubmit'])->name('otpSubmit');
Route::post('/resendOtp', [App\Http\Controllers\Auth\LoginController::class, 'resendOtp'])->name('resendOtp');
Route::post('/front/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('front/logout');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
	Route::group(['middleware' => 'admin.guest:admin'], function () {
		Route::get('login', [App\Http\Controllers\admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('login', [App\Http\Controllers\admin\Auth\LoginController::class, 'login'])->name('admin.login');
	});
	Route::group(['middleware' => 'admin.auth'], function () {
		Route::get('/', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('dashboard', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin.dashboard');
		Route::post('logout', [App\Http\Controllers\admin\Auth\LoginController::class, 'logout'])->name('admin.logout');


		Route::resource('banners', 'App\Http\Controllers\admin\BannersController');
		Route::get('/banner-list', [App\Http\Controllers\admin\BannersController::class, 'index'])->name('admin.banners');
		Route::post('/banner-list', [App\Http\Controllers\admin\BannersController::class, 'list'])->name('admin.banners.list');
		Route::get('/banner-destroy/{id}', [App\Http\Controllers\admin\BannersController::class, 'destroy'])->name('banners.destroy');
		Route::post('/banner-upload', [App\Http\Controllers\admin\BannersController::class, 'upload'])->name('banners.upload');

		Route::resource('users', 'App\Http\Controllers\admin\UsersController');
		Route::get('/user-list', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('admin.users');
		Route::get('/user-enquiry-list', [App\Http\Controllers\admin\UsersController::class, 'user_enquiry_list'])->name('admin.user_enquiry');
		Route::post('/user_enquiry_ajax_list', [App\Http\Controllers\admin\UsersController::class, 'user_enquiry_ajax_list'])->name('admin.users.user_enquiry_ajax_list');
		Route::post('/user-list', [App\Http\Controllers\admin\UsersController::class, 'list'])->name('admin.users.list');
		Route::get('/user-destroy/{id}', [App\Http\Controllers\admin\UsersController::class, 'destroy'])->name('users.destroy');

		Route::resource('hops', 'App\Http\Controllers\admin\HopsController');
		Route::get('/hop-list', [App\Http\Controllers\admin\HopsController::class, 'index'])->name('admin.hops');
		Route::post('/hop-list', [App\Http\Controllers\admin\HopsController::class, 'list'])->name('admin.hops.list');
		Route::get('/hop-destroy/{id}', [App\Http\Controllers\admin\HopsController::class, 'destroy'])->name('hops.destroy');


		Route::resource('malts', 'App\Http\Controllers\admin\MaltsController');
		Route::get('/malt-list', [App\Http\Controllers\admin\MaltsController::class, 'index'])->name('admin.malts');
		Route::post('/malt-list', [App\Http\Controllers\admin\MaltsController::class, 'list'])->name('admin.malts.list');
		Route::get('/malt-destroy/{id}', [App\Http\Controllers\admin\MaltsController::class, 'destroy'])->name('malts.destroy');


		Route::resource('offers', 'App\Http\Controllers\admin\OffersController');
		Route::get('/offer-list', [App\Http\Controllers\admin\OffersController::class, 'index'])->name('admin.offers');
		Route::post('/offer-list', [App\Http\Controllers\admin\OffersController::class, 'list'])->name('admin.offers.list');
		Route::get('/offer-destroy/{id}', [App\Http\Controllers\admin\OffersController::class, 'destroy'])->name('offers.destroy');
		Route::post('/offer-upload', [App\Http\Controllers\admin\OffersController::class, 'upload'])->name('offers.upload');


		Route::resource('restaurants', 'App\Http\Controllers\admin\RestaurantsController');
		Route::get('/restaurant-list', [App\Http\Controllers\admin\RestaurantsController::class, 'index'])->name('admin.restaurants');
		Route::post('/restaurant-list', [App\Http\Controllers\admin\RestaurantsController::class, 'list'])->name('admin.restaurants.list');
		Route::get('/restaurant-destroy/{id}', [App\Http\Controllers\admin\RestaurantsController::class, 'destroy'])->name('restaurants.destroy');
		Route::post('/restaurant-upload', [App\Http\Controllers\admin\RestaurantsController::class, 'upload'])->name('restaurants.upload');
		Route::post('/restaurant-multiple-upload', [App\Http\Controllers\admin\RestaurantsController::class, 'multiple_upload'])->name('restaurants.multiple_upload');
		Route::post('/restaurant-multiple-delete', [App\Http\Controllers\admin\RestaurantsController::class, 'multiple_upload_delete'])->name('restaurants.multiple_upload_delete');

		Route::resource('categories', 'App\Http\Controllers\admin\CategoriesController');
		Route::get('/category-list', [App\Http\Controllers\admin\CategoriesController::class, 'index'])->name('admin.categories');
		Route::post('/category-list', [App\Http\Controllers\admin\CategoriesController::class, 'list'])->name('admin.categories.list');
		Route::get('/category-destroy/{id}', [App\Http\Controllers\admin\CategoriesController::class, 'destroy'])->name('categories.destroy');

		Route::resource('sub_categories', 'App\Http\Controllers\admin\SubCategoriesController');
		Route::get('/sub-category-list', [App\Http\Controllers\admin\SubCategoriesController::class, 'index'])->name('admin.sub_categories');
		Route::post('/sub-category-list', [App\Http\Controllers\admin\SubCategoriesController::class, 'list'])->name('admin.sub_categories.list');
		Route::get('/sub-category-destroy/{id}', [App\Http\Controllers\admin\SubCategoriesController::class, 'destroy'])->name('sub_categories.destroy');
		Route::post('/sub-category-setSubCategory', [App\Http\Controllers\admin\SubCategoriesController::class, 'setSubCategory'])->name('sub_categories.setSubCategory');

		Route::resource('cproducts', 'App\Http\Controllers\admin\ProductsController');
		Route::get('/product-list', [App\Http\Controllers\admin\ProductsController::class, 'index'])->name('admin.products');
		Route::post('/product-list', [App\Http\Controllers\admin\ProductsController::class, 'list'])->name('admin.products.list');
		Route::get('/product-destroy/{id}', [App\Http\Controllers\admin\ProductsController::class, 'destroy'])->name('cproducts.destroy');
		Route::post('/product-upload', [App\Http\Controllers\admin\ProductsController::class, 'upload'])->name('cproducts.upload');
		Route::post('/product_set_location', [App\Http\Controllers\admin\ProductsController::class, 'product_set_location'])->name('product_set_location');

		Route::resource('locations', 'App\Http\Controllers\admin\LocationsController');
		Route::get('/location-list', [App\Http\Controllers\admin\LocationsController::class, 'index'])->name('admin.locations');
		Route::post('/location-list', [App\Http\Controllers\admin\LocationsController::class, 'list'])->name('admin.locations.list');
		Route::get('/location-destroy/{id}', [App\Http\Controllers\admin\LocationsController::class, 'destroy'])->name('locations.destroy');
		Route::post('/location-upload', [App\Http\Controllers\admin\LocationsController::class, 'upload'])->name('locations.upload');


		Route::resource('passport_pages', 'App\Http\Controllers\admin\PassportPagesController');
		Route::get('/passport-page-list', [App\Http\Controllers\admin\PassportPagesController::class, 'index'])->name('admin.passport_pages');
		Route::post('/passport-page-list', [App\Http\Controllers\admin\PassportPagesController::class, 'list'])->name('admin.passport_pages.list');


		Route::resource('passports', 'App\Http\Controllers\admin\PassportsController');
		Route::get('/passport-list', [App\Http\Controllers\admin\PassportsController::class, 'index'])->name('admin.passports');
		Route::post('/passport-list', [App\Http\Controllers\admin\PassportsController::class, 'list'])->name('admin.passports.list');
		Route::get('/passport-destroy/{id}', [App\Http\Controllers\admin\PassportsController::class, 'destroy'])->name('passports.destroy');
		Route::post('/passport-upload', [App\Http\Controllers\admin\PassportsController::class, 'upload'])->name('passports.upload');


		Route::resource('orders', 'App\Http\Controllers\admin\OrdersController');
		Route::get('/order-list', [App\Http\Controllers\admin\OrdersController::class, 'index'])->name('admin.orders');
		Route::post('/order-list', [App\Http\Controllers\admin\OrdersController::class, 'list'])->name('admin.orders.list');
		Route::get('/order-status/{id}', [App\Http\Controllers\admin\OrdersController::class, 'orderStatus'])->name('admin.orders.orderStatus');
		Route::post('/order-change-status/', [App\Http\Controllers\admin\OrdersController::class, 'changeStatus'])->name('admin.orders.changeStatus');
		Route::post('/order-change-item-status/', [App\Http\Controllers\admin\OrdersController::class, 'changeItemStatus'])->name('admin.orders.changeItemStatus');

		Route::get('/refund-order-list', [App\Http\Controllers\admin\OrdersController::class, 'refund_orders'])->name('admin.refund_orders');
		Route::post('/refund-order-list', [App\Http\Controllers\admin\OrdersController::class, 'refund_orders_list'])->name('admin.refund_orders_list');

		Route::resource('passport_orders', 'App\Http\Controllers\admin\PassportOrdersController');
		Route::get('/passport-order-list', [App\Http\Controllers\admin\PassportOrdersController::class, 'index'])->name('admin.passport_orders');
		Route::post('/passport-order-list', [App\Http\Controllers\admin\PassportOrdersController::class, 'list'])->name('admin.passport_orders.list');


		Route::resource('coupons', 'App\Http\Controllers\admin\CouponsController');
		Route::get('/coupon-list', [App\Http\Controllers\admin\CouponsController::class, 'index'])->name('admin.coupons');
		Route::post('/coupon-list', [App\Http\Controllers\admin\CouponsController::class, 'list'])->name('admin.coupons.list');
		Route::get('/coupon-destroy/{id}', [App\Http\Controllers\admin\CouponsController::class, 'destroy'])->name('coupons.destroy');

		Route::resource('custom_passport_orders', 'App\Http\Controllers\admin\CustomPassportOrdersController');
		Route::get('/custom-passport-order-list', [App\Http\Controllers\admin\CustomPassportOrdersController::class, 'index'])->name('admin.custom_passport_orders');
		Route::post('/custom-passport-order-list', [App\Http\Controllers\admin\CustomPassportOrdersController::class, 'list'])->name('admin.custom_passport_orders.list');
		Route::get('/getPassportVolume1', [App\Http\Controllers\admin\CustomPassportOrdersController::class, 'getPassportVolume1'])->name('admin.custom_passport_orders.getPassportVolume1');
		Route::get('/getUserdetail1', [App\Http\Controllers\admin\CustomPassportOrdersController::class, 'getUserdetail1'])->name('admin.custom_passport_orders.getUserdetail1');

		Route::resource('customorder', 'App\Http\Controllers\admin\CustomOrder');
		Route::get('/customorder-list', [App\Http\Controllers\admin\CustomOrder::class, 'index'])->name('admin.customorders');
		Route::post('/customorder-list', [App\Http\Controllers\admin\CustomOrder::class, 'list'])->name('admin.customorders.list');
		Route::get('/getPassportVolume', [App\Http\Controllers\admin\CustomOrder::class, 'getPassportVolume'])->name('admin.customorders.getPassportVolume');
		Route::get('/getUserdetail', [App\Http\Controllers\admin\CustomOrder::class, 'getUserdetail'])->name('admin.customorders.getUserdetail');


		Route::resource('settings', 'App\Http\Controllers\admin\SettingsController');
		Route::get('setting/general', [App\Http\Controllers\admin\SettingsController::class, 'general'])->name('admin.settings.general');
		Route::post('setting/general_setting', [App\Http\Controllers\admin\SettingsController::class, 'general_setting'])->name('admin.settings.general_setting');
		Route::post('setting/upload_site_logo', [App\Http\Controllers\admin\SettingsController::class, 'upload_site_logo'])->name('admin.settings.upload_site_logo');

		Route::post('setting/update_password', [App\Http\Controllers\admin\SettingsController::class, 'update_password'])->name('admin.settings.update_password');

		Route::resource('attributes', 'App\Http\Controllers\admin\AttributesController');
		Route::get('/attribute-list', [App\Http\Controllers\admin\AttributesController::class, 'index'])->name('admin.attributes');
		Route::post('/attribute-list', [App\Http\Controllers\admin\AttributesController::class, 'list'])->name('admin.attributes.list');
		Route::get('/attribute-destroy/{id}', [App\Http\Controllers\admin\AttributesController::class, 'destroy'])->name('attributes.destroy');
	});
});



Route::group(['prefix' => 'restaurant'], function () {
	Route::group(['middleware' => 'restaurant.guest:restaurant'], function () {
		Route::get('login', [App\Http\Controllers\restaurant\Auth\LoginController::class, 'showLoginForm'])->name('restaurant.login');
		Route::post('login', [App\Http\Controllers\restaurant\Auth\LoginController::class, 'login'])->name('restaurant.login');
	});
	Route::group(['middleware' => 'restaurant.auth'], function () {
		Route::get('/', [App\Http\Controllers\restaurant\RestaurantController::class, 'index'])->name('restaurant.dashboard');
		Route::get('dashboard', [App\Http\Controllers\restaurant\RestaurantController::class, 'index'])->name('restaurant.dashboard');
		Route::post('logout', [App\Http\Controllers\restaurant\Auth\LoginController::class, 'logout'])->name('restaurant.logout');

		Route::resource('r_orders', 'App\Http\Controllers\restaurant\OrdersController');
		Route::get('/r_order-list', [App\Http\Controllers\restaurant\OrdersController::class, 'index'])->name('restaurant.r_orders');
		Route::post('/r_order-list', [App\Http\Controllers\restaurant\OrdersController::class, 'list'])->name('restaurant.r_orders.list');
		Route::post('/order-change-status/', [App\Http\Controllers\restaurant\OrdersController::class, 'changeStatus'])->name('restaurant.orders.changeStatus');
		Route::post('/order-change-item-status/', [App\Http\Controllers\restaurant\OrdersController::class, 'changeItemStatus'])->name('restaurant.orders.changeItemStatus');

		Route::get('/refund-order-list', [App\Http\Controllers\restaurant\OrdersController::class, 'refund_orders'])->name('restaurant.refund_orders');
		Route::post('/refund-order-list', [App\Http\Controllers\restaurant\OrdersController::class, 'refund_orders_list'])->name('restaurant.refund_orders_list');


		Route::resource('products', 'App\Http\Controllers\restaurant\ProductsController');
		Route::get('/product-list', [App\Http\Controllers\restaurant\ProductsController::class, 'index'])->name('restaurant.products');
		Route::post('/product-list', [App\Http\Controllers\restaurant\ProductsController::class, 'list'])->name('restaurant.products.list');
		Route::get('/product-destroy/{id}', [App\Http\Controllers\restaurant\ProductsController::class, 'destroy'])->name('products.destroy');
		Route::post('/product-upload', [App\Http\Controllers\restaurant\ProductsController::class, 'upload'])->name('products.upload');
		Route::post('/product_set_location', [App\Http\Controllers\restaurant\ProductsController::class, 'product_set_location'])->name('product_set_location');

		Route::resource('settings', 'App\Http\Controllers\restaurant\SettingsController');
		Route::get('settings', [App\Http\Controllers\restaurant\SettingsController::class, 'index'])->name('restaurant.settings');
		Route::post('settings/update_password', [App\Http\Controllers\restaurant\SettingsController::class, 'update_password'])->name('restaurant.settings.update_password');
	});
});
