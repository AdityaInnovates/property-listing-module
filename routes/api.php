<?php

use App\Http\Controllers\Api\PropertyController;

// Route::apiResource('properties', PropertyController::class)->only(['index', 'store', 'show']);

Route::get('/properties', [PropertyController::class, 'index']);      // List all properties
Route::post('/properties', [PropertyController::class, 'store']);     // Create new property
Route::get('/properties/{id}', [PropertyController::class, 'show']);