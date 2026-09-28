<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class DynamicPage extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $page = Page::where('slug', $this->slug)->where('is_published', true)->firstOrFail();

        return view('livewire.dynamic-page', [
            'page' => $page,
        ])->layout('components.layouts.app', [
            'title' => ($page->meta_title ?? $page->title) . ' - MeroZodi',
        ]);
    }
}
