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

Route::get('/admin-panel/users/user-list', [\App\Http\Controllers\UserController::class, 'getAll'])->name('users.getAll');
Route::get('/admin-panel', [\App\Http\Controllers\MainController::class, 'home']);

Route::post('/users/chats/{id}', [\App\Http\Controllers\UserController::class, 'chats'])->name('users.chats');

Route::get('/users/profile/{id}', [\App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
Route::post('/users/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('/users/upload-image', [\App\Http\Controllers\UserController::class, 'uploadAvatar'])->name('users.uploadAvatar');
Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::delete('/users/delete/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');

Route::get('/auth/show-register-form', [\App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('auth.show-register-form');
Route::get('/auth/show-login-form', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('auth.show-login-form');
Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
});


Route::post('/contacts/create/{userId}', [\App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts/accept/{userIdFrom}/{userIdTo}', [\App\Http\Controllers\ContactController::class, 'accept'])->name('contacts.accept');
Route::post('/contacts/delete/{userIdFrom}/{userIdTo}', [\App\Http\Controllers\ContactController::class, 'delete'])->name('contacts.delete');
Route::get('/contacts/chat/{contactId}/{activeUserId}', [\App\Http\Controllers\ContactController::class, 'chat'])->name('contacts.chat');



Route::post('/messages/delete', [\App\Http\Controllers\MessagesController::class, 'delete'])->name('messages.delete');
Route::post('/messages/send/{chatId}/{userId}', [\App\Http\Controllers\MessagesController::class, 'send'])->name('messages.send');
Route::post('/messages/contact/send/{activeUserId}', [\App\Http\Controllers\MessagesController::class, 'sendContactMessage'])->name('messages.contact.send');
Route::get('/messages/get-all', [\App\Http\Controllers\MessagesController::class, 'getAll'])->name('messages.getAll');




Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'chats']);
Route::get('/enter-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'enterChat'])->name('enterChat');
Route::get('/exit-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'exitChat'])->name('exitChat');
Route::get('/add-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'addChat'])->name('addChat');










