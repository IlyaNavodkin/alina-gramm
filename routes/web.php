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

Route::get('/users/getChats/{id}', [\App\Http\Controllers\UserController::class, 'getUserChats'])->name('users.getChats');
Route::get('/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'editUser'])->name('editUser');
Route::post('/users/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::get('/users', [\App\Http\Controllers\UserController::class, 'users'])->name('users');

Route::post('/upload-image', [\App\Http\Controllers\UserController::class, 'uploadUserAvatar'])->name('upload.image');

Route::get('/enter-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'enterChat'])->name('enterChat');
Route::get('/exit-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'exitChat'])->name('exitChat');
Route::get('/add-chat/{chatId}/{userId}', [\App\Http\Controllers\ChatController::class, 'addChat'])->name('addChat');
// Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
// Route::get('/create-new-user', [\App\Http\Controllers\UserController::class, 'createNewUser']);
Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');



Route::get('/', [\App\Http\Controllers\MainController::class, 'home']);

Route::post('/contacts/{userId}', [\App\Http\Controllers\ContactController::class, 'addContact'])->name('addContact');
Route::post('/contacts/accept/{userIdFrom}/{userIdTo}', [\App\Http\Controllers\ContactController::class, 'acceptContact'])->name('acceptContact');
Route::post('/contacts/delete/{userIdFrom}/{userIdTo}', [\App\Http\Controllers\ContactController::class, 'deleteContact'])->name('deleteContact');
Route::get('/openContactChat/{contactId}/{activeUserId}', [\App\Http\Controllers\ContactController::class, 'openContactChat'])->name('openContactChat');


Route::post('/deleteMessage', [\App\Http\Controllers\MessagesController::class, 'deleteMessage'])->name('deleteMessage');
Route::post('/send-message/{chatId}/{userId}', [\App\Http\Controllers\MessagesController::class, 'sendMessage'])->name('sendMessage');
Route::post('/sendContactMessage/{activeUserId}', [\App\Http\Controllers\MessagesController::class, 'sendContactMessage'])->name('sendContactMessage');
Route::get('/messages', [\App\Http\Controllers\MessagesController::class, 'messages']);

Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'chats']);



