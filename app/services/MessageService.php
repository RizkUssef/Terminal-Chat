<?php

namespace App\Services;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;

class MessageService
{
    public function sendMessage(Conversation $conversation, string $message)
    {
        $user_id = auth()->user()->id;
        DB::transaction(function () use ($user_id, $conversation, $message) {
            $conversation->messages()->create([
                'sender_id' => $user_id,
                'message' => $message,
            ]);
        });
    }

}
