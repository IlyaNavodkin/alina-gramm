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

Route::get('/create-new-user', [\App\Http\Controllers\UserController::class, 'createNewUser']);

Route::get('/users', [\App\Http\Controllers\UserController::class, 'users']);
Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'create']);
Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

Route::get('/', [\App\Http\Controllers\MainController::class, 'home']);

Route::get('/messages', [\App\Http\Controllers\MessagesController::class, 'messages']);



