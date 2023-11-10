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
Route::get('/order-type', [App\Http\Controllers\HomeController::class, 'OrderType'])->name('order.type');
Route::post('/order-type-save', [App\Http\Controllers\HomeController::class, 'OrderTypeSave'])->name('order.type.save');
Route::post('/get-passport-order', [App\Http\Controllers\HomeController::class, 'getpassport'])->name('get.passport.order');
Route::get('/test_home', [App\Http\Controllers\HomeController::class, 'test_home'])->name('test_home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/all-products', [App\Http\Controllers\HomeController::class, 'product'])->name('front.all-products');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
Route::get('/information', [App\Http\Controllers\HomeController::class, 'information'])->name('information');
Route::get('/information_details/{id}', [App\Http\Controllers\HomeController::class, 'information_details'])->name('information_details');
Route::post('/get_products', [App\Http\Controllers\HomeController::class, 'get_products'])->name('get_products');
Route::post('/remenberAmount', [App\Http\Controllers\HomeController::class, 'remenberAmount'])->name('remenberAmount');
// vis-26-07
Route::get('/home-passport-select', [App\Http\Controllers\HomeController::class, 'home_passport_select'])->name('home_passport_select');
Route::post('/showOrderTypePage', [App\Http\Controllers\HomeController::class, 'showOrderTypePage'])->name('showOrderTypePage');
Route::post('/get-selected-passport-order', [App\Http\Controllers\HomeController::class, 'getpassportselected'])->name('get.passportselected.order');
// vis-26-07
Route::post('/showOrderTypeHomePage', [App\Http\Controllers\HomeController::class, 'showOrderTypeHomePage'])->name('showOrderTypeHomePage');
Route::post('/paymentSuccessRedirect', [App\Http\Controllers\HomeController::class, 'paymentSuccessRedirect'])->name('paymentSuccessRedirect');
// vis-28-07
Route::get('/product/{id}/drinks', [App\Http\Controllers\HomeController::class, 'drinksProduct'])->name('drinks_product');
Route::get('/product/{id}/meals', [App\Http\Controllers\HomeController::class, 'mealsProduct'])->name('meals_product');
Route::post('/getFilter', [App\Http\Controllers\HomeController::class, 'getFilter'])->name('getFilter');
// Route::post('/getSearchData', [App\Http\Controllers\HomeController::class, 'getSearchData'])->name('getSearchData');
Route::post('/productView', [App\Http\Controllers\HomeController::class, 'productView'])->name('productView');
Route::post('/changeLocations', [App\Http\Controllers\HomeController::class, 'changeLocations'])->name('changeLocations');
Route::post('/setLocations', [App\Http\Controllers\HomeController::class, 'setLocations'])->name('setLocations');
Route::post('/cloaseLocationsModal', [App\Http\Controllers\HomeController::class, 'cloaseLocationsModal'])->name('cloaseLocationsModal');
Route::post('/ageSubmit', [App\Http\Controllers\HomeController::class, 'ageSubmit'])->name('ageSubmit');
Route::post('/profileView', [App\Http\Controllers\HomeController::class, 'profileViewData'])->name('profileView');
Route::post('/updateUser', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('updateUser');
Route::post('/contact_form', [App\Http\Controllers\HomeController::class, 'contact_form'])->name('contact_form');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/our_services', [App\Http\Controllers\HomeController::class, 'our_services'])->name('our_services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/instagram-feeds', [App\Http\Controllers\HomeController::class, 'instagram_feeds'])->name('instagram_feeds');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/frenchises', [App\Http\Controllers\HomeController::class, 'frenchises_web'])->name('frenchises_web');
Route::get('/frenchises-mobile', [App\Http\Controllers\HomeController::class, 'frenchises_mob'])->name('frenchises_mob');
Route::get('/cron', [App\Http\Controllers\api\CronController::class, 'index'])->name('cron');


Route::get('/get-passport', [App\Http\Controllers\FrontPassportController::class, 'index'])->name('passport.page');
Route::post('/showPassportPage', [App\Http\Controllers\FrontPassportController::class, 'showPassportPage'])->name('showPassportPage');
Route::post('/getPassportView', [App\Http\Controllers\FrontPassportController::class, 'getPassportView'])->name('getPassportView');
Route::post('/passportSubmit', [App\Http\Controllers\FrontPassportController::class, 'passportOrderSubmit'])->name('passportSubmit');
Route::post('/getPassportConfirmView', [App\Http\Controllers\FrontPassportController::class, 'getPassportConfirmView'])->name('getPassportConfirmView');
Route::post('/passportConfirmSubmit', [App\Http\Controllers\FrontPassportController::class, 'passportConfirmSubmit'])->name('passportConfirmSubmit');
Route::post('/getPassportSummaryView', [App\Http\Controllers\FrontPassportController::class, 'getPassportSummaryView'])->name('getPassportSummaryView');
Route::post('/passport_payment_submit', [App\Http\Controllers\FrontPassportController::class, 'payment_submit'])->name('passport.passport_payment_submit');

Route::group(
	['middleware' => 'auth:web'],
	function () {
		Route::get('/my-orders', [App\Http\Controllers\UserController::class, 'get_user_order'])->name('my_orders');
		Route::get('/my-passports', [App\Http\Controllers\UserController::class, 'get_user_passports'])->name('my_passports');
		Route::post('/orderDetails', [App\Http\Controllers\UserController::class, 'get_user_order_details'])->name('orderDetails');
		Route::post('/passportDetails', [App\Http\Controllers\UserController::class, 'get_user_passport_details'])->name('passportDetails');
		Route::post('/profile-update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('profile_update');
		Route::post('/codeView', [App\Http\Controllers\UserController::class, 'codeView'])->name('codeView');
		Route::post('/sendPassportOtp', [App\Http\Controllers\UserController::class, 'sendPassportOtp'])->name('sendPassportOtp');
		Route::post('/passportOtpVerify', [App\Http\Controllers\UserController::class, 'passportOtpVerify'])->name('passportOtpVerify');
		Route::post('/applyCouponCode', [App\Http\Controllers\UserController::class, 'applyCouponCode'])->name('applyCouponCode');
		// vishal code start
		Route::post('/freeProduct', [App\Http\Controllers\UserController::class, 'freeProduct'])->name('freeProduct');
		Route::post('/freeproductView', [App\Http\Controllers\UserController::class, 'freeproductView'])->name('freeproductView');
		Route::post('/freeaddToCart', [App\Http\Controllers\CartController::class, 'freeaddToCart'])->name('freeaddToCart');

		// vishal code end


		Route::post('/showTopUpPage', [App\Http\Controllers\FrontTopupController::class, 'showTopUpPage'])->name('showTopUpPage');
		Route::post('/getTopUpView', [App\Http\Controllers\FrontTopupController::class, 'getTopUpView'])->name('getTopUpView');
		Route::post('/getTopUpViewcustomer', [App\Http\Controllers\FrontTopupController::class, 'getTopUpViewcustomer'])->name('getTopUpViewcustomer');
		Route::post('/topupSubmit', [App\Http\Controllers\FrontTopupController::class, 'topupOrderSubmit'])->name('topupSubmit');
		Route::post('/getTopupConfirmView', [App\Http\Controllers\FrontTopupController::class, 'getTopupConfirmView'])->name('getTopupConfirmView');

		Route::post('/topupConfirmSubmit', [App\Http\Controllers\FrontTopupController::class, 'topupConfirmSubmit'])->name('topupConfirmSubmit');
		Route::post('/getTopupSummaryView', [App\Http\Controllers\FrontTopupController::class, 'getTopupSummaryView'])->name('getTopupSummaryView');
		Route::post('/getpassportlist', [App\Http\Controllers\FrontTopupController::class, 'getpassportlist'])->name('getpassportlist');
		Route::post('/topup_payment_submit', [App\Http\Controllers\FrontTopupController::class, 'payment_submit'])->name('topup.topup_payment_submit');

		Route::post('/addToCart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
		Route::post('/updateCart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('updateCart');
		Route::get('/setCartData', [App\Http\Controllers\CartController::class, 'setCartData'])->name('setCartData');
		Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
		Route::post('/checkout-total-view', [App\Http\Controllers\CartController::class, 'checkout_total_view'])->name('checkout.total.view');
		Route::get('/getCheckoutData', [App\Http\Controllers\CartController::class, 'getCheckoutData'])->name('getCheckoutData');
		Route::post('/removeItem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeItem');
		Route::post('/changeItem', [App\Http\Controllers\CartController::class, 'changeItem'])->name('changeItem');
		Route::post('/cartProcess', [App\Http\Controllers\CartController::class, 'cartProcess'])->name('cartProcess');
		Route::post('/changeCartQuantity', [App\Http\Controllers\CartController::class, 'changeCartQuantity'])->name('changeCartQuantity');
		Route::post('/cart_checkout_view', [App\Http\Controllers\CartController::class, 'cart_checkout_view'])->name('cart_checkout_view');
		Route::post('/payment_submit', [App\Http\Controllers\CartController::class, 'payment_submit'])->name('cart.payment_submit');

		Route::post('/updateQty', [App\Http\Controllers\CartController::class, 'updateQty'])->name('updateQty');
	}
);

Route::post('/showLoginPage', [App\Http\Controllers\Auth\LoginController::class, 'showLoginPage'])->name('showLoginPage');
Route::post('/submitLoginDetails', [App\Http\Controllers\Auth\LoginController::class, 'submitLoginDetails'])->name('submitLoginDetails');
Route::post('/viewOtpPage', [App\Http\Controllers\Auth\LoginController::class, 'viewOtpPage'])->name('viewOtpPage');
Route::post('/viewPinPage', [App\Http\Controllers\Auth\LoginController::class, 'viewPinPage'])->name('viewPinPage');
Route::post('/otpSubmit', [App\Http\Controllers\Auth\LoginController::class, 'otpSubmit'])->name('otpSubmit');
Route::post('/pinSubmit', [App\Http\Controllers\Auth\LoginController::class, 'pinSubmit'])->name('pinSubmit');
Route::post('/resendOtp', [App\Http\Controllers\Auth\LoginController::class, 'resendOtp'])->name('resendOtp');
Route::post('/front/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('front/logout');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
	Route::group(['middleware' => 'admin.guest:admin'], function () {
		Route::get('login', [App\Http\Controllers\admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('login', [App\Http\Controllers\admin\Auth\LoginController::class, 'login'])->name('admin.login');
	});
	Route::resource('admin', 'App\Http\Controllers\admin\AdminController');
	Route::group(['middleware' => 'admin.auth'], function () {
		Route::get('/', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('dashboard', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('search', [App\Http\Controllers\admin\PassportOrdersController::class, 'search'])->name('admin.search');
		Route::post('list', [App\Http\Controllers\admin\AdminController::class, 'list'])->name('admin.list');
		Route::post('logout', [App\Http\Controllers\admin\Auth\LoginController::class, 'logout'])->name('admin.logout');


		Route::resource('banners', 'App\Http\Controllers\admin\BannersController');
		Route::get('/banner-list', [App\Http\Controllers\admin\BannersController::class, 'index'])->name('admin.banners');
		Route::post('/banner-list', [App\Http\Controllers\admin\BannersController::class, 'list'])->name('admin.banners.list');
		Route::get('/banner-destroy/{id}', [App\Http\Controllers\admin\BannersController::class, 'destroy'])->name('banners.destroy');
		Route::post('/banner-upload', [App\Http\Controllers\admin\BannersController::class, 'upload'])->name('banners.upload');

		Route::post('/banner-status', [App\Http\Controllers\admin\BannersController::class, 'status'])->name('admin.banner.status');


		Route::resource('users', 'App\Http\Controllers\admin\UsersController');
		Route::get('/user-list', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('admin.users');
		Route::get('/profile-view/{id}', [App\Http\Controllers\admin\UsersController::class, 'profileView'])->name('admin.profile.view');
		Route::post('/coupon-reddemed', [App\Http\Controllers\admin\UsersController::class, 'get_all_coupons'])->name('admin.get_all_coupons');
		Route::post('/user-orderDetails', [App\Http\Controllers\admin\UsersController::class, 'get_user_order_details'])->name('admin.user.orderDetails');
		Route::post('/user-passportDetails', [App\Http\Controllers\admin\UsersController::class, 'get_user_passport_details'])->name('admin.user.passportDetails');
		Route::post('/coupon-store', [App\Http\Controllers\admin\UsersController::class, 'coupon_store'])->name('admin.coupon.store');
		Route::get('/user-enquiry-list', [App\Http\Controllers\admin\UsersController::class, 'user_enquiry_list'])->name('admin.user_enquiry');
		Route::get('/add-address', [App\Http\Controllers\admin\UsersController::class, 'add_address'])->name('admin.add_address');

		Route::post('/address-store', [App\Http\Controllers\admin\UsersController::class, 'address_store'])->name('admin.address_store');

		Route::post('/address-status', [App\Http\Controllers\admin\UsersController::class, 'status'])->name('admin.address.status');


		Route::get('/reports', [App\Http\Controllers\admin\ReportsController::class, 'index'])->name('admin.reports');
		Route::get('/reports/order-report', [App\Http\Controllers\admin\ReportsController::class, 'totalOrderReports'])->name('admin.reports.totalOrderReports');
		Route::get('/reports/sales-report', [App\Http\Controllers\admin\ReportsController::class, 'totalSalesReports'])->name('admin.reports.totalSalesReports');
		Route::get('/reports/product-report', [App\Http\Controllers\admin\ReportsController::class, 'topProductsReports'])->name('admin.reports.topProductsReports');
		Route::get('/reports/average-order-reports', [App\Http\Controllers\admin\ReportsController::class, 'totalAvrageOrderReports'])->name('admin.reports.totalAvrageOrderReports');
		// vish-8-8-2023
		Route::get('export', [App\Http\Controllers\admin\UsersController::class, 'export'])->name('export');
		// vish-8-8-2023
		Route::get('/reports/rejected-order-reports', [App\Http\Controllers\admin\ReportsController::class, 'totalRejectedReports'])->name('admin.reports.totalRejectedReports');
		Route::get('/reports/repeat-customer-reports', [App\Http\Controllers\admin\ReportsController::class, 'repeatCustomersReports'])->name('admin.reports.repeatCustomersReports');
		Route::get('/reports/abandoned-reports', [App\Http\Controllers\admin\ReportsController::class, 'abandonedOrderReports'])->name('admin.reports.abandonedOrderReports');

		Route::post('/reports/order-report/ajax', [App\Http\Controllers\admin\ReportsController::class, 'totalOrderList'])->name('admin.reports.totalOrderList');
		Route::post('/reports/sales-report/ajax', [App\Http\Controllers\admin\ReportsController::class, 'totalSalesList'])->name('admin.reports.totalSalesList');
		Route::post('/reports/product-report/ajax', [App\Http\Controllers\admin\ReportsController::class, 'topProductList'])->name('admin.reports.topProductList');
		Route::post('/reports/average-order-reports/ajax', [App\Http\Controllers\admin\ReportsController::class, 'averageOrderList'])->name('admin.reports.averageOrderList');
		Route::post('/reports/rejected-order-reports/ajax', [App\Http\Controllers\admin\ReportsController::class, 'totalRejectedOrderList'])->name('admin.reports.totalRejectedOrderList');
		Route::post('/reports/repeat-customer-reports/ajax', [App\Http\Controllers\admin\ReportsController::class, 'repeatCustomerList'])->name('admin.reports.repeatCustomerList');
		Route::post('/reports/abandoned-reports/ajax', [App\Http\Controllers\admin\ReportsController::class, 'abandonedOrderList'])->name('admin.reports.abandonedOrderList');

		Route::get('/reports/order-report/export', [App\Http\Controllers\admin\ReportsController::class, 'totalOrderListExport'])->name('admin.reports.totalOrderListExport');
		Route::post('/reports/order-report/export', [App\Http\Controllers\admin\ReportsController::class, 'totalOrderListExport'])->name('admin.reports.totalOrderListExport');
		Route::get('/reports/sales-report/export', [App\Http\Controllers\admin\ReportsController::class, 'totalSalesListExport'])->name('admin.reports.totalSalesListExport');
		Route::post('/reports/sales-report/export', [App\Http\Controllers\admin\ReportsController::class, 'totalSalesListExport'])->name('admin.reports.totalSalesListExport');
		Route::get('/reports/product-report/export', [App\Http\Controllers\admin\ReportsController::class, 'topProductListExport'])->name('admin.reports.topProductListExport');
		Route::post('/reports/product-report/export', [App\Http\Controllers\admin\ReportsController::class, 'topProductListExport'])->name('admin.reports.topProductListExport');

		Route::get('/reports/average-order-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'averageOrderListExport'])->name('admin.reports.averageOrderListExport');
		Route::post('/reports/average-order-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'averageOrderListExport'])->name('admin.reports.averageOrderListExport');

		Route::get('/reports/rejected-order-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'totalRejectedOrderListExport'])->name('admin.reports.totalRejectedOrderListExport');
		Route::post('/reports/rejected-order-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'totalRejectedOrderListExport'])->name('admin.reports.totalRejectedOrderListExport');
		Route::get('/reports/repeat-customer-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'repeatCustomerListExport'])->name('admin.reports.repeatCustomerListExport');
		Route::post('/reports/repeat-customer-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'repeatCustomerListExport'])->name('admin.reports.repeatCustomerListExport');
		Route::get('/reports/abandoned-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'abandonedOrderListExport'])->name('admin.reports.abandonedOrderListExport');
		Route::post('/reports/abandoned-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'abandonedOrderListExport'])->name('admin.reports.abandonedOrderListExport');




		Route::post('/user_enquiry_ajax_list', [App\Http\Controllers\admin\UsersController::class, 'user_enquiry_ajax_list'])->name('admin.users.user_enquiry_ajax_list');
		Route::post('/view-more', [App\Http\Controllers\admin\UsersController::class, 'viewmore'])->name('admin.users.viewmore');
		Route::post('/user-list', [App\Http\Controllers\admin\UsersController::class, 'list'])->name('admin.users.list');
		Route::get('/user-destroy/{id}', [App\Http\Controllers\admin\UsersController::class, 'destroy'])->name('users.destroy');
		Route::get('/address-destroy/{id}', [App\Http\Controllers\admin\UsersController::class, 'address_destroy'])->name('users.destroy_address');

		Route::resource('hops', 'App\Http\Controllers\admin\HopsController');
		Route::get('/hop-list', [App\Http\Controllers\admin\HopsController::class, 'index'])->name('admin.hops');
		Route::post('/hop-list', [App\Http\Controllers\admin\HopsController::class, 'list'])->name('admin.hops.list');
		Route::get('/hop-destroy/{id}', [App\Http\Controllers\admin\HopsController::class, 'destroy'])->name('hops.destroy');
		Route::post('/hop-status', [App\Http\Controllers\admin\HopsController::class, 'status'])->name('admin.hops.status');


		Route::resource('malts', 'App\Http\Controllers\admin\MaltsController');
		Route::get('/malt-list', [App\Http\Controllers\admin\MaltsController::class, 'index'])->name('admin.malts');
		Route::post('/malt-list', [App\Http\Controllers\admin\MaltsController::class, 'list'])->name('admin.malts.list');
		Route::get('/malt-destroy/{id}', [App\Http\Controllers\admin\MaltsController::class, 'destroy'])->name('malts.destroy');
		Route::post('/malt-status', [App\Http\Controllers\admin\MaltsController::class, 'status'])->name('admin.malts.status');

		Route::resource('offers', 'App\Http\Controllers\admin\OffersController');
		Route::get('/offer-list', [App\Http\Controllers\admin\OffersController::class, 'index'])->name('admin.offers');
		Route::post('/offer-list', [App\Http\Controllers\admin\OffersController::class, 'list'])->name('admin.offers.list');
		Route::get('/offer-destroy/{id}', [App\Http\Controllers\admin\OffersController::class, 'destroy'])->name('offers.destroy');
		Route::post('/offer-upload', [App\Http\Controllers\admin\OffersController::class, 'upload'])->name('offers.upload');
		Route::post('/offer-status', [App\Http\Controllers\admin\OffersController::class, 'status'])->name('admin.offers.status');

		Route::resource('passportFreeItems', 'App\Http\Controllers\admin\PassportFreeItemController');
		Route::get('passportFreeItems/{$id}', [App\Http\Controllers\admin\PassportFreeItemController::class, 'index'])->name('admin.passportFreeItems');
		Route::post('/passportFreeItems-list', [App\Http\Controllers\admin\PassportFreeItemController::class, 'list'])->name('admin.passportFreeItems.list');
		Route::post('/passportFreeItems-create', [App\Http\Controllers\admin\PassportFreeItemController::class, 'create'])->name('admin.passportFreeItems.create');
		Route::post('/passportFreeItems-store', [App\Http\Controllers\admin\PassportFreeItemController::class, 'store'])->name('admin.passportFreeItems.store');
		Route::get('/passportFreeItems-destroy/{id}', [App\Http\Controllers\admin\PassportFreeItemController::class, 'destroy'])->name('passportFreeItems.destroy');
		Route::get('/passportFreeItems-edit/{id}', [App\Http\Controllers\admin\PassportFreeItemController::class, 'edit'])->name('passportFreeItems.edit');


		Route::resource('restaurants', 'App\Http\Controllers\admin\RestaurantsController');
		Route::get('/restaurant-list', [App\Http\Controllers\admin\RestaurantsController::class, 'index'])->name('admin.restaurants');

		Route::post('/restaurant-list', [App\Http\Controllers\admin\RestaurantsController::class, 'list'])->name('admin.restaurants.list');
		Route::get('/restaurant-destroy/{id}', [App\Http\Controllers\admin\RestaurantsController::class, 'destroy'])->name('restaurants.destroy');
		Route::post('/restaurant-upload', [App\Http\Controllers\admin\RestaurantsController::class, 'upload'])->name('restaurants.upload');
		Route::post('/restaurant-upload-logo', [App\Http\Controllers\admin\RestaurantsController::class, 'upload_logo'])->name('restaurants.upload_logo');
		Route::post('/restaurant-multiple-upload', [App\Http\Controllers\admin\RestaurantsController::class, 'multiple_upload'])->name('restaurants.multiple_upload');
		Route::post('/restaurant-multiple-delete', [App\Http\Controllers\admin\RestaurantsController::class, 'multiple_upload_delete'])->name('restaurants.multiple_upload_delete');

		Route::post('/restaurants-status', [App\Http\Controllers\admin\RestaurantsController::class, 'status'])->name('admin.restaurants.status');

		Route::resource('categories', 'App\Http\Controllers\admin\CategoriesController');
		Route::get('/category-list', [App\Http\Controllers\admin\CategoriesController::class, 'index'])->name('admin.categories');
		Route::post('/category-list', [App\Http\Controllers\admin\CategoriesController::class, 'list'])->name('admin.categories.list');
		Route::get('/category-destroy/{id}', [App\Http\Controllers\admin\CategoriesController::class, 'destroy'])->name('categories.destroy');
		Route::post('/category-status', [App\Http\Controllers\admin\CategoriesController::class, 'status'])->name('admin.categories.status');


		Route::resource('sub_categories', 'App\Http\Controllers\admin\SubCategoriesController');
		Route::get('/sub-category-list', [App\Http\Controllers\admin\SubCategoriesController::class, 'index'])->name('admin.sub_categories');
		Route::post('/sub-category-list', [App\Http\Controllers\admin\SubCategoriesController::class, 'list'])->name('admin.sub_categories.list');
		Route::get('/sub-category-destroy/{id}', [App\Http\Controllers\admin\SubCategoriesController::class, 'destroy'])->name('sub_categories.destroy');
		Route::post('/sub-category-setSubCategory', [App\Http\Controllers\admin\SubCategoriesController::class, 'setSubCategory'])->name('sub_categories.setSubCategory');


		Route::post('/sub-categories-status', [App\Http\Controllers\admin\UsersController::class, 'status'])->name('admin.sub_categories.status');

		Route::resource('cproducts', 'App\Http\Controllers\admin\ProductsController');
		Route::get('/product-list', [App\Http\Controllers\admin\ProductsController::class, 'index'])->name('admin.products');
		Route::post('/product-list', [App\Http\Controllers\admin\ProductsController::class, 'list'])->name('admin.products.list');
		Route::get('/product-destroy/{id}', [App\Http\Controllers\admin\ProductsController::class, 'destroy'])->name('cproducts.destroy');
		Route::post('/product-upload', [App\Http\Controllers\admin\ProductsController::class, 'upload'])->name('cproducts.upload');
		Route::post('/product_set_location', [App\Http\Controllers\admin\ProductsController::class, 'product_set_location'])->name('product_set_location');
		Route::post('/product_duplicate', [App\Http\Controllers\admin\ProductsController::class, 'product_duplicate'])->name('product_duplicate');

		Route::get('/free-product-list', [App\Http\Controllers\admin\ProductsController::class, 'FreeProduct'])->name('admin.free_products');
		Route::post('/free-product-list', [App\Http\Controllers\admin\ProductsController::class, 'freeProductList'])->name('admin.freeproducts.list');
		Route::get('/free-product-create', [App\Http\Controllers\admin\ProductsController::class, 'createfreeProduct'])->name('cproducts.createfreeproduct');
		Route::post('/cproducts-status', [App\Http\Controllers\admin\ProductsController::class, 'status'])->name('admin.cproducts.status');
		Route::post('/free-product-status', [App\Http\Controllers\admin\ProductsController::class, 'status'])->name('admin.freeproducts.status');


		Route::resource('locations', 'App\Http\Controllers\admin\LocationsController');
		Route::get('/location-list', [App\Http\Controllers\admin\LocationsController::class, 'index'])->name('admin.locations');
		Route::post('/location-list', [App\Http\Controllers\admin\LocationsController::class, 'list'])->name('admin.locations.list');
		Route::get('/location-destroy/{id}', [App\Http\Controllers\admin\LocationsController::class, 'destroy'])->name('locations.destroy');
		Route::post('/location-upload', [App\Http\Controllers\admin\LocationsController::class, 'upload'])->name('locations.upload');
		Route::post('/location-upload-logo', [App\Http\Controllers\admin\LocationsController::class, 'upload_logo'])->name('locations.upload_logo');
		Route::post('/location-status', [App\Http\Controllers\admin\LocationsController::class, 'status'])->name('admin.locations.status');

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

		// passport confirm

		Route::resource('passport-confirm-data', 'App\Http\Controllers\admin\PassportConfirm');
		Route::get('/passport-confirm-list', [App\Http\Controllers\admin\PassportConfirm::class, 'index'])->name('admin.passport_confirm');
		Route::post('/passport-confirm-list', [App\Http\Controllers\admin\PassportConfirm::class, 'list'])->name('admin.passport_confirm.list');
		Route::get('/passport-list-status/{id}', [App\Http\Controllers\admin\PassportConfirm::class, 'orderStatus'])->name('admin.passport_confirm.orderStatus');
		Route::post('/passport-list-change-status/', [App\Http\Controllers\admin\PassportConfirm::class, 'changeStatus'])->name('admin.passport_confirm.changeStatus');
		Route::post('/passport-list-change-item-status/', [App\Http\Controllers\admin\PassportConfirm::class, 'changeItemStatus'])->name('passport_confirm.orders.changeItemStatus');

		// passport confirm


		Route::resource('coupons', 'App\Http\Controllers\admin\CouponsController');
		Route::get('/coupon-list', [App\Http\Controllers\admin\CouponsController::class, 'index'])->name('admin.coupons');
		Route::post('/coupon-list', [App\Http\Controllers\admin\CouponsController::class, 'list'])->name('admin.coupons.list');
		Route::get('/coupon-destroy/{id}', [App\Http\Controllers\admin\CouponsController::class, 'destroy'])->name('coupons.destroy');
		Route::post('/coupon-status', [App\Http\Controllers\admin\CouponsController::class, 'status'])->name('admin.coupons.status');
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
		Route::post('setting/upload_site_sound', [App\Http\Controllers\admin\SettingsController::class, 'upload_site_sound'])->name('admin.settings.upload_bell_sound');

		Route::post('setting/update_password', [App\Http\Controllers\admin\SettingsController::class, 'update_password'])->name('admin.settings.update_password');

		Route::resource('attributes', 'App\Http\Controllers\admin\AttributesController');
		Route::get('/attribute-list', [App\Http\Controllers\admin\AttributesController::class, 'index'])->name('admin.attributes');
		Route::post('/attribute-list', [App\Http\Controllers\admin\AttributesController::class, 'list'])->name('admin.attributes.list');
		Route::get('/attribute-destroy/{id}', [App\Http\Controllers\admin\AttributesController::class, 'destroy'])->name('attributes.destroy');
		Route::post('/attribute-status', [App\Http\Controllers\admin\AttributesController::class, 'status'])->name('admin.attributes.status');
	});
});



Route::group(['prefix' => 'restaurant'], function () {
	Route::group(['middleware' => 'restaurant.guest:restaurant'], function () {
		Route::get('login', [App\Http\Controllers\restaurant\Auth\LoginController::class, 'showLoginForm'])->name('restaurant.login');
		Route::post('login', [App\Http\Controllers\restaurant\Auth\LoginController::class, 'login'])->name('restaurant.login');
	});
	Route::group(['middleware' => 'restaurant.auth'], function () {

		Route::get('/', [App\Http\Controllers\restaurant\RestaurantController::class, 'index'])->name('restaurant.dashboard');

		Route::get('/restaurant-order', [App\Http\Controllers\restaurant\RestaurantController::class, 'addOrder'])->name('restaurant.add.order');

		Route::post('/order-restaurant', [App\Http\Controllers\restaurant\RestaurantController::class, 'orderSave'])->name('restaurant.order.save');

		Route::post('/passport-code-user', [App\Http\Controllers\restaurant\RestaurantController::class, 'passportCodeUser'])->name('restaurant.passport.code');
		Route::post('/get-passport-item', [App\Http\Controllers\restaurant\RestaurantController::class, 'getPassportItem'])->name('get.passport.item');

		Route::post('/save-product-order', [App\Http\Controllers\restaurant\RestaurantController::class, 'saveProductOrder'])->name('save.product.order');
		// vishal code 21-07-2023 start
		Route::post('/free-product', [App\Http\Controllers\restaurant\RestaurantController::class, 'getFreeItem'])->name('restaurant.free.order');
		Route::post('/order.free-restaurant', [App\Http\Controllers\restaurant\RestaurantController::class, 'orderFreeSave'])->name('restaurant.free.order.save');
		// vishal code 21-07-2023 end
		Route::get('dashboard', [App\Http\Controllers\restaurant\RestaurantController::class, 'index'])->name('restaurant.dashboard');
		Route::get('restaurant-search', [App\Http\Controllers\restaurant\PassportOrdersController::class, 'index'])->name('restaurant.search');
		Route::post('list', [App\Http\Controllers\restaurant\RestaurantController::class, 'list'])->name('restaurant.list');
		Route::post('getorder', [App\Http\Controllers\restaurant\RestaurantController::class, 'getorder'])->name('restaurant.getorder');

		Route::post('/order-dinning-status/', [App\Http\Controllers\restaurant\RestaurantController::class, 'dinningStatus'])->name('restaurant.dinning.changeStatus');

		Route::post('getDashboredOrders', [App\Http\Controllers\restaurant\RestaurantController::class, 'getDashboredOrders'])->name('restaurant.getDashboredOrders');
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
		Route::post('/product-setSubCategory', [App\Http\Controllers\restaurant\ProductsController::class, 'setSubCategory'])->name('product.setSubCategory');

		Route::resource('settings', 'App\Http\Controllers\restaurant\SettingsController');
		Route::get('settings', [App\Http\Controllers\restaurant\SettingsController::class, 'index'])->name('restaurant.settings');
		Route::post('settings/update_password', [App\Http\Controllers\restaurant\SettingsController::class, 'update_password'])->name('restaurant.settings.update_password');
	});
});


// superadmin 


// Route::group(['prefix' => 'superadmin'], function () {
// 	Route::group(['middleware' => 'superadmin.guest:superadmin'], function () {
// 		Route::get('login', [App\Http\Controllers\superadmin\Auth\LoginController::class, 'showLoginForm'])->name('superadmin.login');
// 		Route::post('login', [App\Http\Controllers\superadmin\Auth\LoginController::class, 'login'])->name('superadmin.login');
// 	});
// 	Route::resource('superadmin', 'App\Http\Controllers\superadmin\SuperadminController');
// 	Route::group(['middleware' => 'superadmin.auth'], function () {
// 		Route::get('/', [App\Http\Controllers\superadmin\SuperadminController::class, 'index'])->name('superadmin.dashboard');
// 		Route::get('dashboard', [App\Http\Controllers\superadmin\SuperadminController::class, 'index'])->name('superadmin.dashboard');
// 		Route::post('list', [App\Http\Controllers\superadmin\SuperadminController::class, 'list'])->name('superadmin.list');
// 		Route::post('logout', [App\Http\Controllers\superadmin\Auth\LoginController::class, 'logout'])->name('superadmin.logout');

// 		// superadmin banner

// 		Route::resource('bannersdata', 'App\Http\Controllers\superadmin\BannersController');
// 		Route::get('/superbanner-list', [App\Http\Controllers\superadmin\BannersController::class, 'index'])->name('superadmin.banners');
// 		Route::post('/superbanner-list', [App\Http\Controllers\superadmin\BannersController::class, 'list'])->name('superadmin.banners.list');
// 		Route::get('/superbanner-destroy/{id}', [App\Http\Controllers\superadmin\BannersController::class, 'destroy'])->name('bannersdata.destroy');
// 		Route::post('/superbanner-upload', [App\Http\Controllers\superadmin\BannersController::class, 'upload'])->name('bannersdata.upload');

// 		// superadmin User

// 		Route::resource('usersdata', 'App\Http\Controllers\superadmin\UsersController');
// 		Route::get('/user-list', [App\Http\Controllers\superadmin\UsersController::class, 'index'])->name('superadmin.users');
// 		Route::post('/user-list', [App\Http\Controllers\superadmin\UsersController::class, 'list'])->name('superadmin.users.list');
// 		Route::get('/super-admin-profile-view/{id}', [App\Http\Controllers\superadmin\UsersController::class, 'profileView'])->name('superadmin.profile.view');
// 		Route::post('/super-admin-coupon-reddemed', [App\Http\Controllers\superadmin\UsersController::class, 'get_all_coupons'])->name('superadmin.get_all_coupons');
// 		Route::post('/super-admin-user-orderDetails', [App\Http\Controllers\superadmin\UsersController::class, 'get_user_order_details'])->name('superadmin.user.orderDetails');
// 		Route::post('/super-admin-user-passportDetails', [App\Http\Controllers\superadmin\UsersController::class, 'get_user_passport_details'])->name('superadmin.user.passportDetails');
// 		Route::post('/super-admin-coupon-store', [App\Http\Controllers\superadmin\UsersController::class, 'coupon_store'])->name('superadmin.coupon.store');
// 		Route::get('/super-admin-user-enquiry-list', [App\Http\Controllers\superadmin\UsersController::class, 'user_enquiry_list'])->name('superadmin.user_enquiry');
// 		Route::get('/user-destroy/{id}', [App\Http\Controllers\superadmin\UsersController::class, 'destroy'])->name('usersdata.destroy');
// 		Route::post('/user_enquiry_ajax_list', [App\Http\Controllers\superadmin\UsersController::class, 'user_enquiry_ajax_list'])->name('superadmin.users.user_enquiry_ajax_list');
// 		Route::post('/view-more', [App\Http\Controllers\admin\UsersController::class, 'viewmore'])->name('superadmin.users.viewmore');


// 		// superadmin cupons 

// 		Route::resource('couponsData', 'App\Http\Controllers\superadmin\CouponsController');
// 		Route::get('/coupon-list', [App\Http\Controllers\superadmin\CouponsController::class, 'index'])->name('superadmin.coupons');
// 		Route::post('/coupon-list', [App\Http\Controllers\superadmin\CouponsController::class, 'list'])->name('superadmin.coupons.list');
// 		Route::get('/coupon-destroy/{id}', [App\Http\Controllers\superadmin\CouponsController::class, 'destroy'])->name('couponsData.destroy');

// 		// superadmin offers
// 		Route::resource('offersData', 'App\Http\Controllers\superadmin\OffersController');
// 		Route::get('/offer-list', [App\Http\Controllers\superadmin\OffersController::class, 'index'])->name('superadmin.offers');
// 		Route::post('/offer-list', [App\Http\Controllers\superadmin\OffersController::class, 'list'])->name('superadmin.offers.list');
// 		Route::get('/offer-destroy/{id}', [App\Http\Controllers\superadmin\OffersController::class, 'destroy'])->name('offersData.destroy');
// 		Route::post('/offer-upload', [App\Http\Controllers\superadmin\OffersController::class, 'upload'])->name('offers.upload');

// 		// superadmin location


// 		Route::resource('locationsData', 'App\Http\Controllers\superadmin\LocationsController');
// 		Route::get('/location-list', [App\Http\Controllers\superadmin\LocationsController::class, 'index'])->name('superadmin.locations');
// 		Route::post('/location-list', [App\Http\Controllers\superadmin\LocationsController::class, 'list'])->name('superadmin.locations.list');
// 		Route::get('/location-destroy/{id}', [App\Http\Controllers\superadmin\LocationsController::class, 'destroy'])->name('locationsData.destroy');
// 		Route::post('/location-upload', [App\Http\Controllers\superadmin\LocationsController::class, 'upload'])->name('locationsData.upload');


// 		// superadmin restaurant

// 		Route::resource('restaurantsData', 'App\Http\Controllers\superadmin\RestaurantsController');
// 		Route::get('/restaurant-list', [App\Http\Controllers\superadmin\RestaurantsController::class, 'index'])->name('superadmin.restaurants');

// 		Route::post('/restaurant-list', [App\Http\Controllers\superadmin\RestaurantsController::class, 'list'])->name('superadmin.restaurants.list');
// 		Route::get('/restaurant-destroy/{id}', [App\Http\Controllers\superadmin\RestaurantsController::class, 'destroy'])->name('restaurantsData.destroy');
// 		Route::post('/restaurant-upload', [App\Http\Controllers\superadmin\RestaurantsController::class, 'upload'])->name('restaurantsData.upload');
// 		Route::post('/restaurant-multiple-upload', [App\Http\Controllers\superadmin\RestaurantsController::class, 'multiple_upload'])->name('restaurants.multiple_upload');
// 		Route::post('/restaurant-multiple-delete', [App\Http\Controllers\superadmin\RestaurantsController::class, 'multiple_upload_delete'])->name('restaurants.multiple_upload_delete');

// 		// Superadmin attributes 

// 		Route::resource('attributesData', 'App\Http\Controllers\superadmin\AttributesController');
// 		Route::get('/attribute-list', [App\Http\Controllers\superadmin\AttributesController::class, 'index'])->name('superadmin.attributes');
// 		Route::post('/attribute-list', [App\Http\Controllers\superadmin\AttributesController::class, 'list'])->name('superadmin.attributes.list');
// 		Route::get('/attribute-destroy/{id}', [App\Http\Controllers\superadmin\AttributesController::class, 'destroy'])->name('attributesData.destroy');

// 		// superadmin hops

// 		Route::resource('hopsData', 'App\Http\Controllers\superadmin\HopsController');
// 		Route::get('/hop-list', [App\Http\Controllers\superadmin\HopsController::class, 'index'])->name('superadmin.hops');
// 		Route::post('/hop-list', [App\Http\Controllers\superadmin\HopsController::class, 'list'])->name('superadmin.hops.list');
// 		Route::get('/hop-destroy/{id}', [App\Http\Controllers\superadmin\HopsController::class, 'destroy'])->name('hopsData.destroy');

// 		// superadmin malts

// 		Route::resource('maltsData', 'App\Http\Controllers\superadmin\MaltsController');
// 		Route::get('/malt-list', [App\Http\Controllers\superadmin\MaltsController::class, 'index'])->name('superadmin.malts');
// 		Route::post('/malt-list', [App\Http\Controllers\superadmin\MaltsController::class, 'list'])->name('superadmin.malts.list');
// 		Route::get('/malt-destroy/{id}', [App\Http\Controllers\superadmin\MaltsController::class, 'destroy'])->name('maltsData.destroy');

// 		// superadmin categories

// 		Route::resource('categoriesData', 'App\Http\Controllers\superadmin\CategoriesController');
// 		Route::get('/category-list', [App\Http\Controllers\superadmin\CategoriesController::class, 'index'])->name('superadmin.categories');
// 		Route::post('/category-list', [App\Http\Controllers\superadmin\CategoriesController::class, 'list'])->name('superadmin.categories.list');
// 		Route::get('/category-destroy/{id}', [App\Http\Controllers\superadmin\CategoriesController::class, 'destroy'])->name('categoriesData.destroy');

// 		// superadmin sub categories

// 		Route::resource('sub_categoriesData', 'App\Http\Controllers\superadmin\SubCategoriesController');
// 		Route::get('/sub-category-list', [App\Http\Controllers\superadmin\SubCategoriesController::class, 'index'])->name('superadmin.sub_categories');
// 		Route::post('/sub-category-list', [App\Http\Controllers\superadmin\SubCategoriesController::class, 'list'])->name('superadmin.sub_categories.list');
// 		Route::get('/sub-category-destroy/{id}', [App\Http\Controllers\superadmin\SubCategoriesController::class, 'destroy'])->name('sub_categoriesData.destroy');
// 		Route::post('/sub-category-setSubCategory', [App\Http\Controllers\superadmin\SubCategoriesController::class, 'setSubCategory'])->name('sub_categories.setSubCategory');

// 		// superadmin products

// 		Route::resource('cproductsData', 'App\Http\Controllers\superadmin\ProductsController');
// 		Route::get('/product-list', [App\Http\Controllers\superadmin\ProductsController::class, 'index'])->name('superadmin.products');
// 		Route::post('/product-list', [App\Http\Controllers\superadmin\ProductsController::class, 'list'])->name('superadmin.products.list');
// 		Route::get('/product-destroy/{id}', [App\Http\Controllers\superadmin\ProductsController::class, 'destroy'])->name('cproductsData.destroy');
// 		Route::post('/product-upload', [App\Http\Controllers\superadmin\ProductsController::class, 'upload'])->name('cproducts.upload');
// 		Route::post('/product_set_location', [App\Http\Controllers\superadmin\ProductsController::class, 'product_set_location'])->name('product_set_location');
// 		Route::post('/product_duplicate', [App\Http\Controllers\superadmin\ProductsController::class, 'product_duplicate'])->name('product_duplicate');


// 		// superadmin password

// 		Route::resource('passportsData', 'App\Http\Controllers\superadmin\PassportsController');
// 		Route::get('/passport-list', [App\Http\Controllers\superadmin\PassportsController::class, 'index'])->name('superadmin.passports');
// 		Route::post('/passport-list', [App\Http\Controllers\superadmin\PassportsController::class, 'list'])->name('superadmin.passports.list');
// 		Route::get('/passport-destroy/{id}', [App\Http\Controllers\superadmin\PassportsController::class, 'destroy'])->name('passportsData.destroy');
// 		Route::post('/passport-upload', [App\Http\Controllers\superadmin\PassportsController::class, 'upload'])->name('passports.upload');

// 		//superadmin passport pages

// 		Route::resource('passport_pagesData', 'App\Http\Controllers\superadmin\PassportPagesController');
// 		Route::get('/passport-page-list', [App\Http\Controllers\superadmin\PassportPagesController::class, 'index'])->name('superadmin.passport_pages');
// 		Route::post('/passport-page-list', [App\Http\Controllers\superadmin\PassportPagesController::class, 'list'])->name('superadmin.passport_pages.list');



// 		//superadmin passport confirm

// 		Route::resource('passport-confirm-data', 'App\Http\Controllers\superadmin\PassportConfirm');
// 		Route::get('/passport-confirm-list', [App\Http\Controllers\superadmin\PassportConfirm::class, 'index'])->name('superadmin.passport_confirm');
// 		Route::post('/passport-confirm-list', [App\Http\Controllers\superadmin\PassportConfirm::class, 'list'])->name('superadmin.passport_confirm.list');
// 		Route::get('/passport-list-status/{id}', [App\Http\Controllers\superadmin\PassportConfirm::class, 'orderStatus'])->name('superadmin.passport_confirm.orderStatus');
// 		Route::post('/passport-list-change-status/', [App\Http\Controllers\superadmin\PassportConfirm::class, 'changeStatus'])->name('superadmin.passport_confirm.changeStatus');
// 		Route::post('/passport-list-change-item-status/', [App\Http\Controllers\superadmin\PassportConfirm::class, 'changeItemStatus'])->name('passport_confirm.orders.changeItemStatus');

// 		//superadmin orders


// 		Route::resource('ordersData', 'App\Http\Controllers\superadmin\OrdersController');
// 		Route::get('/order-list', [App\Http\Controllers\superadmin\OrdersController::class, 'index'])->name('superadmin.orders');
// 		Route::post('/order-list', [App\Http\Controllers\superadmin\OrdersController::class, 'list'])->name('superadmin.orders.list');
// 		Route::get('/order-status/{id}', [App\Http\Controllers\superadmin\OrdersController::class, 'orderStatus'])->name('superadmin.ordersData.orderStatus');
// 		Route::post('/order-change-status/', [App\Http\Controllers\superadmin\OrdersController::class, 'changeStatus'])->name('superadmin.ordersData.changeStatus');
// 		Route::post('/order-change-item-status/', [App\Http\Controllers\superadmin\OrdersController::class, 'changeItemStatus'])->name('superadmin.ordersData.changeItemStatus');

// 		Route::get('/refund-order-list', [App\Http\Controllers\superadmin\OrdersController::class, 'refund_orders'])->name('superadmin.refund_orders');
// 		Route::post('/refund-order-list', [App\Http\Controllers\superadmin\OrdersController::class, 'refund_orders_list'])->name('superadmin.refund_orders_list');

// 		Route::resource('passport_ordersData', 'App\Http\Controllers\superadmin\PassportOrdersController');
// 		Route::get('/passport-order-list', [App\Http\Controllers\superadmin\PassportOrdersController::class, 'index'])->name('superadmin.passport_orders');
// 		Route::post('/passport-order-list', [App\Http\Controllers\superadmin\PassportOrdersController::class, 'list'])->name('superadmin.passport_orders.list');

// 		Route::resource('custom_passport_ordersData', 'App\Http\Controllers\superadmin\CustomPassportOrdersController');
// 		Route::get('/custom-passport-order-list', [App\Http\Controllers\superadmin\CustomPassportOrdersController::class, 'index'])->name('superadmin.custom_passport_orders');
// 		Route::post('/custom-passport-order-list', [App\Http\Controllers\superadmin\CustomPassportOrdersController::class, 'list'])->name('superadmin.custom_passport_orders.list');
// 		Route::get('/getPassportVolume1', [App\Http\Controllers\superadmin\CustomPassportOrdersController::class, 'getPassportVolume1'])->name('superadmin.custom_passport_orders.getPassportVolume1');
// 		Route::get('/getUserdetail1', [App\Http\Controllers\superadmin\CustomPassportOrdersController::class, 'getUserdetail1'])->name('superadmin.custom_passport_orders.getUserdetail1');


// 		Route::resource('customorderData', 'App\Http\Controllers\superadmin\CustomOrder');
// 		Route::get('/customorder-list', [App\Http\Controllers\superadmin\CustomOrder::class, 'index'])->name('superadmin.customorders');
// 		Route::post('/customorder-list', [App\Http\Controllers\superadmin\CustomOrder::class, 'list'])->name('superadmin.customorders.list');
// 		Route::get('/getPassportVolume', [App\Http\Controllers\superadmin\CustomOrder::class, 'getPassportVolume'])->name('superadmin.customorders.getPassportVolume');
// 		Route::get('/getUserdetail', [App\Http\Controllers\superadmin\CustomOrder::class, 'getUserdetail'])->name('superadmin.customorders.getUserdetail');




// 		Route::get('/reports', [App\Http\Controllers\superadmin\ReportsController::class, 'index'])->name('superadmin.reports');
// 		Route::get('/reports/order-report', [App\Http\Controllers\superadmin\ReportsController::class, 'totalOrderReports'])->name('superadmin.reports.totalOrderReports');
// 		Route::get('/reports/sales-report', [App\Http\Controllers\superadmin\ReportsController::class, 'totalSalesReports'])->name('superadmin.reports.totalSalesReports');
// 		Route::get('/reports/product-report', [App\Http\Controllers\superadmin\ReportsController::class, 'topProductsReports'])->name('superadmin.reports.topProductsReports');
// 		Route::get('/reports/average-order-reports', [App\Http\Controllers\superadmin\ReportsController::class, 'totalAvrageOrderReports'])->name('superadmin.reports.totalAvrageOrderReports');
// 		Route::get('/reports/rejected-order-reports', [App\Http\Controllers\superadmin\ReportsController::class, 'totalRejectedReports'])->name('superadmin.reports.totalRejectedReports');
// 		Route::get('/reports/repeat-customer-reports', [App\Http\Controllers\superadmin\ReportsController::class, 'repeatCustomersReports'])->name('superadmin.reports.repeatCustomersReports');
// 		Route::get('/reports/abandoned-reports', [App\Http\Controllers\superadmin\ReportsController::class, 'abandonedOrderReports'])->name('superadmin.reports.abandonedOrderReports');

// 		Route::post('/reports/order-report/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'totalOrderList'])->name('superadmin.reports.totalOrderList');
// 		Route::post('/reports/sales-report/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'totalSalesList'])->name('superadmin.reports.totalSalesList');
// 		Route::post('/reports/product-report/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'topProductList'])->name('superadmin.reports.topProductList');
// 		Route::post('/reports/average-order-reports/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'averageOrderList'])->name('superadmin.reports.averageOrderList');
// 		Route::post('/reports/rejected-order-reports/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'totalRejectedOrderList'])->name('superadmin.reports.totalRejectedOrderList');
// 		Route::post('/reports/repeat-customer-reports/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'repeatCustomerList'])->name('superadmin.reports.repeatCustomerList');
// 		Route::post('/reports/abandoned-reports/ajax', [App\Http\Controllers\superadmin\ReportsController::class, 'abandonedOrderList'])->name('superadmin.reports.abandonedOrderList');

// 		Route::get('/reports/order-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'totalOrderListExport'])->name('superadmin.reports.totalOrderListExport');
// 		Route::post('/reports/order-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'totalOrderListExport'])->name('superadmin.reports.totalOrderListExport');
// 		Route::get('/reports/sales-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'totalSalesListExport'])->name('superadmin.reports.totalSalesListExport');
// 		Route::post('/reports/sales-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'totalSalesListExport'])->name('superadmin.reports.totalSalesListExport');
// 		Route::get('/reports/product-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'topProductListExport'])->name('superadmin.reports.topProductListExport');
// 		Route::post('/reports/product-report/export', [App\Http\Controllers\superadmin\ReportsController::class, 'topProductListExport'])->name('superadmin.reports.topProductListExport');

// 		Route::get('/reports/average-order-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'averageOrderListExport'])->name('superadmin.reports.averageOrderListExport');
// 		Route::post('/reports/average-order-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'averageOrderListExport'])->name('superadmin.reports.averageOrderListExport');

// 		Route::get('/reports/rejected-order-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'totalRejectedOrderListExport'])->name('superadmin.reports.totalRejectedOrderListExport');
// 		Route::post('/reports/rejected-order-reports/export', [App\Http\Controllers\admin\ReportsController::class, 'totalRejectedOrderListExport'])->name('superadmin.reports.totalRejectedOrderListExport');
// 		Route::get('/reports/repeat-customer-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'repeatCustomerListExport'])->name('superadmin.reports.repeatCustomerListExport');
// 		Route::post('/reports/repeat-customer-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'repeatCustomerListExport'])->name('superadmin.reports.repeatCustomerListExport');
// 		Route::get('/reports/abandoned-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'abandonedOrderListExport'])->name('superadmin.reports.abandonedOrderListExport');
// 		Route::post('/reports/abandoned-reports/export', [App\Http\Controllers\superadmin\ReportsController::class, 'abandonedOrderListExport'])->name('admsuperadminin.reports.abandonedOrderListExport');


// 		Route::resource('settingsData', 'App\Http\Controllers\superadmin\SettingsController');
// 		Route::get('setting/general', [App\Http\Controllers\superadmin\SettingsController::class, 'general'])->name('superadmin.settings.general');
// 		Route::post('setting/general_setting', [App\Http\Controllers\superadmin\SettingsController::class, 'general_setting'])->name('superadmin.settings.general_setting');
// 		Route::post('setting/upload_site_logo', [App\Http\Controllers\superadmin\SettingsController::class, 'upload_site_logo'])->name('superadmin.settings.upload_site_logo');
// 		Route::post('setting/upload_site_sound', [App\Http\Controllers\superadmin\SettingsController::class, 'upload_site_sound'])->name('superadmin.settings.upload_bell_sound');

// 		Route::post('setting/update_password', [App\Http\Controllers\superadmin\SettingsController::class, 'update_password'])->name('superadmin.settings.update_password');



// 		// superadmin admin


// 		Route::resource('adminsData', 'App\Http\Controllers\superadmin\AdminController');
// 		Route::get('/superadmin-list', [App\Http\Controllers\superadmin\AdminController::class, 'index'])->name('superadmin.admins');
// 		Route::post('/superadmin-list', [App\Http\Controllers\superadmin\AdminController::class, 'list'])->name('superadmin.admins.list');
// 		Route::get('/superadmin-destroy/{id}', [App\Http\Controllers\superadmin\AdminController::class, 'destroy'])->name('adminsData.destroy');
// 	});
// });
