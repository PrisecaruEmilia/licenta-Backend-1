<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;


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
