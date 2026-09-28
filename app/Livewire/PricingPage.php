<?php

namespace App\Livewire;

use App\Models\SubscriptionPlan;
use Livewire\Component;

class PricingPage extends Component
{
    public function render()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();

        return view('livewire.pricing-page', [
            'plans' => $plans,
        ])->layout('components.layouts.app', ['title' => 'Membership Packages & Pricing - MeroZodi']);
    }
}
