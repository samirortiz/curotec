<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Forms
Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('create-project');
Route::get('/projects/edit/{project}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit-project');

// Front controller routes
Route::post('/projects/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('store-project');
Route::put('/projects/update/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update-project');
Route::delete('/projects/destroy/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('destroy-project');
