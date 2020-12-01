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
Route::group(['middleware' => 'cors'], function () {
    Route::get('task/', [TodoController::class, 'index'])->name('task.index');
    Route::post('task/', [TodoController::class, 'store'])->name('task.store');
    Route::get('task/{id}', [TodoController::class, 'show'])->name('task.show');
    Route::post('task/{id}', [TodoController::class, 'update'])->name('task.update');
    Route::delete('task/{id}', [TodoController::class, 'destroy'])->name('task.destroy');

});


