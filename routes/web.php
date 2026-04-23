<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatListController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'homeView'])->name('home');
Route::get('/chat-list', [ChatListController::class, 'chatListView'])->name('chat-list');
