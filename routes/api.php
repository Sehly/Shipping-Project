<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;



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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('groups',GroupController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('weights',WeightController::class);
});

Route::middleware(['auth:sanctum', 'role:trader'])->group(function () {
    
    Route::apiResource('users',UserController::class);
    Route::apiResource('regions',RegionController::class);
    Route::apiResource('branches',BranchController::class);
    Route::apiResource('orders',OrderController::class);
});
