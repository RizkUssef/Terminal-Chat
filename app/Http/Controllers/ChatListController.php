<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatListController extends Controller
{
    public function chatListView()
    {
        return view('ChatList');
    }
}
