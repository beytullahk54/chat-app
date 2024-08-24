<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [ChatController::class, 'welcome']);

Route::get('/rooms', [ChatController::class, 'getRooms']);

Route::get('/messages', [ChatController::class, 'index']);
Route::post('/messages', [ChatController::class, 'sendMessage']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
