<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="text-center max-w-5xl mx-auto mb-10 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-rose-100 text-rose-700 text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-feather-pointed"></i> MeroZodi Editorial & Guides
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-[44px] font-black text-slate-900 tracking-tight leading-tight whitespace-normal md:whitespace-nowrap">
                Nepali Matrimony & Relationship Advice
            </h1>
            <p class="text-sm md:text-base text-slate-500 max-w-3xl mx-auto">
                Insights on Kundali matching, family expectations, cross-border NRI dating, and inspiring true stories of couples who found true love on MeroZodi.
            </p>

            <!-- Search Bar -->
            <div class="pt-4 max-w-md mx-auto">
                <div class="relative">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search guides, astrology, tips..." class="input input-bordered w-full rounded-2xl pl-10 text-xs shadow-sm bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>
        </div>

        <!-- Featured Article Hero (When no search query is active) -->
        @if(empty($search) && $featuredBlog)
            <div class="mb-12 bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl hover:shadow-2xl transition duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-7 relative h-72 lg:h-auto min-h-[320px]">
                        <img src="{{ !empty($featuredBlog->featured_image) ? (str_starts_with($featuredBlog->featured_image, 'http') || str_starts_with($featuredBlog->featured_image, 'images/') ? asset($featuredBlog->featured_image) : asset('storage/' . $featuredBlog->featured_image)) : asset('images/blogs/blog-kundali-matching.jpg') }}" alt="{{ $featuredBlog->title }}" onerror="this.onerror=null; this.src='{{ asset('images/blogs/blog-kundali-matching.jpg') }}';" class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="badge badge-primary font-bold text-xs uppercase px-3 py-2 text-white shadow-md">
                                <i class="fa-solid fa-star mr-1"></i> Featured Guide
                            </span>
                        </div>
                    </div>
                    <div class="lg:col-span-5 p-8 lg:p-10 flex flex-col justify-between space-y-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="font-bold text-slate-700">{{ $featuredBlog->author->name ?? 'MeroZodi Editorial' }}</span>
                                <span>•</span>
                                <span>{{ $featuredBlog->published_at ? $featuredBlog->published_at->format('M d, Y') : 'Recent' }}</span>
                            </div>
                            <h2 class="text-2xl font-black text-slate-900 leading-snug hover:text-rose-600 transition">
                                <a href="{{ route('blog.detail', $featuredBlog->slug) }}">{{ $featuredBlog->title }}</a>
                            </h2>
                            <p class="text-sm text-slate-500 leading-normal line-clamp-3">
                                {{ $featuredBlog->summary }}
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('blog.detail', $featuredBlog->slug) }}" class="btn btn-primary btn-sm rounded-xl font-bold shadow-md shadow-rose-200">
                                Read Full Article <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Blog Grid -->
        @if($blogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <article class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ !empty($blog->featured_image) ? (str_starts_with($blog->featured_image, 'http') || str_starts_with($blog->featured_image, 'images/') ? asset($blog->featured_image) : asset('storage/' . $blog->featured_image)) : asset('images/blogs/blog-tradition-modernity.jpg') }}" alt="{{ $blog->title }}" onerror="this.onerror=null; this.src='{{ asset('images/blogs/blog-tradition-modernity.jpg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-2 text-[11px] text-slate-400">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>5 min read</span>
                                </div>
                                <h3 class="text-base font-black text-slate-900 line-clamp-2 leading-snug group-hover:text-rose-600 transition">
                                    <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="text-sm text-slate-500 line-clamp-3 leading-normal">
                                    {{ $blog->summary }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-700">By {{ $blog->author->name ?? 'MeroZodi Team' }}</span>
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="text-xs font-extrabold text-rose-600 group-hover:translate-x-1 transition inline-flex items-center gap-1">
                                    Read <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <h3 class="text-base font-black text-slate-800">No Articles Found</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">No matrimonial guides matched your search query "{{ $search }}".</p>
                <button wire:click="$set('search', '')" class="btn btn-neutral btn-sm rounded-xl text-xs font-bold mt-4">
                    View All Articles
                </button>
            </div>
        @endif

    </div>
</div>
