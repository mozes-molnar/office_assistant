<?php

use App\Http\Controllers\OfficeClerkController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/office_clerk', [OfficeClerkController::class, "store"]);
Route::resource('/office_clerk', OfficeClerkController::class);

Route::get("/valami", function () {
    echo "dsféldjf";
});

Route::resource('/tasks', TaskController::class);
