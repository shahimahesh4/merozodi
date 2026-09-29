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
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BrowseProfiles extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public $searchQuery = '';

    #[Url(except: '')]
    public $gender = '';

    #[Url(as: 'creator', except: '')]
    public $profile_created_by = '';

    #[Url(as: 'status', except: '')]
    public $marital_status = '';

    #[Url(as: 'religion', except: '')]
    public $religion = '';

    #[Url(as: 'caste', except: '')]
    public $caste = '';

    #[Url(as: 'city', except: '')]
    public $city = '';

    #[Url(as: 'min_age', except: 18)]
    public $minAge = 18;

    #[Url(as: 'max_age', except: 50)]
    public $maxAge = 50;

    #[Url(as: 'edu', except: '')]
    public $education_level = '';

    #[Url(as: 'occ', except: '')]
    public $occupation = '';

    #[Url(as: 'diet', except: '')]
    public $diet = '';

    #[Url(as: 'manglik', except: '')]
    public $manglik = '';

    #[Url(as: 'verified', except: false)]
    public $verifiedOnly = false;

    #[Url(as: 'tab', except: 'all')]
    public $tierTab = 'all'; // 'all', 'mutual', 'reverse', 'verified', 'newest'

    // Selected profile for inspection modal
    public $selectedProfileId = null;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (empty($this->gender)) {
            // Default to opposite gender of logged in user
            $this->gender = Auth::user()->gender === 'male' ? 'female' : 'male';
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, [
            'searchQuery', 'gender', 'profile_created_by', 'marital_status', 'religion', 'caste',
            'city', 'minAge', 'maxAge', 'education_level', 'occupation', 'diet', 'manglik',
            'verifiedOnly', 'tierTab'
        ])) {
            $this->resetPage();
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
        ->where('status', 'active')
        ->where('is_verified', true);

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

        $profiles = $query->latest()->paginate(30);

        $selectedProfile = $this->selectedProfileId
            ? User::with(['profile', 'profile.religion', 'profile.caste', 'physical', 'education', 'family'])->find($this->selectedProfileId)
            : null;

        $religions = \Illuminate\Support\Facades\Cache::remember('master_religions', 86400, fn() => Religion::all());
        $castes = $this->religion
            ? Caste::where('religion_id', $this->religion)->get()
            : \Illuminate\Support\Facades\Cache::remember('master_castes', 86400, fn() => Caste::all());
        $cities = \Illuminate\Support\Facades\Cache::remember('master_cities', 86400, fn() => City::all());
        $eduLevels = \Illuminate\Support\Facades\Cache::remember('master_edu_levels', 86400, fn() => EducationLevel::all());
        $occupations = \Illuminate\Support\Facades\Cache::remember('master_occupations', 86400, fn() => Occupation::all());

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
