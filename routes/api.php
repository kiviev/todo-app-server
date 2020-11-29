<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('task')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('task.index');
    Route::post('/', [TodoController::class, 'store'])->name('task.store');
    Route::get('/{id}', [TodoController::class, 'show'])->name('task.show');
    Route::post('/{id}', [TodoController::class, 'update'])->name('task.update');
    Route::delete('/{id}', [TodoController::class, 'destroy'])->name('task.destroy');
});
