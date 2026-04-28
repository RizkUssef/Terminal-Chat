<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Http\Requests\CreateConversationRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\ConversationService;
use App\Services\ConversationUsersService;

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
        $conversation_partner = $this->conversationService->getOneUserConversations($conversation);
        $messages = $conversation->messages()->latest()->paginate(5)->groupBy(fn($msg) => $msg->created_at['date']);
        return view('chat-window', compact('conversation_partner', 'conversation', 'messages'));
    }
}
