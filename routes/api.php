<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Banner tracking
Route::post('/banners/{banner}/impression', function (App\Models\Banner\Content $banner) {
    $banner->trackImpression();
    return response()->json(['success' => true]);
});

Route::post('/banners/{banner}/click', function (App\Models\Banner\Content $banner) {
    $banner->trackClick();
    return response()->json(['success' => true]);
});

// An-Nibros Articles API
Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/featured', [ArticleController::class, 'featured']);
    Route::get('/categories', [ArticleController::class, 'categories']);
    Route::get('/tags', [ArticleController::class, 'tags']);
    Route::get('/{article}', [ArticleController::class, 'show']);
});