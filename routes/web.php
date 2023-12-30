<?php

use App\Http\Controllers\SalesManController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCatogoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\BannerController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;


use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/lock', function () {
    return view('admin/pages/lock');
});

Route::get('/settings', function () {
    return view('admin/pages/settings');
});

Route::get('/forgot-password', function () {
    return view('admin/pages/forgot-password');
});

// Users & User Role
Route::get('/users', function () {
    return view('admin/pages/users/users');
});
Route::get('/user/form', function () {
    return view('admin/pages/users/user_form');
});

Route::get('/user_roles', function () {
    return view('admin/pages/users/user_roles');
});
Route::get('/user_role/form', function () {
    return view('admin/pages/users/user_role_form');
});


Route::get('/salesman/form', function () {
    return view('admin/pages/salesman/salesman_form');
});

// Visitors
Route::get('/visitors', function () {
    return view('admin/pages/visitors/visitors');
});

Route::get('/visitor/form', function () {
    return view('admin/pages/visitors/visitor_form');
});

// Sellers


 Route::get('/seller-shops/form', function () {
     return view('admin/pages/sellers/seller-shops/create');
 });

// -- Offers -- //

// categories


// offers

Route::get('/offers/form', function () {
    return view('admin/pages/offers/offers/create');
});

Route::get('/offers', function () {
    return view('admin/pages/offers/offers/index');
});

// feedback
Route::get('/feedback', function () {
    return view('admin/pages/feedbacks/index');
});

// -- Premium -- //

// Packages
Route::get('/packages', function () {
    return view('admin/pages/premium/packages/index');
});
Route::get('/packages/form', function () {
    return view('admin/pages/premium/packages/create');
});


// Tutorials
Route::get('/seller-guide', function () {
    return view('admin/pages/tutorials/seller-guide/index');
});

Route::get('/seller-guide/form', function () {
    return view('admin/pages/tutorials/seller-guide/create');
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');


Auth::routes();
Route::prefix('/admin')->group(function () {
    Route::middleware(['is_Admin'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        // Salesman
        Route::resource('/shop-management', ShopController::class);

        Route::resource('/video-management', VideoController::class);
        Route::resource('/feedback-management', FeedBackController::class);


        Route::resource('/salesman-management', SalesManController::class);
        Route::get('/salesman/delete/{id}', [SalesManController::class,'destroy'])->name('delete.salesman');
        Route::get('/salesman/change/status/{id}/{status}', [SalesManController::class,'change_status'])->name('change.salesman.status');

        Route::resource('/seller-management', SellerController::class);
        Route::get('/seller/delete/{id}', [SellerController::class,'destroy'])->name('delete.seller');
        Route::resource('/offer-categories', CategoryController::class);
        Route::get('/category/delete/{id}', [CategoryController::class,'destroy'])->name('delete.category');

        Route::resource('/offer-sub-categories', SubCatogoryController::class);
        Route::get('/sub-category/delete/{id}', [SubCatogoryController::class,'destroy'])->name('delete.subcategory');

        Route::resource('/offer-management', PostController::class);
        Route::get('/offer/delete/{id}', [PostController::class,'destroy'])->name('delete.offer');
        Route::get('/offer/change-status', [PostController::class, 'change_status'])->name('admin.offer.status');
        Route::post('/offer/action', [PostController::class, 'perform_action'])->name('admin.change.action');

        Route::resource('/banner-management', BannerController::class);
        Route::get('/banner/delete/{id}', [BannerController::class,'destroy'])->name('delete.banner');

        Route::resource('/visitor-management', CustomerController::class);
        Route::get('/visitor/delete/{id}', [CustomerController::class,'destroy'])->name('delete.visitor');

        Route::resource('/area-management', AreaController::class);
        Route::get('/area/delete/{id}', [AreaController::class,'destroy'])->name('delete.area');

        Route::resource('/city-management', CityController::class);
        Route::get('/city/delete/{id}', [CityController::class,'destroy'])->name('delete.city');

        Route::resource('/province-management', ProvinceController::class);
        Route::get('/province/delete/{id}', [ProvinceController::class,'destroy'])->name('delete.province');

        Route::get('/seller/change-status/{status}/{id}', [SellerController::class, 'change_status'])->name('admin.seller.status');

    });
});



// Seller

