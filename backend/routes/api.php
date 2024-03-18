<?php

use App\Http\Controllers\OfficeClerkController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/office_clerk', OfficeClerkController::class);
Route::resource('/task', TaskController::class);

