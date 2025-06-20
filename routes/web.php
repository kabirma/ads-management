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


// Route::group(['middleware' => 'customer', 'prefix' => 'customer'], function () {
//     Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'customer_dashboard'])->name('customer_dashboard');
//     Route::get('/concerts/interested/{id}', [App\Http\Controllers\HomeController::class, 'event_interested'])->name('event_interested');
//     Route::get('/logout',  [App\Http\Controllers\HomeController::class, 'customer_logout'])->name('customer_logout');
// });

Route::get('/change-language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return redirect()->back()->with('success', __('messages.language_changed'));
})->name('change.language');

Route::get('/verfiy/user/{token}', [App\Http\Controllers\CustomerController::class, 'verifyUser'])->name('verify_user');


Route::post('/login/submit',  [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
 
Route::get('/snapchat/auth', [App\Http\Controllers\SocialMedia\SnapChatController::class, 'authSnapChat'])->name('auth_snapchat');
Route::get('/snapchat/redirect', [App\Http\Controllers\SocialMedia\SnapChatController::class, 'redirectToSnapChat'])->name('redirect_to_snapchat');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout',  [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.admin');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/setting', [App\Http\Controllers\DashboardController::class, 'setting'])->name('user_setting');
    Route::get('/wallet', [App\Http\Controllers\DashboardController::class, 'wallet'])->name('user_wallet');
   
    Route::get('/package', [App\Http\Controllers\PurchaseController::class, 'index'])->name('user_package');
    Route::get('/transactions', [App\Http\Controllers\PurchaseController::class, 'viewTransaction'])->name('view_transactions');
    Route::post('/package/purchase', [App\Http\Controllers\PurchaseController::class, 'purchase'])->name('purchase_package');

    Route::post('/wallet/topup', [App\Http\Controllers\PaymentController::class, 'walletTopUp'])->name('wallet_top_up');
    Route::get('/wallet/topup/redirect/', [App\Http\Controllers\PaymentController::class, 'walletTopUpRedirect'])->name('wallet_top_up_redirect');
    Route::get('/wallet/topup/cancel/', [App\Http\Controllers\PaymentController::class, 'walletTopUpCancel'])->name('wallet_top_up_cancel');

    
    // Social Media Integration
   
    Route::get('/tiktok/auth', [App\Http\Controllers\SocialMedia\TikTokController::class, 'authTiktok'])->name('authTiktok');
    Route::get('/tiktok/callback', [App\Http\Controllers\SocialMedia\TikTokController::class, 'handleTikTokCallback'])->name('handleTikTokCallback');
    Route::post('/tiktok/create-campaign', [App\Http\Controllers\SocialMedia\TikTokController::class, 'createCampaign'])->name('create_campaign');
    Route::post('/tiktok/create-ad', [App\Http\Controllers\SocialMedia\TikTokController::class, 'createAd'])->name('create_ad');

    Route::get('/tiktok/create-identity', [App\Http\Controllers\SocialMedia\TikTokController::class, 'createIdentity'])->name('createIdentity');

    // Payment 
    Route::get('/checkout', [App\Http\Controllers\MastercardController::class, 'showCheckout'])->name('payment.checkout');
    Route::post('/checkout/create', [App\Http\Controllers\MastercardController::class, 'createCheckout'])->name('payment.create');
    Route::get('/checkout/success', [App\Http\Controllers\MastercardController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/checkout/cancel', [App\Http\Controllers\MastercardController::class, 'paymentCancel'])->name('payment.cancel');

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
    
    Route::group(['prefix' => 'business'], function () {
        Route::controller(App\Http\Controllers\BusinessProfileController::class)->group(function () {
            Route::get('/', 'index')->name('view.business');
            Route::get('/add', 'add')->name('add.business');
            Route::get('/edit/{id}', 'edit')->name('edit.business');

            Route::post('/save', 'save')->name('save.business');
            Route::get('/delete/{id}', 'delete')->name('delete.business');
            Route::get('/status/{id}', 'status')->name('status.business');
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
            Route::get('/user/{id}', 'userAds')->name('view.userads');
            Route::get('/add/{ai}', 'add')->name('add.ads');
            Route::get('/AI/add/', 'addAI')->name('addAI.ads');
            Route::get('/edit/{id}', 'edit')->name('edit.ads');
            Route::get('/detail/{id}/{platform}', 'detail')->name('detail.ads');

            Route::post('/save', 'save')->name('save.ads');
            Route::post('/save', 'save')->name('save.ads');
            Route::post('/generate/ad', 'generateAd')->name('generateAd.ads');
            Route::post('/re/generate/ad', 'reGenerateAd')->name('reGenerateAd.ads');
            Route::post('/get/reachimpressions', 'getReachImpression')->name('getReachImpression.ads');
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

    Route::group(['prefix' => 'profile'], function () {
        Route::controller(App\Http\Controllers\CustomerController::class)->group(function () {
            Route::get('/', 'index')->name('view.customer');
            Route::get('/add', 'add')->name('add.customer');
            Route::get('/edit/{id}', 'edit')->name('edit.customer');

            Route::get('/verify/email', 'verify_email')->name('verify.email');
            Route::post('/save', 'save')->name('save.customer');
            Route::get('/delete/{id}', 'delete')->name('delete.customer');
        });
    });


    Route::group(['prefix' => 'media'], function () {
        Route::controller(App\Http\Controllers\GalleryController::class)->group(function () {
            Route::get('/', 'index')->name('view.media');
            Route::get('/user/{id}', 'userMedia')->name('view.usermedias');
            Route::get('/add', 'add')->name('add.media');
            Route::get('/edit/{id}', 'edit')->name('edit.media');
            Route::get('/detail/{id}', 'detail')->name('detail.media');
            Route::post('/save', 'save')->name('save.media');
            Route::get('/delete/{id}', 'delete')->name('delete.media');
            Route::get('/status/{id}', 'status')->name('status.media');
        });
    });


    Route::group(['prefix' => 'draft'], function () {
        Route::controller(App\Http\Controllers\DraftController::class)->group(function () {
            Route::get('/', 'index')->name('view.draft');
            Route::get('/add', 'add')->name('add.draft');
            Route::get('/continue/{id}', 'continue')->name('continue.draft');
            Route::get('/detail/{id}', 'detail')->name('detail.draft');
            Route::post('/save', 'save')->name('save.draft');
            Route::get('/delete/{id}', 'delete')->name('delete.draft');
            Route::get('/status/{id}', 'status')->name('status.draft');
        });
    });
});
