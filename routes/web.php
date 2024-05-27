<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});


// Route::get('/chats/{order_id}', [ChatController::class, 'getMessages']);
Route::post('/createchats/{order_id}', [ChatController::class, 'sendMessage']);
Route::post('/createchats/{order_id}', [ChatController::class, 'sendMessage']);

// Route::get('/messenger/{order_id}', function () {
//     return view('welcome');
// });

Route::get('/messenger', [ChatController::class, 'openMessenger']);

//CRUD Operations on Messages
Route::get('/messages/create', [ChatController::class, 'create'])->name('messages.create');
Route::post('/messages', [ChatController::class, 'store'])->name('messages.store');
Route::post('/messageFileUpload', [App\Http\Controllers\Api\ChatController::class, 'storeMessageFiles'])->name('message.file.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
