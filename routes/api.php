<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('species', \App\Http\Controllers\SpeciesController::class);

Route::apiResource('varieties', \App\Http\Controllers\VarietyController::class);

Route::apiResource('plants', \App\Http\Controllers\PlantController::class);

// Route::post('/user', function (Request $request) {
//     return $request;
// });

Route::apiResource('tests', \App\Http\Controllers\TestController::class);