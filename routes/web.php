<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessOwnerController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessOwner\CustomerController;
use App\Http\Controllers\MessOwner\SubscriptionController;
use App\Http\Controllers\MessOwner\GalleryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/mess-list', [HomeController::class,'messList'])->name('mess.list');
Route::get('/blogs', [HomeController::class,'blogList'])->name('blog.list');
Route::get('/jobs', [HomeController::class,'jobList'])->name('job.list');
Route::post('/apply-job', [HomeController::class,'applyForJob'])->name('apply.job');
Route::get('{job_id}/job', [HomeController::class,'getJob'])->name('job.view');
Route::post('/load-more-mess', [HomeController::class,'loadMoreMess'])->name('load.more.mess');
Route::get('/about-us', [HomeController::class,'aboutUs'])->name('about.us');
Route::get('/contact-us', [HomeController::class,'contactUs'])->name('contact.us');
Route::get('/faqs', [HomeController::class,'faqs'])->name('faqs');
Route::get('/{mess_id}/view-menu', [HomeController::class,'viewMenu'])->name('view.menu');
Route::get('/{mess_id}/book-a-mess', [HomeController::class,'bookAMess'])->name('mess.booking');
Route::post('/{mess_id}/book-a-mess', [HomeController::class,'BookingAMess'])->name('book.a.mess');
Route::get('/{mess_id}/book-a-mess-popup', [HomeController::class,'BookingAMessPage'])->name('book.a.mess.page');
Route::get('/{mess_id}/mess-detail', [HomeController::class,'messDetail'])->name('mess.detail');
Route::get('/transaction', [HomeController::class,'transactionList'])->name('transaction.data.datatables');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/become-mess-owner', [AuthController::class, 'becomeAMessOwner'])->name('become_mess_owner');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/check-login', [AuthController::class, 'login'])->name('check.login');
Route::post('/user-signup', [AuthController::class, 'registration'])->name('user.signup');
Route::post('/get-state-list',[CommonController::class, 'getStateList'])->name('get.state.list');
Route::post('/get-city-list',[CommonController::class, 'getCityList'])->name('get.city.list');
Route::get('/customer/register-via-refer', [CustomerController::class, 'registerViaRefer'])->name('register.via.referral');
Route::post('/get-country', [UsersController::class, 'getCountries'])->name('get.countries');
Route::post('/get-states', [UsersController::class, 'getStates'])->name('get.states');
Route::post('/get-cities', [UsersController::class, 'getCities'])->name('get.cities');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/delete-media',[CommonController::class, 'deleteMedia'])->name('delete.media');
    Route::get('/user-profile', [HomeController::class,'profile'])->name('view.profile');
    Route::group(['prefix'=>'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::group(['prefix'=>'roles'],function(){
            Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
            Route::get('/roles-list', [RolesController::class, 'list'])->name('admin.roles.list.datatables');
            Route::get('/create', [RolesController::class, 'create'])->name('admin.role.create');
            Route::post('/create', [RolesController::class, 'save'])->name('admin.role.save');
            Route::get('/{role_id}/edit', [RolesController::class, 'edit'])->name('admin.role.edit');
            Route::post('/update', [RolesController::class, 'update'])->name('admin.role.update');
            Route::delete('/{role_id}/delete', [RolesController::class, 'delete'])->name('admin.role.delete');
            Route::get('/{role_id}/roles-premission', [RolesController::class, 'rolePermission'])->name('admin.role.permission');
            Route::post('/update-roles-premission', [RolesController::class, 'updateRolePermission'])->name('admin.role.permission.update');
        });

        Route::group(['prefix' => 'mess-owner'], function () {
            Route::get('/create', [MessOwnerController::class, 'add'])->name('admin.mess_owner.add');
            Route::get('/get-list', [MessOwnerController::class, 'list'])->name('admin.mess_owner.datatables');
            Route::get('/list', [MessOwnerController::class, 'index'])->name('admin.mess_owner.list');
            Route::post('/create', [MessOwnerController::class, 'save'])->name('admin.mess_owner.save');
            Route::get('/{owner_id}/edit', [MessOwnerController::class, 'edit'])->name('admin.mess_owner.edit');
            Route::post('/update', [MessOwnerController::class, 'update'])->name('admin.mess_owner.update');
            Route::delete('{id}/delete', [MessOwnerController::class, 'delete'])->name('admin.mess_owner.delete');
            Route::get('{user_id}/guest-login', [AuthController::class, 'loginAsGuestLogin'])->name('guest.login');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/create', [UsersController::class, 'add'])->name('admin.users.add');
            Route::get('/get-list', [UsersController::class, 'list'])->name('admin.users.datatables');
            Route::get('/list', [UsersController::class, 'index'])->name('admin.users.list');
            Route::post('/create', [UsersController::class, 'save'])->name('admin.users.save');
            Route::get('/{cuisine_id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::post('/update', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('{id}/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
            Route::get('{user_id}/guest-login', [AuthController::class, 'loginAsGuestLogin'])->name('guest.login');
        });
        Route::group(['prefix' => 'cuisines'], function () {
            Route::get('/create', [CuisineController::class, 'add'])->name('admin.cuisines.add');
            Route::get('/get-list', [CuisineController::class, 'list'])->name('admin.cuisines.datatables');
            Route::get('/list', [CuisineController::class, 'index'])->name('admin.cuisines.list');
            Route::post('/create', [CuisineController::class, 'save'])->name('admin.cuisines.save');
            Route::get('/{owner_id}/edit', [CuisineController::class, 'edit'])->name('admin.cuisines.edit');
            Route::post('/update', [CuisineController::class, 'update'])->name('admin.cuisines.update');
            Route::delete('{id}/delete', [CuisineController::class, 'delete'])->name('admin.cuisines.delete');
        });
        Route::group(['prefix' => 'banner'], function () {
            Route::get('/create', [BannerController::class, 'add'])->name('admin.banner.add');
            Route::get('/get-list', [BannerController::class, 'list'])->name('admin.banner.datatables');
            Route::get('/list', [BannerController::class, 'index'])->name('admin.banner.list');
            Route::post('/create', [BannerController::class, 'save'])->name('admin.banner.save');
            Route::get('/{banner_id}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
            Route::post('/update', [BannerController::class, 'update'])->name('admin.banner.update');
            Route::delete('{id}/delete', [BannerController::class, 'delete'])->name('admin.banner.delete');
        });
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/list', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customer.list');
            Route::get('/customer-list', [\App\Http\Controllers\Admin\CustomerController::class, 'list'])->name('admin.customer.datatables');
            Route::get('{id}/manage-subscription', [SubscriptionController::class, 'manage_subscription'])->name('admin.customer.manage_subscription');
            Route::post('/manage-subscription', [SubscriptionController::class, 'save_manage_subscription'])->name('admin.customer.save.subscription');
            Route::get('{user_id}/guest-login', [AuthController::class, 'loginAsGuestLogin'])->name('guest.login');
        });
        Route::group(['prefix' => 'news'], function () {
            Route::get('/create', [NewsController::class, 'add'])->name('admin.news.add');
            Route::get('/get-list', [NewsController::class, 'list'])->name('admin.news.datatables');
            Route::get('/list', [NewsController::class, 'index'])->name('admin.news.list');
            Route::post('/create', [NewsController::class, 'save'])->name('admin.news.save');
            Route::get('/{news_id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
            Route::post('/update', [NewsController::class, 'update'])->name('admin.news.update');
            Route::delete('{id}/delete', [NewsController::class, 'delete'])->name('admin.news.delete');
        });
        Route::group(['prefix' => 'faq'], function () {
            Route::get('/create', [FaqController::class, 'add'])->name('admin.faq.add');
            Route::get('/get-list', [FaqController::class, 'list'])->name('admin.faq.datatables');
            Route::get('/list', [FaqController::class, 'index'])->name('admin.faq.list');
            Route::post('/create', [FaqController::class, 'save'])->name('admin.faq.save');
            Route::get('/{faq_id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
            Route::post('/update', [FaqController::class, 'update'])->name('admin.faq.update');
            Route::post('delete', [FaqController::class, 'delete'])->name('admin.faq.delete');
        });
        Route::group(['prefix' => 'job'], function () {
            Route::get('/create', [JobController::class, 'add'])->name('admin.job.add');
            Route::get('/get-list', [JobController::class, 'list'])->name('admin.job.datatables');
            Route::get('{job_id}/get-application-list', [JobController::class, 'applicationList'])->name('admin.job.application.datatables');
            Route::get('/list', [JobController::class, 'index'])->name('admin.job.list');
            Route::post('/create', [JobController::class, 'save'])->name('admin.job.save');
            Route::get('/{job_id}/edit', [JobController::class, 'edit'])->name('admin.job.edit');
            Route::get('/{job_id}/view-application', [JobController::class, 'viewApplications'])->name('admin.job.view');
            Route::post('/update', [JobController::class, 'update'])->name('admin.job.update');
            Route::post('delete', [JobController::class, 'delete'])->name('admin.job.delete');
        });
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/create', [BlogController::class, 'add'])->name('admin.blog.add');
            Route::get('/get-list', [BlogController::class, 'list'])->name('admin.blog.datatables');
            Route::get('/list', [BlogController::class, 'index'])->name('admin.blog.list');
            Route::post('/create', [BlogController::class, 'save'])->name('admin.blog.save');
            Route::get('/{blog_id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
            Route::post('/update', [BlogController::class, 'update'])->name('admin.blog.update');
            Route::delete('/{blog_id}/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');
        });
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/list', [TransactionController::class, 'index'])->name('admin.transaction.list');
            Route::post('/filter', [TransactionController::class, 'filter'])->name('admin.transaction.filter');
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
            Route::get('/get-list', [CustomerController::class, 'list'])->name('mess_owner.customer.datatables');
            Route::get('/view-attendance', [CustomerController::class, 'viewAttendancePage'])->name('mess_owner.customer.view.attendance');
            Route::get('/transaction', [CustomerController::class, 'viewTransaction'])->name('mess_owner.customer.view.transaction');
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
        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/create', [GalleryController::class, 'add'])->name('mess_owner.gallery.add');
            Route::get('/get-list', [GalleryController::class, 'list'])->name('mess_owner.gallery.datatables');
            Route::get('/list', [GalleryController::class, 'index'])->name('mess_owner.gallery.list');
            Route::post('/create', [GalleryController::class, 'save'])->name('mess_owner.gallery.save');
            Route::get('/{gallery_id}/edit', [GalleryController::class, 'edit'])->name('mess_owner.gallery.edit');
            Route::post('/update', [GalleryController::class, 'update'])->name('mess_owner.gallery.update');
            Route::delete('{id}/delete', [GalleryController::class, 'delete'])->name('mess_owner.gallery.delete');
        });
    });
    Route::group(['middleware' => ['role:CUSTOMER'],'prefix'=>'customer'], function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('customer.settings');
        Route::get('/transaction', [CustomerController::class, 'viewTransaction'])->name('customer.view.transaction');
        Route::post('/filter-attendance', [CustomerController::class, 'filterTransaction'])->name('customer.filter.transaction');
        Route::get('/refer-earn', [CustomerController::class, 'referAndEarnPage'])->name('customer.refer.earn');
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
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::post('/save-payment-details', [AuthController::class, 'savePaymentDetails'])->name('save.payment.details');
    Route::post('/settings', [SettingsController::class, 'store'])->name('update.settings');
    Route::get('/profile', [AuthController::class, 'userProfile'])->name('user.profile');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

