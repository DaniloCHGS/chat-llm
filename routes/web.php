<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/chat/new-prompt', [ChatController::class, 'createNewPrompt'])->name('chat.new-prompt');
Route::get('/{id?}', [ChatController::class, 'index'])->name('chat.index');
Route::get('/delete/{id}', [ChatController::class, 'delete'])->name('chat.delete');
