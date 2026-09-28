<?php

namespace App\Livewire;

use App\Models\Caste;
use App\Models\City;
use App\Models\ConnectRequest;
use App\Models\EducationLevel;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\User;
use App\Models\UserLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BrowseProfiles extends Component
{
    use WithPagination;

    public $searchQuery = '';
    public $gender = '';
    public $profile_created_by = '';
    public $marital_status = '';
    public $religion = '';
    public $caste = '';
    public $city = '';
    public $minAge = 18;
    public $maxAge = 50;
    public $education_level = '';
    public $occupation = '';
    public $diet = '';
    public $manglik = '';
    public $verifiedOnly = false;
    public $tierTab = 'all'; // 'all', 'mutual', 'reverse', 'verified', 'newest'

    // Selected profile for inspection modal
    public $selectedProfileId = null;

    protected $queryString = [
        'gender' => ['except' => ''],
        'profile_created_by' => ['except' => ''],
        'marital_status' => ['except' => ''],
        'tierTab' => ['except' => 'all'],
        'religion' => ['except' => ''],
        'caste' => ['except' => ''],
        'city' => ['except' => ''],
        'minAge' => ['except' => 18],
        'maxAge' => ['except' => 50],
    ];

    public function mount()
    {
        if (Auth::check() && empty($this->gender)) {
            // Default to opposite gender of logged in user
            $this->gender = Auth::user()->gender === 'male' ? 'female' : 'male';
        }
    }

    public function resetFilters()
    {
        $this->reset([
            'searchQuery', 'profile_created_by', 'marital_status', 'religion', 'caste', 'city',
            'minAge', 'maxAge', 'education_level', 'occupation',
            'diet', 'manglik', 'verifiedOnly'
        ]);
        $this->resetPage();
    }

    public function toggleLike($userId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existing = UserLike::where('liker_id', Auth::id())
            ->where('liked_id', $userId)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            UserLike::create([
                'liker_id' => Auth::id(),
                'liked_id' => $userId,
            ]);
        }
    }

    public function sendConnect($userId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existing = ConnectRequest::where('sender_id', Auth::id())
            ->where('receiver_id', $userId)
            ->first();

        if (!$existing) {
            ConnectRequest::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $userId,
                'status' => 'pending',
            ]);
        }
    }

    public function viewProfile($userId)
    {
        $this->selectedProfileId = $userId;
    }

    public function closeProfileModal()
    {
        $this->selectedProfileId = null;
    }

    public function render()
    {
        $query = User::with([
            'profile', 'profile.religion', 'profile.caste',
            'physical', 'education', 'education.educationLevel', 'education.occupation',
            'family', 'sentLikes', 'receivedConnects'
        ])
        ->where('role', 'user')
        ->where('status', 'active');

        if (Auth::check()) {
            $query->where('id', '!=', Auth::id());
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        if ($this->profile_created_by) {
            $query->where(function($q) {
                $status = $this->profile_created_by;
                $aliases = match($status) {
                    'parents' => ['parents', 'parent'],
                    'sibling' => ['sibling', 'brother', 'sister'],
                    default => [$status],
                };
                $q->whereIn('profile_created_by', $aliases)
                  ->orWhereHas('profile', fn($pq) => $pq->whereIn('profile_created_by', $aliases));
            });
        }

        if ($this->marital_status) {
            $query->where(function($q) {
                $status = $this->marital_status;
                $aliases = match($status) {
                    'unmarried' => ['unmarried', 'never_married'],
                    'widow' => ['widow', 'widowed'],
                    default => [$status],
                };
                $q->whereIn('marital_status', $aliases)
                  ->orWhereHas('profile', fn($pq) => $pq->whereIn('marital_status', $aliases));
            });
        }

        if ($this->tierTab === 'verified' || $this->verifiedOnly) {
            $query->where('is_verified', true);
        }

        if ($this->tierTab === 'newest') {
            $query->where('created_at', '>=', now()->subDays(60));
        }

        if ($this->tierTab === 'mutual' && Auth::check() && Auth::user()->preferences) {
            $pref = Auth::user()->preferences;
            if (is_array($pref->preferred_religions) && count($pref->preferred_religions)) {
                $query->whereHas('profile', fn($q) => $q->whereIn('religion_id', $pref->preferred_religions));
            }
            if ($pref->preferred_diet && $pref->preferred_diet !== 'any') {
                $query->whereHas('physical', fn($q) => $q->where('diet', $pref->preferred_diet));
            }
        }

        if ($this->searchQuery) {
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        }

        if ($this->religion) {
            $query->whereHas('profile', fn($q) => $q->where('religion_id', $this->religion));
        }

        if ($this->caste) {
            $query->whereHas('profile', fn($q) => $q->where('caste_id', $this->caste));
        }

        if ($this->city) {
            $query->whereHas('profile', fn($q) => $q->where('living_city', $this->city));
        }

        if ($this->manglik) {
            $query->whereHas('profile', fn($q) => $q->where('manglik', $this->manglik));
        }

        if ($this->education_level) {
            $query->whereHas('education', fn($q) => $q->where('education_level_id', $this->education_level));
        }

        if ($this->occupation) {
            $query->whereHas('education', fn($q) => $q->where('occupation_id', $this->occupation));
        }

        if ($this->diet) {
            $query->whereHas('physical', fn($q) => $q->where('diet', $this->diet));
        }

        $profiles = $query->latest()->paginate(9);

        $selectedProfile = $this->selectedProfileId
            ? User::with(['profile', 'profile.religion', 'profile.caste', 'physical', 'education', 'family'])->find($this->selectedProfileId)
            : null;

        $religions = Religion::all();
        $castes = $this->religion
            ? Caste::where('religion_id', $this->religion)->get()
            : Caste::all();
        $cities = City::all();
        $eduLevels = EducationLevel::all();
        $occupations = Occupation::all();

        $myLikes = Auth::check()
            ? UserLike::where('liker_id', Auth::id())->pluck('liked_id')->toArray()
            : [];

        $myConnects = Auth::check()
            ? ConnectRequest::where('sender_id', Auth::id())->pluck('status', 'receiver_id')->toArray()
            : [];

        return view('livewire.browse-profiles', [
            'profiles' => $profiles,
            'selectedProfile' => $selectedProfile,
            'religions' => $religions,
            'castes' => $castes,
            'cities' => $cities,
            'eduLevels' => $eduLevels,
            'occupations' => $occupations,
            'myLikes' => $myLikes,
            'myConnects' => $myConnects,
        ])->layout('components.layouts.app', ['title' => 'Browse & Match Profiles - MeroZodi']);
    }
}
