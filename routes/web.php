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
use App\Http\Controllers\MessOwner\CustomerController;
use App\Http\Controllers\MessOwner\SubscriptionController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PaymentController;
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
    Route::post('/get-state-list',[CommonController::class, 'getStateList'])->name('get.state.list');
    Route::post('/get-city-list',[CommonController::class, 'getCityList'])->name('get.city.list');
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
    Route::group(['prefix'=>'common'], function () {
        Route::group(['prefix'=>'payment'], function () {
            Route::get('/get-list', [PaymentController::class, 'list'])->name('common.payment.request.datatables');
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
        Route::group(['prefix'=>'customer'], function () {
            Route::get('/create', [CustomerController::class, 'add'])->name('mess_owner.customer.create');
            Route::get('/view-attendance', [CustomerController::class, 'viewAttendancePage'])->name('mess_owner.customer.view.attendance');
            Route::get('/transaction', [CustomerController::class, 'viewTransaction'])->name('mess_owner.customer.view.transaction');
            Route::get('/get-list', [CustomerController::class, 'list'])->name('mess_owner.customer.datatables');
            Route::get('/list', [CustomerController::class, 'index'])->name('mess_owner.customer.list');
            Route::post('/create', [CustomerController::class, 'save'])->name('mess_owner.customer.save');
            Route::post('/filter-attendance', [CustomerController::class, 'filterTransaction'])->name('mess_owner.customer.filter.transaction');
            Route::get('/{customer_id}/edit', [CustomerController::class, 'edit'])->name('mess_owner.customer.edit');
            Route::post('/update', [CustomerController::class, 'update'])->name('mess_owner.customer.update');
            Route::delete('{id}/delete', [CustomerController::class, 'delete'])->name('mess_owner.customer.delete');
            Route::get('{id}/manage-subscription', [SubscriptionController::class, 'manage_subscription'])->name('mess_owner.customer.manage_subscription');
            Route::post('/manage-subscription', [SubscriptionController::class, 'save_manage_subscription'])->name('mess_owner.customer.save.subscription');
            Route::get('{id}/mark-customer-attendance', [CustomerController::class, 'markAttendancePage'])->name('mess_owner.customer.mark.attendance.page');
            Route::post('mark-attendance', [CustomerController::class, 'markAttendance'])->name('mess_owner.customer.mark.attendance');
        });
        Route::group(['prefix'=>'request'], function () {
            Route::get('/list', [RequestController::class, 'pendingRequest'])->name('mess_owner.request.list');
            Route::post('/update', [RequestController::class, 'update'])->name('mess_owner.request.update');
            Route::get('{request_id}/view', [RequestController::class, 'view'])->name('mess_owner.request.view');
        });
        Route::group(['prefix'=>'payment'], function () {
            Route::get('/list', [PaymentController::class, 'viewRequestsPage'])->name('mess_owner.payment.view.requests');
            Route::post('/update', [PaymentController::class, 'updatePaymentRequest'])->name('mess_owner.payment.request.update');
            Route::get('{payment_id}/view', [PaymentController::class, 'editRequestPage'])->name('mess_owner.payment.request.view');
        });
    });
    Route::group(['middleware' => ['role:CUSTOMER'],'prefix'=>'customer'], function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('customer.settings');
        Route::group(['prefix'=>'request'], function () {
            Route::get('/create', [RequestController::class, 'add'])->name('customer.request.create');
            Route::get('/get-list', [RequestController::class, 'list'])->name('customer.request.datatables');
            Route::get('/list', [RequestController::class, 'index'])->name('customer.request.list');
            Route::post('/create', [RequestController::class, 'save'])->name('customer.request.save');
        });
        Route::group(['prefix'=>'payment'], function () {
            Route::get('/create', [PaymentController::class, 'add'])->name('customer.payment.request.create');

            Route::get('/list', [PaymentController::class, 'index'])->name('customer.payment.request.list');
            Route::post('/create', [PaymentController::class, 'save'])->name('customer.payment.request.save');
        });

        Route::group(['prefix'=>'menu'], function () {
            Route::get('/create', [MenuController::class, 'mark_day'])->name('customer.menu.mark_day');
            Route::get('/get-list', [MenuController::class, 'markDays'])->name('customer.menu.mark_day.datatables');
            Route::get('/list', [MenuController::class, 'mark_day_list'])->name('customer.menu.mark_day.list');
            Route::post('/store-absent-date', [MenuController::class, 'StoreAbsentDay'])->name('customer.mark_days.save');
        });
    });
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
    Route::post('/settings', [SettingsController::class, 'store'])->name('update.settings');
    Route::get('/profile', [AuthController::class, 'userProfile'])->name('profile');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

