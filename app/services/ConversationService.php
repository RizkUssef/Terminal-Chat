<?php

namespace App\Services;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;

class ConversationService
{
    public function __construct(public ConversationUsersService $conversationUsersService) {}
    private function createNewConversation(User $creator): Conversation
    {
        $conv = $creator->createConversation()->create();
        return $conv;
    }

    // check if user is trying to chat with themselves
    private function ensureNotSelf($creator_id, $user_id): void
    {
        if ($user_id === $creator_id) {
            throw new \InvalidArgumentException("Cannot chat with yourself.", 422);
        }
    }

    // check if there is a conversation where BOTH users are members
    private function ensureNotExists($creator_id, $user_id): void
    {
        if (Conversation::privateBetween($creator_id, $user_id)->exists()) {
            throw new \InvalidArgumentException("Already has a conversation.", 409);
        }
    }

    public function addNewFriend($user_field)
    {
        $creator = auth()->user();
        $user = User::where($user_field)->first();

        $this->ensureNotSelf(creator_id: $creator->id, user_id: $user->id);
        $this->ensureNotExists(creator_id: $creator->id, user_id: $user->id);

        // Safe to create
        $users = [$creator->id, $user->id];
        DB::transaction(function () use ($users, $creator) {
            $conv = $this->createNewConversation($creator);
            $conv_user = $this->conversationUsersService->createConversationUsers($conv, $users);
        });

        return $user;
    }

    public function getAllUserConversations()
    {
        $conversations_members = auth()->user()->getConversationsWithPartners();
        return $conversations_members;
    }
}
