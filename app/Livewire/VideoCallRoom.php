<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VideoCallRoom extends Component
{
    public $roomId;

    public function mount($room)
    {
        $this->roomId = $room;
    }

    public function render()
    {
        return view('livewire.video-call-room', [
            'user' => Auth::user(),
            'roomId' => $this->roomId,
        ])->layout('components.layouts.app', ['title' => '1-on-1 Virtual Video Date - MeroZodi']);
    }
}
