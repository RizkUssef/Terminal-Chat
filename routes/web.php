<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatListController;
use App\Http\Controllers\AddNewFriendController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'homeView'])->name('home');
Route::get('/chat-list', [ChatListController::class, 'chatListView'])->name('chat-list');
Route::get('/add-new-friend', [AddNewFriendController::class, 'addNewFriendView'])->name('add-new-friend');
