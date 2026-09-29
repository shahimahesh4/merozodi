<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Caste;
use App\Models\City;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\SiteSetting;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

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
        $featuredProfiles = Auth::check()
            ? User::with(['profile', 'profile.religion', 'profile.caste', 'education', 'education.occupation'])
                ->where('role', 'user')
                ->where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->take(8)
                ->get()
            : collect();

        $religions = \Illuminate\Support\Facades\Cache::remember('master_religions', 86400, fn() => Religion::all());
        $castes = \Illuminate\Support\Facades\Cache::remember('master_castes', 86400, fn() => Caste::all());
        $cities = \Illuminate\Support\Facades\Cache::remember('master_cities', 86400, fn() => City::all());
        $occupations = \Illuminate\Support\Facades\Cache::remember('master_occupations', 86400, fn() => Occupation::all());
        
        $latestBlogs = Blog::with('author')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $plans = \Illuminate\Support\Facades\Cache::remember('active_plans_3', 3600, fn() => 
            SubscriptionPlan::where('is_active', true)->orderBy('price_npr', 'asc')->take(3)->get()
        );

        $settings = SiteSetting::allCached();

        $heroTrustBadges = isset($settings['hero_trust_badges']) 
            ? json_decode($settings['hero_trust_badges'], true) 
            : [
                ['icon' => 'fa-circle-check', 'text' => '100% ID Verified', 'color' => 'text-emerald-400'],
                ['icon' => 'fa-shield-halved', 'text' => 'Photo Privacy Shield', 'color' => 'text-indigo-400'],
                ['icon' => 'fa-moon', 'text' => '36 Gun Vedic Milan', 'color' => 'text-amber-300'],
                ['icon' => 'fa-earth-americas', 'text' => 'Diaspora Hubs', 'color' => 'text-rose-400'],
            ];

        $howItWorksSteps = isset($settings['how_it_works_steps']) 
            ? json_decode($settings['how_it_works_steps'], true) 
            : [];

        $kundaliFeatures = isset($settings['kundali_features']) 
            ? json_decode($settings['kundali_features'], true) 
            : ['Rashi Compatibility', 'Manglik Dosha Audit', 'Gotra Alignment', 'Ashtakoota Analysis'];

        $trustPillars = isset($settings['why_choose_pillars']) 
            ? json_decode($settings['why_choose_pillars'], true) 
            : [];

        $bottomCtaBadges = isset($settings['bottom_cta_badges']) 
            ? json_decode($settings['bottom_cta_badges'], true) 
            : [
                ['icon' => 'fa-circle-check', 'text' => 'Free Registration'],
                ['icon' => 'fa-shield-halved', 'text' => '100% Privacy Control'],
                ['icon' => 'fa-id-card', 'text' => 'KYC ID Verified Members']
            ];

        $faqs = isset($settings['homepage_faqs']) 
            ? json_decode($settings['homepage_faqs'], true) 
            : [];

        return view('livewire.home-page', [
            'featuredProfiles' => $featuredProfiles,
            'religions' => $religions,
            'castes' => $castes,
            'cities' => $cities,
            'occupations' => $occupations,
            'latestBlogs' => $latestBlogs,
            'plans' => $plans,
            'settings' => $settings,
            'heroTrustBadges' => $heroTrustBadges,
            'howItWorksSteps' => $howItWorksSteps,
            'kundaliFeatures' => $kundaliFeatures,
            'trustPillars' => $trustPillars,
            'bottomCtaBadges' => $bottomCtaBadges,
            'faqs' => $faqs,
        ])->layout('components.layouts.app', [
            'title' => 'MeroZodi - Nepal\'s Leading Matrimony & Matchmaking Platform | 100% Verified Nepali Singles',
        ]);
    }
}
