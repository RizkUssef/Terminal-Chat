<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatId extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $userName, public string $userStatus, public string $userId ,public $lastSeenAt)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-id');
    }
}
