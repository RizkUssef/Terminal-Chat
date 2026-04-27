<?php

namespace App\Services;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;
use App\Events\MessageSent;

class MessageService
{
    public function sendMessage(Conversation $conversation, string $message)
    {
        $user_id = auth()->user()->id;
        $new_message = DB::transaction(function () use ($user_id, $conversation, $message) {
            $message = $conversation->messages()->create([
                'sender_id' => $user_id,
                'message' => $message,
            ]);
            return $message;
        });
        broadcast(new MessageSent($new_message))->toOthers();
        return $new_message;
    }
}
