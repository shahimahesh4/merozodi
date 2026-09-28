<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        $page = Page::where('slug', 'about-us')->where('is_published', true)->first();

        $seoTitle = $page->meta_title ?? "About Us - Nepal's Leading Matrimonial & Matchmaking Platform | MeroZodi";
        $seoDescription = $page->meta_description ?? "Learn more about MeroZodi, Nepal's #1 trusted matrimonial platform. Connecting 100% ID-verified Nepali singles & families worldwide with authentic Vedic 36 Gun Milan.";
        $seoImage = $page->banner_image ?? asset('images/about-us-banner.png');

        return view('livewire.about-us', [
            'page' => $page,
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'seoImage' => $seoImage,
        ])->layout('components.layouts.app', [
            'title' => $seoTitle,
            'description' => $seoDescription,
            'ogImage' => $seoImage,
        ]);
    }
}
