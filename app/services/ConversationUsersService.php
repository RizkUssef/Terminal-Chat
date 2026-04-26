<?php

namespace App\Services;

use App\Models\User;
use App\Models\Conversation;

class ConversationUsersService
{
    public function createConversationUsers($conv, $users)
    {
        $conv_user = $conv->users()->syncWithoutDetaching($users);
        return $conv_user;
    }
}
