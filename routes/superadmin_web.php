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


Auth::routes();



Route::group(['prefix' => 'superadmin'], function () {
	Route::group(['middleware' => 'superadmin.guest:superadmin'], function () {
		Route::get('login', [App\Http\Controllers\superadmin\Auth\LoginController::class, 'showLoginForm'])->name('superadmin.login');
		Route::post('login', [App\Http\Controllers\superadmin\Auth\LoginController::class, 'login'])->name('superadmin.login');
	});
	Route::group(['middleware' => 'superadmin.auth'], function () {
		Route::get('/', [App\Http\Controllers\superadmin\superadminController::class, 'index'])->name('superadmin.dashboard');
		Route::get('dashboard', [App\Http\Controllers\superadmin\superadminController::class, 'index'])->name('superadmin.dashboard');
		Route::post('list', [App\Http\Controllers\superadmin\superadminController::class, 'list'])->name('superadmin.list');


		Route::resource('settings', 'App\Http\Controllers\superadmin\SettingsController');
		Route::get('settings', [App\Http\Controllers\superadmin\SettingsController::class, 'index'])->name('superadmin.settings');
		Route::post('settings/update_password', [App\Http\Controllers\superadmin\SettingsController::class, 'update_password'])->name('superadmin.settings.update_password');
	});
});
