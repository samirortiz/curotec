<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectFilterController;
use App\Http\Controllers\Api\ProjectSortController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('projects/filter', [ProjectFilterController::class, 'filter'])->name('filter');
Route::get('projects/sort', [ProjectSortController::class, 'sort'])->name('sort');
Route::apiResource('projects', ProjectController::class);
