<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\DeviceTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    });
// tokens
Route::post('auth/tokens', [AccessTokenController::class, 'store']);
// FCM
Route::post('device/tokens', [DeviceTokensController::class, 'store'])
    ->middleware('auth:sanctum');

Route::delete('auth/tokens', [AccessTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::apiResource('catagories', CategoriesController::class)
    ->middleware('auth:sanctum');
