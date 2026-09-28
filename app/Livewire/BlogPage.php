<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPage extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

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
        ])->layout('layouts.app', ['title' => 'Matrimonial Advice, Culture & Guides - MeroZodi Blog']);
    }
}
