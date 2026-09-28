<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Caste;
use App\Models\City;
use App\Models\Religion;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Livewire\Component;

class HomePage extends Component
{
    public $searchMode = 'quick'; // 'quick' or 'astrology'
    public $lookingFor = 'female';
    public $religion = '';
    public $caste = '';
    public $city = '';
    public $minAge = 20;
    public $maxAge = 35;
    public $manglik = '';
    public $searchQuery = '';

    public function search()
    {
        $params = [
            'gender' => $this->lookingFor,
            'minAge' => $this->minAge,
            'maxAge' => $this->maxAge,
        ];

        if (!empty($this->religion)) {
            $params['religion'] = $this->religion;
        }
        if (!empty($this->caste)) {
            $params['caste'] = $this->caste;
        }
        if (!empty($this->city)) {
            $params['city'] = $this->city;
        }
        if (!empty($this->manglik)) {
            $params['manglik'] = $this->manglik;
        }
        if (!empty($this->searchQuery)) {
            $params['searchQuery'] = $this->searchQuery;
        }

        return redirect()->route('browse', $params);
    }

    public function render()
    {
        $featuredProfiles = User::with(['profile', 'profile.religion', 'profile.caste', 'education', 'education.occupation'])
            ->where('role', 'user')
            ->where('is_verified', true)
            ->latest()
            ->take(8)
            ->get();

        $religions = Religion::all();
        $castes = Caste::all();
        $cities = City::all();
        
        $latestBlogs = Blog::with('author')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('price', 'asc')
            ->take(3)
            ->get();

        return view('livewire.home-page', [
            'featuredProfiles' => $featuredProfiles,
            'religions' => $religions,
            'castes' => $castes,
            'cities' => $cities,
            'latestBlogs' => $latestBlogs,
            'plans' => $plans,
        ])->layout('components.layouts.app', [
            'title' => 'MeroZodi - Nepal\'s Leading Matrimony & Matchmaking Platform | 100% Verified Nepali Singles',
        ]);
    }
}
