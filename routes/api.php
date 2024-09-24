<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GroupPermissionController;
use App\Http\Controllers\AuthController;
use Illuminate\Session\Middleware\StartSession;

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





Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/groups', [GroupController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/groups/{group}', [GroupController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/groups', [GroupController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/groups/{group}', [GroupController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/groups/{group}', [GroupController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/users', [UserController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/users/{user}', [UserController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/users', [UserController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/users/{user}', [UserController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/users/{user}', [UserController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/regions', [RegionController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/regions/{region}', [RegionController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/regions', [RegionController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/regions/{region}', [RegionController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/regions/{region}', [RegionController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/branches', [BranchController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/branches/{branch}', [BranchController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/branches', [BranchController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/branches/{branch}', [BranchController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/branches/{branch}', [BranchController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/orders', [OrderController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/orders/{order}', [OrderController::class, 'show']);
// Route::middleware(['auth:sanctum', 'permission:create'])->post('/orders', [OrderController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/orders/{order}', [OrderController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/orders/{order}', [OrderController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/cities', [CityController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/cities/{city}', [CityController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/cities', [CityController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/cities/{city}', [CityController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/cities/{city}', [CityController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/governorates', [GovernorateController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/governorates/{governorate}', [GovernorateController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/governorates', [GovernorateController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/governorates/{governorate}', [GovernorateController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/governorates/{governorate}', [GovernorateController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'permission:view_all'])->get('/group-permissions', [GroupPermissionController::class, 'index']);
Route::middleware(['auth:sanctum', 'permission:view_row'])->get('/group-permissions/{group_id}/{permission_id}', [GroupPermissionController::class, 'show']);
Route::middleware(['auth:sanctum', 'permission:create'])->post('/group-permissions', [GroupPermissionController::class, 'store']);
Route::middleware(['auth:sanctum', 'permission:edit'])->put('/group-permissions/{group_id}/{permission_id}', [GroupPermissionController::class, 'update']);
Route::middleware(['auth:sanctum', 'permission:delete'])->delete('/group-permissions/{group_id}/{permission_id}', [GroupPermissionController::class, 'destroy']);


Route::middleware([StartSession::class])->group(function () {
    Route::post('products/temporary', [ProductController::class, 'storeTemporaryProducts']);
    Route::get('products/temporary', [ProductController::class, 'showTemporaryProducts']);
    Route::put('products/temporary/{index}', [ProductController::class, 'updateTemporaryProduct']);
    Route::delete('products/temporary/{index}', [ProductController::class, 'deleteTemporaryProduct']);
    Route::delete('products/clear', [ProductController::class, 'clearTemporaryProducts']);
    Route::middleware(['auth:sanctum', 'permission:create'])->post('/orders', [OrderController::class, 'store']);
});
