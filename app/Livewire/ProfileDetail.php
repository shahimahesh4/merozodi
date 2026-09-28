<?php

namespace App\Livewire;

use App\Models\BlockedUser;
use App\Models\ConnectRequest;
use App\Models\PhotoRequest;
use App\Models\ProfileView;
use App\Models\User;
use App\Models\UserLike;
use App\Models\UserReport;
use App\Models\VideoDateAppointment;
use App\Services\KundaliMatchingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ProfileDetail extends Component
{
    public User $user;
    public $reportReason = '';
    public $reportDetails = '';
    public $showReportModal = false;
    public $connectMessage = '';
    public $showConnectModal = false;
    public $activeTab = 'about'; // 'about', 'horoscope', 'lifestyle', 'career', 'family', 'preferences', 'photos'

    // Video Date Scheduling State
    public $showScheduleModal = false;
    public $scheduledDate = '';
    public $scheduledTime = '';
    public $scheduleNote = '';

    // Biodata Print Modal State
    public $showBiodataModal = false;

    public function mount($id)
    {
        $this->user = User::with([
            'profile', 'profile.religion', 'profile.caste',
            'physical', 'education', 'education.educationLevel', 'education.educationField', 'education.occupation',
            'family', 'preferences', 'galleries'
        ])->findOrFail($id);

        if (Auth::check() && Auth::id() !== $this->user->id) {
            $view = ProfileView::firstOrNew([
                'viewer_id' => Auth::id(),
                'viewed_id' => $this->user->id,
            ]);
            $view->view_count = ($view->view_count ?? 0) + 1;
            $view->last_viewed_at = now();
            $view->save();
        }

        $this->scheduledDate = now()->addDays(2)->format('Y-m-d');
        $this->scheduledTime = '19:00';
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existing = UserLike::where('liker_id', Auth::id())
            ->where('liked_id', $this->user->id)
            ->first();

        if ($existing) {
            $existing->delete();
            session()->flash('info', 'Profile removed from your liked list.');
        } else {
            UserLike::create([
                'liker_id' => Auth::id(),
                'liked_id' => $this->user->id,
            ]);
            session()->flash('success', 'Profile added to your favorites! ❤️');
        }
    }

    public function requestPhotoAccess()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request = PhotoRequest::firstOrCreate(
            [
                'requester_id' => Auth::id(),
                'target_user_id' => $this->user->id,
            ],
            [
                'status' => 'pending',
                'message' => 'Namaste! I would like to request permission to view your verified photos.',
            ]
        );

        session()->flash('success', 'Photo viewing request sent to ' . $this->user->name . '! 📸');
    }

    public function openConnectModal()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $this->showConnectModal = true;
    }

    public function submitConnectRequest()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existing = ConnectRequest::where('sender_id', Auth::id())
            ->where('receiver_id', $this->user->id)
            ->first();

        if (!$existing) {
            ConnectRequest::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $this->user->id,
                'message' => $this->connectMessage,
                'status' => 'pending',
            ]);
            session()->flash('success', 'Connection request sent successfully! 💍');
        }

        $this->showConnectModal = false;
        $this->connectMessage = '';
    }

    public function openScheduleDateModal()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $this->showScheduleModal = true;
    }

    public function submitScheduleDate()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'scheduledDate' => 'required|date|after_or_equal:today',
            'scheduledTime' => 'required',
            'scheduleNote' => 'nullable|string|max:500',
        ]);

        $scheduledAt = \Carbon\Carbon::parse($this->scheduledDate . ' ' . $this->scheduledTime);
        $roomId = 'mz-date-' . Str::random(10);

        VideoDateAppointment::create([
            'requester_id' => Auth::id(),
            'receiver_id' => $this->user->id,
            'scheduled_at' => $scheduledAt,
            'status' => 'pending',
            'room_id' => $roomId,
            'note' => $this->scheduleNote,
        ]);

        $this->showScheduleModal = false;
        session()->flash('success', 'Virtual video date invitation sent for ' . $scheduledAt->format('M d, Y h:i A') . '! 🎥');
    }

    public function blockUser()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        BlockedUser::firstOrCreate([
            'user_id' => Auth::id(),
            'blocked_user_id' => $this->user->id,
        ]);

        session()->flash('info', 'User has been blocked.');
        return redirect()->route('browse');
    }

    public function submitReport()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'reportReason' => 'required|string',
            'reportDetails' => 'nullable|string|max:1000',
        ]);

        UserReport::create([
            'reporter_id' => Auth::id(),
            'reported_id' => $this->user->id,
            'reason' => $this->reportReason,
            'details' => $this->reportDetails,
            'status' => 'pending',
        ]);

        $this->showReportModal = false;
        $this->reportReason = '';
        $this->reportDetails = '';
        session()->flash('success', 'Report submitted to moderation team.');
    }

    public function render()
    {
        $isLiked = Auth::check() ? Auth::user()->hasLiked($this->user->id) : false;
        $connectionStatus = Auth::check() ? Auth::user()->connectionStatusWith($this->user->id) : null;
        $canChat = Auth::check() && ($connectionStatus === 'accepted' || Auth::user()->canAccessDirectMessaging());

        // Photo privacy checks
        $isPhotoBlurred = (bool) ($this->user->profile?->is_photo_blurred ?? false);
        $hasPhotoAccess = false;
        if (Auth::check()) {
            if (Auth::id() === $this->user->id) {
                $hasPhotoAccess = true;
            } else {
                $photoReq = PhotoRequest::where('requester_id', Auth::id())
                    ->where('target_user_id', $this->user->id)
                    ->where('status', 'approved')
                    ->first();
                $hasPhotoAccess = (bool) $photoReq || $connectionStatus === 'accepted';
            }
        }

        $hasPendingPhotoReq = Auth::check() ? (bool) PhotoRequest::where('requester_id', Auth::id())
            ->where('target_user_id', $this->user->id)
            ->where('status', 'pending')
            ->exists() : false;

        // Astrological Kundali Match Calculation
        $kundaliMatch = null;
        if (Auth::check() && Auth::id() !== $this->user->id) {
            $kundaliMatch = KundaliMatchingService::calculateMatch(Auth::user(), $this->user);
        }

        // Mutual lifestyle compatibility score
        $compatibilityScore = 85;
        if (Auth::check() && Auth::user()->preferences && $this->user->profile) {
            $pref = Auth::user()->preferences;
            $score = 50;
            if ($this->user->age >= $pref->min_age && $this->user->age <= $pref->max_age) $score += 15;
            if (is_array($pref->preferred_religions) && in_array($this->user->profile->religion_id, $pref->preferred_religions)) $score += 15;
            if (is_array($pref->preferred_castes) && in_array($this->user->profile->caste_id, $pref->preferred_castes)) $score += 10;
            if ($this->user->physical && $pref->preferred_diet !== 'any' && $this->user->physical->diet === $pref->preferred_diet) $score += 10;
            $compatibilityScore = min(100, $score);
        }

        return view('livewire.profile-detail', [
            'isLiked' => $isLiked,
            'connectionStatus' => $connectionStatus,
            'canChat' => $canChat,
            'compatibilityScore' => $compatibilityScore,
            'kundaliMatch' => $kundaliMatch,
            'isPhotoBlurred' => $isPhotoBlurred,
            'hasPhotoAccess' => $hasPhotoAccess,
            'hasPendingPhotoReq' => $hasPendingPhotoReq,
        ])->layout('components.layouts.app', ['title' => $this->user->name . ' - Matrimonial Profile | MeroZodi']);
    }
}
