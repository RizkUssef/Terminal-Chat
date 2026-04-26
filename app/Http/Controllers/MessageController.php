<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MessageService;
use App\Http\Requests\MessageRequest;
use App\Models\Conversation;

class MessageController extends Controller
{
    public function __construct(public MessageService $messageService) {}

    public function sendMessage(MessageRequest $request, Conversation $conversation)
    {
        $this->messageService->sendMessage($conversation, $request->message);
        return back();
    }
}
