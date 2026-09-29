<?php

namespace App\Livewire;

use App\Models\Blog;
use Illuminate\Support\Str;
use Livewire\Component;

class BlogDetail extends Component
{
    public Blog $blog;
    public $relatedBlogs = [];
    public int $readingMinutes = 3;

    public function mount($slug)
    {
        $this->blog = Blog::with('author')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $wordCount = str_word_count(strip_tags($this->blog->content));
        $this->readingMinutes = max(1, (int) ceil($wordCount / 200));

        $this->relatedBlogs = Blog::where('id', '!=', $this->blog->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();
    }

    public function render()
    {
        $seoTitle = $this->blog->title . ' - Nepali Matrimony Guides | MeroZodi';
        $seoDescription = $this->blog->summary ?: Str::limit(strip_tags($this->blog->content), 160);
        $seoImage = $this->blog->featured_image ?: asset('images/nepali-wedding-banner.png');

        return view('livewire.blog-detail', [
            'readingMinutes' => $this->readingMinutes,
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'seoImage' => $seoImage,
        ])->layout('components.layouts.app', [
            'title' => $seoTitle,
            'description' => $seoDescription,
            'ogImage' => $seoImage,
            'ogType' => 'article',
        ]);
    }
}
