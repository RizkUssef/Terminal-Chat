<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatListController;
use App\Http\Controllers\AddNewFriendController;
use App\Http\Controllers\ChatWindowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConversationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'homeView'])->name('home');
Route::get('/chat-window', [ChatWindowController::class, 'chatWindowView'])->name('chat-window');

Route::get("/chat/conversations", [ChatListController::class, 'conversations'])->name('all-conversations');
Route::get("/users", [UserController::class, 'index'])->name('all-users');
// conversation
Route::get('/add-new-friend', [ConversationController::class, 'addNewFriendView'])->name('add-new-friend');
Route::post('/add-new-friend', [ConversationController::class, 'create'])->name("create-conv");
Route::get('/user-conversations', [ConversationController::class, 'showUserConversations'])->name("user-convs");
Route::get('/conversation/{conversation:conversation_key}', [ConversationController::class, 'showConversation'])->name("conv");
