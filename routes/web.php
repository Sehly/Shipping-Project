<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\GroupController;

use App\Http\Controllers\BranchController;

use App\Http\Controllers\RegionController;

use App\Http\Controllers\WeightController;

use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
});

// Route::resource('users', UserController::class);

// Route::resource('groups', GroupController::class);

// Route::resource('branches', BranchController::class);

// Route::resource('regions', RegionController::class);

// Route::resource('weights', WeightController::class);

// Route::resource('orders', OrderController::class);



