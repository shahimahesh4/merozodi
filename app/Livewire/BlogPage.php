<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPage extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Blog::query()
            ->with('author')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('summary', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        $featuredBlog = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->first();

        $blogs = $query->paginate(6);

        return view('livewire.blog-page', [
            'blogs' => $blogs,
            'featuredBlog' => $featuredBlog,
        ])->layout('components.layouts.app', ['title' => 'Matrimonial Advice, Culture & Guides - MeroZodi Blog']);
    }
}
