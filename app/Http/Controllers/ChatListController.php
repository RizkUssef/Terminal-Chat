<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class ChatListController extends Controller
{
    // public function chatListView()
    // {
    //     return view('ChatList');
    // }

    public function conversations(){
        $convs = Conversation::all();
        dd($convs);
    }
}
