<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        $page = Page::where('slug', 'privacy-policy')->where('is_published', true)->first();

        return view('livewire.privacy-policy', [
            'page' => $page,
        ])->layout('components.layouts.app', [
            'title' => ($page->meta_title ?? 'Privacy Policy & Data Protection') . ' - MeroZodi',
        ]);
    }
}
