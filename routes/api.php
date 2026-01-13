<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API V1
Route::prefix('v1')->group(function () {
    Route::get('/modules', [\App\Http\Controllers\Api\V1\ModuleController::class, 'index']);
    Route::get('/modules/{id}', [\App\Http\Controllers\Api\V1\ModuleController::class, 'show']);
});
