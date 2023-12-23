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

Route::get('/', [\App\Http\Controllers\MainController::class, 'home'])->name('home');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/{activeDialogId?}', [\App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/chat/{activeContactId?}/', [\App\Http\Controllers\ContactController::class, 'chat'])->name('chat');
    Route::post('/chat/send/', [\App\Http\Controllers\MessagesController::class, 'sendContactMessage'])->name('sendContactMessage');

    Route::get('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/users/profile/{id}', [\App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');

    Route::post('/users/findByLogin', [\App\Http\Controllers\UserController::class, 'findByLogin'])->name('users.findByLogin');

    Route::post('/contacts/create', [\App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts/accept', [\App\Http\Controllers\ContactController::class, 'accept'])->name('contacts.accept');
    Route::post('/contacts/delete', [\App\Http\Controllers\ContactController::class, 'delete'])->name('contacts.delete');
    Route::get('/contacts/getById/{contactId}', [\App\Http\Controllers\ContactController::class, 'getById'])->name('contacts.getById');

    Route::post('/users/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/upload-image', [\App\Http\Controllers\UserController::class, 'uploadAvatar'])->name('users.uploadAvatar');
    Route::get('/profile/delete', [\App\Http\Controllers\UserController::class, 'delete'])->name('profile.delete');

    Route::post('/messages/delete', [\App\Http\Controllers\MessagesController::class, 'delete'])->name('messages.delete');
});










