<?php

namespace App\Livewire;

use App\Models\ConnectRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatInbox extends Component
{
    use WithFileUploads;

    #[Url(as: 'user', except: null)]
    public $selectedUserId = null;

    public $newMessage = '';
    public $attachment = null;

    public function mount($selectedUserId = null)
    {
        if ($selectedUserId) {
            $this->selectedUserId = $selectedUserId;
            $this->markAsRead($selectedUserId);
        } elseif ($this->selectedUserId) {
            $this->markAsRead($this->selectedUserId);
        }
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->markAsRead($userId);
        $this->dispatch('chat-updated');
    }

    public function markAsRead($userId)
    {
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        $this->dispatch('chat-updated');
    }

    public function removeAttachment()
    {
        $this->attachment = null;
    }

    public $voiceAudio = null;
    public $voiceDuration = null;

    public $icebreakers = [
        "Namaste! What are your favorite weekend activities in Nepal or abroad? ☕",
        "What kind of family values and lifestyle are most important to you? 🪔",
        "Tell me about your career journey and future aspirations! 💼",
        "What are your favorite Nepali festivals and cultural traditions? 🥟",
        "Which travel destinations or hobbies excite you the most? ✈️",
    ];

    public function applyIcebreaker(string $prompt)
    {
        $this->newMessage = $prompt;
    }

    public function sendVoiceNote($audioBase64, $duration = 0)
    {
        if (!$this->selectedUserId || empty($audioBase64)) {
            return;
        }

        $user = Auth::user();
        if (!$user->canAccessDirectMessaging() && $user->connectionStatusWith($this->selectedUserId) !== 'accepted') {
            session()->flash('error', 'You must have an accepted connection request or Premium membership to send voice notes.');
            return;
        }

        // Process audio base64 data
        if (preg_match('/^data:audio\/(\w+);base64,/', $audioBase64, $type)) {
            $data = substr($audioBase64, strpos($audioBase64, ',') + 1);
            $type = strtolower($type[1]);
            $decoded = base64_decode($data);
            
            if ($decoded !== false) {
                $filename = 'voice_' . time() . '_' . Str::random(8) . '.' . ($type === 'webm' ? 'webm' : 'mp3');
                $path = 'chat_voice/' . $filename;
                \Illuminate\Support\Facades\Storage::disk('public')->put($path, $decoded);

                Message::create([
                    'sender_id' => Auth::id(),
                    'receiver_id' => $this->selectedUserId,
                    'message' => '🎤 Voice Note (' . gmdate('i:s', (int)$duration) . ')',
                    'type' => 'audio',
                    'attachment_path' => $path,
                    'attachment_name' => $filename,
                    'attachment_size' => strlen($decoded),
                    'audio_duration' => (int)$duration,
                    'is_read' => false,
                ]);

                $this->dispatch('chat-updated');
            }
        }
    }

    public function sendMessage()
    {
        $hasText = !empty(trim($this->newMessage));
        $hasAttachment = (bool) $this->attachment;

        if (!$hasText && !$hasAttachment) {
            return;
        }

        if (!$this->selectedUserId) {
            return;
        }

        // Check if communication is permitted (connected or premium)
        $user = Auth::user();
        if (!$user->canAccessDirectMessaging() && $user->connectionStatusWith($this->selectedUserId) !== 'accepted') {
            session()->flash('error', 'You must have an accepted connection request or Premium membership to send direct messages.');
            return;
        }

        $attachmentPath = null;
        $attachmentName = null;
        $attachmentSize = null;
        $type = 'text';

        if ($this->attachment) {
            $this->validate([
                'attachment' => 'file|max:12288', // 12MB max for photos, screenshots, documents
            ]);

            $attachmentName = $this->attachment->getClientOriginalName();
            $attachmentSize = $this->attachment->getSize();
            $mime = $this->attachment->getMimeType();
            $isImage = str_starts_with($mime, 'image/');
            $isAudio = str_starts_with($mime, 'audio/');

            $attachmentPath = $this->attachment->store('chat_attachments', 'public');
            $type = $isImage ? 'image' : ($isAudio ? 'audio' : 'file');
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUserId,
            'message' => $hasText ? trim($this->newMessage) : ($type === 'image' ? 'Sent a photo / screenshot' : ($type === 'audio' ? 'Sent an audio voice message' : 'Sent an attachment: ' . $attachmentName)),
            'type' => $type,
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'attachment_size' => $attachmentSize,
            'is_read' => false,
        ]);

        $this->newMessage = '';
        $this->attachment = null;
        $this->dispatch('chat-updated');
    }

    public function sendVideoInvite()
    {
        if (!$this->selectedUserId) return;

        $roomName = 'mz-room-' . md5(min(Auth::id(), $this->selectedUserId) . '-' . max(Auth::id(), $this->selectedUserId));
        $roomUrl = route('video.room', ['room' => $roomName]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUserId,
            'message' => 'I have initiated a 1-on-1 Virtual Video Date room. Join here: ' . $roomUrl,
            'type' => 'call_invite',
            'is_read' => false,
        ]);

        return redirect()->route('video.room', ['room' => $roomName]);
    }

    public function render()
    {
        $currentUserId = Auth::id();

        // Get all connected or messaged users
        $connectedUserIds = ConnectRequest::where(function ($q) use ($currentUserId) {
            $q->where('sender_id', $currentUserId)->orWhere('receiver_id', $currentUserId);
        })->where('status', 'accepted')->pluck('sender_id')->merge(
            ConnectRequest::where('receiver_id', $currentUserId)->where('status', 'accepted')->pluck('receiver_id')
        )->unique()->reject(fn($id) => $id == $currentUserId);

        $messagedUserIds = Message::where('sender_id', $currentUserId)
            ->orWhere('receiver_id', $currentUserId)
            ->get()
            ->map(fn($m) => $m->sender_id == $currentUserId ? $m->receiver_id : $m->sender_id)
            ->unique();

        $allChatUserIds = $connectedUserIds->merge($messagedUserIds)->unique()->values();

        $unreadCounts = Message::where('receiver_id', $currentUserId)
            ->where('is_read', false)
            ->whereIn('sender_id', $allChatUserIds)
            ->selectRaw('sender_id, count(*) as total')
            ->groupBy('sender_id')
            ->pluck('total', 'sender_id')
            ->toArray();

        // Fetch latest messages for all contacts in a single query
        $latestMessages = Message::where(function($q) use ($currentUserId, $allChatUserIds) {
            $q->where('sender_id', $currentUserId)->whereIn('receiver_id', $allChatUserIds);
        })->orWhere(function($q) use ($currentUserId, $allChatUserIds) {
            $q->where('receiver_id', $currentUserId)->whereIn('sender_id', $allChatUserIds);
        })->latest('id')->get()->groupBy(function($m) use ($currentUserId) {
            return $m->sender_id == $currentUserId ? $m->receiver_id : $m->sender_id;
        })->map->first();

        $chatUsers = User::with(['profile'])->whereIn('id', $allChatUserIds)->get()->map(function ($u) use ($unreadCounts, $latestMessages) {
            $u->last_message = $latestMessages[$u->id] ?? null;
            $u->unread_count = $unreadCounts[$u->id] ?? 0;
            return $u;
        })->sortByDesc(fn($u) => $u->last_message?->created_at);

        // If no user selected, auto select first
        if (!$this->selectedUserId && $chatUsers->count() > 0) {
            $this->selectedUserId = $chatUsers->first()->id;
            $this->markAsRead($this->selectedUserId);
        }

        $activeUser = $this->selectedUserId ? User::with(['profile', 'education'])->find($this->selectedUserId) : null;

        $messages = $this->selectedUserId
            ? Message::where(function ($q) use ($currentUserId) {
                $q->where('sender_id', $currentUserId)->where('receiver_id', $this->selectedUserId);
            })->orWhere(function ($q) use ($currentUserId) {
                $q->where('sender_id', $this->selectedUserId)->where('receiver_id', $currentUserId);
            })->orderBy('created_at', 'asc')->get()
            : collect();

        return view('livewire.chat-inbox', [
            'chatUsers' => $chatUsers,
            'activeUser' => $activeUser,
            'messages' => $messages,
        ])->layout('components.layouts.app', ['title' => 'Real-Time Chat Inbox - MeroZodi']);
    }
}
