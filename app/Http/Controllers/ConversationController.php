<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Http\Requests\CreateConversationRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\ConversationService;
use App\Services\ConversationUsersService;
use App\Events\MessageRead;

class ConversationController extends Controller
{
    public function __construct(public ConversationService $conversationService, public ConversationUsersService $conversationUsersService) {}
    public function index()
    {
        $convs = Conversation::all();
        dd($convs);
    }

    public function addNewFriendView()
    {
        return view('add-new-friend');
    }

    public function create(CreateConversationRequest $request)
    {
        $user_field = detect_field($request->user);
        $conv_member = $this->conversationService->addNewFriend($user_field);
        return redirect()->route('user-convs');
    }

    public function showUserConversations()
    {
        $conversations_members = $this->conversationService->getAllUserConversations();
        return view('ChatList', compact('conversations_members'));
    }

    public function showConversation(Conversation $conversation)
    {
        $message_status = $this->markAsRead($conversation);
        // Only broadcast if there were actually unread messages
        // if ($message_status > 0) {
        //     broadcast(new MessageRead(
        //         conversationId: $conversation->id,
        //         readerId: auth()->id(),
        //     ))->toOthers();
        // }
        [
            'conversation_partner' => $conversation_partner,
            'messages' => $messages,
        ] = $this->conversationService->getOneUserConversations($conversation);
        return view('chat-window', compact('conversation_partner', 'conversation', 'messages'));
    }

    public function markAsRead(Conversation $conversation)
    {
        $message_status = $this->conversationService->markAsRead($conversation);
        return $message_status;
    }
}
