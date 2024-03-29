<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\UploadController;
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

Route::get('test', function() {
    return response()->json(['msg' => 'Hello Word'], 202);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('login/{provider?}', [AuthController::class, 'login']);
    Route::get('teste', [AuthController::class, 'teste']);
    Route::post('register/{provider?}', [AuthController::class, 'register']);

    Route::prefix('me')->middleware('auth:api')->group(function() {
        Route::get('', [MeController::class, 'index']);
        Route::put('update/{id}', [MeController::class, 'update']);
    });

    Route::prefix('upload')->group(function() {
        Route::post('', [UploadController::class, 'upload']);
    });
});

