<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tasks = [
        1 => "Tarea 1",
        2 => "Tarea 2",
        3 => "Tarea 3"
    ];
    return serialize($tasks);
//    return view('welcome');
});
