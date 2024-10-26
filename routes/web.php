<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/chat/new-prompt', [ChatController::class, 'createNewPrompt']);
Route::get('/{id?}', [ChatController::class, 'index'])->name('chat.index');
Route::get('/delete/{id}', [ChatController::class, 'delete']);
