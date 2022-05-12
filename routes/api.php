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
