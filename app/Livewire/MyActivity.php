<?php

namespace App\Livewire;

use App\Models\ConnectRequest;
use App\Models\ProfileView;
use App\Models\UserLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class MyActivity extends Component
{
    #[Url(as: 'tab', except: 'received_connects')]
    public $activeTab = 'received_connects'; // 'received_connects', 'sent_connects', 'likes', 'visitors'

    public function acceptConnect($requestId)
    {
        $req = ConnectRequest::where('receiver_id', Auth::id())->where('id', $requestId)->firstOrFail();
        $req->update(['status' => 'accepted', 'responded_at' => now()]);
        session()->flash('success', 'Connection accepted! You can now chat together. 💬');
    }

    public function declineConnect($requestId)
    {
        $req = ConnectRequest::where('receiver_id', Auth::id())->where('id', $requestId)->firstOrFail();
        $req->update(['status' => 'rejected', 'responded_at' => now()]);
        session()->flash('info', 'Connection request declined.');
    }

    public function cancelSentConnect($requestId)
    {
        $req = ConnectRequest::where('sender_id', Auth::id())->where('id', $requestId)->firstOrFail();
        $req->delete();
        session()->flash('info', 'Sent connection request cancelled.');
    }

    public function removeLike($likeId)
    {
        $like = UserLike::where('liker_id', Auth::id())->where('id', $likeId)->firstOrFail();
        $like->delete();
        session()->flash('info', 'Profile removed from your favorites.');
    }

    public function render()
    {
        $userId = Auth::id();

        $receivedConnects = ConnectRequest::with(['sender', 'sender.profile', 'sender.education'])
            ->where('receiver_id', $userId)
            ->latest()
            ->get();

        $sentConnects = ConnectRequest::with(['receiver', 'receiver.profile', 'receiver.education'])
            ->where('sender_id', $userId)
            ->latest()
            ->get();

        $likedProfiles = UserLike::with(['liked', 'liked.profile', 'liked.education'])
            ->where('liker_id', $userId)
            ->latest()
            ->get();

        $profileVisitors = ProfileView::with(['viewer', 'viewer.profile', 'viewer.education'])
            ->where('viewed_id', $userId)
            ->latest('last_viewed_at')
            ->get();

        return view('livewire.my-activity', [
            'receivedConnects' => $receivedConnects,
            'sentConnects' => $sentConnects,
            'likedProfiles' => $likedProfiles,
            'profileVisitors' => $profileVisitors,
        ])->layout('components.layouts.app', ['title' => 'My Activities & Connections - MeroZodi']);
    }
}
