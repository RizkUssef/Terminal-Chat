<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatWindowController extends Controller
{
    public function chatWindowView(){
        return view('chat-window');
    }
}
