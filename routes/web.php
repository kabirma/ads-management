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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/content/{category}', [App\Http\Controllers\HomeController::class, 'content'])->name('content');


Route::get('/tiktok/auth', [App\Http\Controllers\SocialMedia\TikTokController::class, 'redirectToTikTok'])->name('redirect_to_tiktok');
Route::post('/tiktok/callback', [App\Http\Controllers\SocialMedia\TikTokController::class, 'handleTikTokCallback'])->name('handle_callback');

Route::group(['middleware' => 'customer', 'prefix' => 'customer'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'customer_dashboard'])->name('customer_dashboard');
    Route::get('/concerts/interested/{id}', [App\Http\Controllers\HomeController::class, 'event_interested'])->name('event_interested');
    Route::get('/logout',  [App\Http\Controllers\HomeController::class, 'customer_logout'])->name('customer_logout');
});


Route::post('/login/submit',  [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout',  [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.admin');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/setting', [App\Http\Controllers\DashboardController::class, 'setting'])->name('user_setting');

    // Social Media Integration
   
    Route::post('/tiktok/create-campaign', [App\Http\Controllers\SocialMedia\TikTokController::class, 'createCampaign'])->name('create_campaign');
    Route::post('/tiktok/create-ad', [App\Http\Controllers\SocialMedia\TikTokController::class, 'createAd'])->name('create_ad');


    Route::group(['prefix' => 'roles'], function () {
        Route::controller(App\Http\Controllers\RoleController::class)->group(function () {
            Route::get('/', 'roles')->name('roles');
            Route::post('/list', 'listRoles')->name('list.roles');
            Route::post('/save', 'saveRole')->name('save.role');
            Route::post('/update', 'updateRole')->name('update.role');
            Route::post('/delete', 'deleteRole')->name('delete.role');
            Route::post('/info', 'getSingleRole')->name('role.info');
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::controller(App\Http\Controllers\UserController::class)->group(function () {
            Route::get('/', 'user')->name('user');
            Route::post('/list', 'listUser')->name('list.user');
            Route::post('/save', 'saveUser')->name('save.user');
            Route::post('/update', 'updateUser')->name('update.user');
            Route::post('/delete', 'deleteUser')->name('delete.user');
        });
    });

    Route::group(['prefix' => 'page'], function () {
        Route::controller(App\Http\Controllers\PageController::class)->group(function () {
            Route::get('/', 'index')->name('view.page');
            Route::get('/add', 'add')->name('add.page');
            Route::get('/edit/{id}', 'edit')->name('edit.page');

            Route::post('/save', 'save')->name('save.page');
            Route::get('/delete/{id}', 'delete')->name('delete.page');
            Route::get('/status/{id}', 'status')->name('status.page');
        });
    });


    Route::group(['prefix' => 'company'], function () {
        Route::controller(App\Http\Controllers\CompanyController::class)->group(function () {
            Route::get('/', 'index')->name('company');
            Route::post('/save', 'save')->name('save.company');
        });
    });



    Route::group(['prefix' => 'ads'], function () {
        Route::controller(App\Http\Controllers\AdsController::class)->group(function () {
            Route::get('/', 'index')->name('view.ads');
            Route::get('/add', 'add')->name('add.ads');
            Route::get('/edit/{id}', 'edit')->name('edit.ads');

            Route::post('/save', 'save')->name('save.ads');
            Route::get('/delete/{id}', 'delete')->name('delete.ads');
            Route::get('/delete/image/{id}', 'delete_image')->name('delete.ads.image');
            Route::get('/status/{id}', 'status')->name('status.ads');
        });
    });


    Route::group(['prefix' => 'package'], function () {
        Route::controller(App\Http\Controllers\PackageController::class)->group(function () {
            Route::get('/', 'index')->name('view.package');
            Route::get('/add', 'add')->name('add.package');
            Route::get('/edit/{id}', 'edit')->name('edit.package');

            Route::post('/save', 'save')->name('save.package');
            Route::get('/delete/{id}', 'delete')->name('delete.package');
            Route::get('/delete/image/{id}', 'delete_image')->name('delete.package.image');
            Route::get('/status/{id}', 'status')->name('status.package');
        });
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::controller(App\Http\Controllers\CustomerController::class)->group(function () {
            Route::get('/', 'index')->name('view.customer');
            Route::get('/add', 'add')->name('add.customer');
            Route::get('/edit/{id}', 'edit')->name('edit.customer');

            Route::post('/save', 'save')->name('save.customer');
            Route::get('/delete/{id}', 'delete')->name('delete.customer');
        });
    });


    Route::group(['prefix' => 'gallery'], function () {
        Route::controller(App\Http\Controllers\GalleryController::class)->group(function () {
            Route::get('/', 'index')->name('view.gallery');
            Route::get('/add', 'add')->name('add.gallery');
            Route::get('/edit/{id}', 'edit')->name('edit.gallery');
            Route::get('/detail/{id}', 'detail')->name('detail.gallery');
            Route::post('/save', 'save')->name('save.gallery');
            Route::get('/delete/{id}', 'delete')->name('delete.gallery');
            Route::get('/status/{id}', 'status')->name('status.gallery');
        });
    });


    Route::group(['prefix' => 'bts'], function () {
        Route::controller(App\Http\Controllers\BTSController::class)->group(function () {
            Route::get('/', 'index')->name('view.bts');
            Route::get('/add', 'add')->name('add.bts');
            Route::get('/edit/{id}', 'edit')->name('edit.bts');
            Route::get('/detail/{id}', 'detail')->name('detail.bts');
            Route::post('/save', 'save')->name('save.bts');
            Route::get('/delete/{id}', 'delete')->name('delete.bts');
            Route::get('/status/{id}', 'status')->name('status.bts');
        });
    });
});
