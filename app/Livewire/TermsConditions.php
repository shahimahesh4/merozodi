<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class TermsConditions extends Component
{
    public function render()
    {
        $page = Page::where('slug', 'terms-and-conditions')->where('is_published', true)->first();

        return view('livewire.terms-conditions', [
            'page' => $page,
        ])->layout('components.layouts.app', [
            'title' => ($page->meta_title ?? 'Terms & Conditions of Service') . ' - MeroZodi',
        ]);
    }
}
