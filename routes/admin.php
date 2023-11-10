<?php
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\Auth\LoginController;
use App\Http\Controllers\admin\UsersController;
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

Route::group(['prefix'=>'admin'],function(){
	Route::group(['middleware'=>'admin.guest:admin'],function(){ 
		Route::get('login',[LoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('login',[LoginController::class, 'login'])->name('admin.login');
	});
	Route::group(['middleware'=>'admin.auth'],function(){  
		Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
		Route::post('logout',[LoginController::class, 'logout'])->name('admin.logout');
		

			Route::resource('users', 'UsersController');
			Route::get('/',[UsersController::class, 'index'])->name('admin.users');
			Route::post('/',[UsersController::class, 'list'])->name('admin.users.list');
			Route::get('/destroy/{id}',[UsersController::class, 'destroy'])->name('users.destroy');
			
	});
	
});
