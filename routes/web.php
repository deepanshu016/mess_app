<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessOwnerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/dummy', [App\Http\Controllers\SettingsController::class, 'dummyRoute'])->name('dummy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/become-mess-owner', [AuthController::class, 'becomeAMessOwner'])->name('become_mess_owner');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/check-login', [AuthController::class, 'login'])->name('check.login');
Route::post('/user-signup', [AuthController::class, 'registration'])->name('user.signup');
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:ADMIN'],'prefix'=>'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::group(['prefix' => 'mess-owner'], function () {
            Route::get('/create', [MessOwnerController::class, 'add'])->name('admin.mess_owner.add');
            Route::get('/get-list', [MessOwnerController::class, 'list'])->name('admin.mess_owner.datatables');
            Route::get('/list', [MessOwnerController::class, 'index'])->name('admin.mess_owner.list');
            Route::post('/create', [MessOwnerController::class, 'save'])->name('admin.mess_owner.save');
            Route::get('/{owner_id}/edit', [MessOwnerController::class, 'edit'])->name('admin.mess_owner.edit');
            Route::post('/update', [MessOwnerController::class, 'update'])->name('admin.mess_owner.update');
            Route::delete('{id}/delete', [MessOwnerController::class, 'delete'])->name('admin.mess_owner.delete');
        });
    });
    Route::group(['middleware' => ['role:MESS_OWNER'],'prefix'=>'mess-owner'], function () {
        Route::get('/dashboard', [MessDashboardController::class, 'index'])->name('mess_owner.dashboard');
        Route::group(['prefix'=>'menu'], function () {
            Route::get('/create', [MenuController::class, 'add'])->name('mess_owner.menu.create');
            Route::get('/get-list', [MenuController::class, 'list'])->name('mess_owner.menu.datatables');
            Route::get('/list', [MenuController::class, 'index'])->name('mess_owner.menu.list');
            Route::post('/create', [MenuController::class, 'save'])->name('mess_owner.menu.save');
            Route::get('/{menu_id}/edit', [MenuController::class, 'edit'])->name('mess_owner.menu.edit');
            Route::post('/update', [MenuController::class, 'update'])->name('mess_owner.menu.update');
            Route::delete('{id}/delete', [MenuController::class, 'delete'])->name('mess_owner.menu.delete');
        });
    });
    Route::group(['middleware' => ['role:CUSTOMER'],'prefix'=>'customer'], function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('customer.settings');
    });
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
    Route::post('/settings', [SettingsController::class, 'store'])->name('update.settings');
    Route::get('/profile', [AuthController::class, 'userProfile'])->name('profile');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

