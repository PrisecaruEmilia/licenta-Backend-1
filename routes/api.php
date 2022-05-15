<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\FavoriteController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\UserController;

// User LOGIN-REGISTER API

// Login Routes
Route::post('/login', [AuthController::class, 'Login']);

// Register Routes
Route::post('/register', [AuthController::class, 'Register']);

// Forget Password Routes
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);

// Reset Password Routes
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);

// Current User Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');
// END

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Get Visitor
Route::get('/get-visitor', [VisitorController::class, 'GetVisitorDetails']);

// contact page route route
Route::post('/post-contact', [ContactController::class, 'PostContactDetails']);

// site info route
Route::get('/all-site-info', [SiteInfoController::class, 'AllSiteInfo']);

// all categories route
Route::get('/all-category', [CategoryController::class, 'AllCategory']);

// productList route
Route::get('/productlistbyremark/{remark}', [ProductListController::class, 'ProductListByRemark']);

Route::get('/productlistbycategory/{category}', [ProductListController::class, 'ProductListByCategory']);

Route::get('/productlistbysubcategory/{category}/{subcategory}', [ProductListController::class, 'ProductListBySubcategory']);


// slider route
Route::get('/all-slider', [SliderController::class, 'AllSlider']);


// Product Details route
Route::get('/product-details/{id}', [ProductDetailsController::class, 'ProductDetails']);


// notification route
Route::get('/notification', [NotificationController::class, 'NotificationHistory']);

// search route
Route::get('/search/{key}', [ProductListController::class, 'ProductBySearch']);

// similiar product route
Route::get('/similar/{subcategory}', [ProductListController::class, 'SimilarProduct']);

// Review Product Route
Route::get('/reviewlist/{id}', [ReviewController::class, 'ReviewList']);

// Product Cart Route
Route::post('/addtocart', [ProductCartController::class, 'addToCart']);

// Cart Count Route
Route::get('/cartcount/{product_code}', [ProductCartController::class, 'CartCount']);
// Favourite Route
Route::post('/favorite/{product_code}/{email}', [FavoriteController::class, 'AddFavorite']);

Route::get('/favoritelist/{email}', [FavoriteController::class, 'FavoriteList']);

Route::get('/favoriteremove/{product_code}/{email}', [FavoriteController::class, 'FavoriteRemove']);

// Cart List Route
Route::get('/cartlist/{email}', [ProductCartController::class, 'CartList']);

Route::get('/removecartlist/{id}', [ProductCartController::class, 'RemoveCartList']);
