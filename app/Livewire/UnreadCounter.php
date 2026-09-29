<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class UnreadCounter extends Component
{
    public $type = 'header'; // 'header' or 'bottom_nav'

    #[On('chat-updated')]
    public function refreshCounter()
    {
        // Re-render when chat events fire
    }

    public function render()
    {
        $unreadCount = Auth::check() ? Auth::user()->unreadMessagesCount() : 0;

        return view('livewire.unread-counter', [
            'unreadCount' => $unreadCount,
            'type' => $this->type,
        ]);
    }
}
