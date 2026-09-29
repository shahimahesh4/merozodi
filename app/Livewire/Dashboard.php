<?php

namespace App\Livewire;

use App\Models\ConnectRequest;
use App\Models\Message;
use App\Models\ProfileView;
use App\Models\User;
use App\Models\UserLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        $pendingReceivedRequests = ConnectRequest::with(['sender', 'sender.profile', 'sender.education'])
            ->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $recentVisitors = ProfileView::with(['viewer', 'viewer.profile', 'viewer.education'])
            ->where('viewed_id', $user->id)
            ->latest('last_viewed_at')
            ->take(6)
            ->get();

        $recentLikes = UserLike::with(['liker', 'liker.profile'])
            ->where('liked_id', $user->id)
            ->latest()
            ->take(6)
            ->get();

        $recommendedProfiles = User::with(['profile', 'education'])
            ->where('role', 'user')
            ->where('status', 'active')
            ->where('is_verified', true)
            ->where('id', '!=', $user->id)
            ->where('gender', $user->gender === 'male' ? 'female' : 'male')
            ->latest()
            ->take(6)
            ->get();

        $unreadMessagesCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('livewire.dashboard', [
            'user' => $user,
            'pendingReceivedRequests' => $pendingReceivedRequests,
            'recentVisitors' => $recentVisitors,
            'recentLikes' => $recentLikes,
            'recommendedProfiles' => $recommendedProfiles,
            'unreadMessagesCount' => $unreadMessagesCount,
        ])->layout('components.layouts.app', ['title' => 'My Dashboard - MeroZodi']);
    }

    public function acceptRequest($requestId)
    {
        $request = ConnectRequest::where('receiver_id', Auth::id())
            ->where('id', $requestId)
            ->firstOrFail();

        $request->update([
            'status' => 'accepted',
            'responded_at' => now(),
        ]);

        session()->flash('success', 'Connection accepted! You can now message each other. 💬');
    }

    public function declineRequest($requestId)
    {
        $request = ConnectRequest::where('receiver_id', Auth::id())
            ->where('id', $requestId)
            ->firstOrFail();

        $request->update([
            'status' => 'rejected',
            'responded_at' => now(),
        ]);

        session()->flash('info', 'Connection request declined.');
    }
}
