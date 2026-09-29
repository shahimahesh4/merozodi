@push('meta')
    <!-- Article Schema.org Structured Data -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog->title,
        'description' => $seoDescription,
        'image' => $seoImage,
        'datePublished' => ($blog->published_at ?? $blog->created_at)->toIso8601String(),
        'dateModified' => $blog->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Organization',
            'name' => 'MeroZodi Matchmaking Editorial Desk',
            'url' => url('/'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'MeroZodi Matrimony',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png'),
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url()->current(),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

<div class="bg-slate-50 min-h-screen py-8 sm:py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs & Share Actions Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <nav class="text-xs text-slate-400 flex items-center gap-2" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-rose-600 transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[11px]"></i> Home
                </a>
                <span>/</span>
                <a href="{{ route('blog') }}" class="hover:text-rose-600 transition">Guides & Advice</a>
                <span>/</span>
                <span class="text-slate-800 font-bold truncate max-w-[200px] sm:max-w-[300px]">{{ $blog->title }}</span>
            </nav>

            <div class="flex items-center gap-2.5">
                <span class="text-xs font-bold text-slate-400 mr-1">Share:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-8 h-8 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white border border-emerald-200/80 flex items-center justify-center transition shadow-2xs text-xs" 
                   title="Share on WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-8 h-8 rounded-xl bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-200/80 flex items-center justify-center transition shadow-2xs text-xs" 
                   title="Share on Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-900 text-slate-700 hover:text-white border border-slate-200 flex items-center justify-center transition shadow-2xs text-xs" 
                   title="Share on X (Twitter)">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <button type="button" 
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Article link copied to clipboard!');" 
                        class="w-8 h-8 rounded-xl bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200/80 flex items-center justify-center transition shadow-2xs text-xs" 
                        title="Copy Article Link">
                    <i class="fa-solid fa-link"></i>
                </button>
            </div>
        </div>

        <!-- Article Card Container -->
        <article class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm p-6 sm:p-10 lg:p-12 space-y-8">
            
            <!-- Article Header -->
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 font-bold text-xs border border-rose-200/60 shadow-2xs">
                        <i class="fa-solid fa-gem text-rose-500 text-[10px]"></i> Matrimonial Guide
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1 font-semibold text-slate-600">
                        <i class="fa-regular fa-calendar text-slate-400"></i>
                        {{ ($blog->published_at ?? $blog->created_at)->format('F d, Y') }}
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1 font-semibold text-slate-600">
                        <i class="fa-regular fa-clock text-slate-400"></i>
                        {{ $readingMinutes }} Min Read
                    </span>
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $blog->title }}
                </h1>

                @if($blog->summary)
                    <div class="p-4 sm:p-5 rounded-2xl bg-rose-50/50 border border-rose-100 flex items-start gap-3.5 mt-4">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-sm shrink-0 font-bold">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">
                            {{ $blog->summary }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Featured Image -->
            @if($blog->featured_image)
                <div class="rounded-2xl sm:rounded-3xl overflow-hidden shadow-md border border-slate-100 max-h-[480px] aspect-16/9 sm:aspect-21/9 bg-slate-900">
                    <img src="{{ str_starts_with($blog->featured_image, 'http') || str_starts_with($blog->featured_image, 'images/') ? asset($blog->featured_image) : asset('storage/' . $blog->featured_image) }}" 
                         alt="{{ $blog->title }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Article Body Content (Rich Markdown Typography) -->
            <div class="prose prose-slate lg:prose-lg max-w-none text-slate-700 leading-relaxed text-sm sm:text-base prose-headings:font-black prose-headings:tracking-tight prose-headings:text-slate-900 prose-h2:text-2xl sm:prose-h2:text-3xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:border-b prose-h2:border-slate-100 prose-h2:pb-3 prose-h3:text-lg sm:prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3 prose-h3:text-slate-900 prose-p:text-slate-600 prose-p:leading-relaxed prose-p:my-4 prose-ul:my-4 prose-ul:space-y-2 prose-li:text-slate-600 prose-li:leading-relaxed prose-ol:my-4 prose-ol:space-y-2 prose-ol:list-decimal prose-strong:text-slate-900 prose-strong:font-black prose-hr:my-8 prose-hr:border-slate-200">
                {!! \Illuminate\Support\Str::markdown($blog->content) !!}
            </div>

            <!-- In-Article Matrimonial Action Banner -->
            <div class="rounded-3xl bg-gradient-to-r from-rose-900 via-rose-800 to-amber-900 text-white p-6 sm:p-8 shadow-lg relative overflow-hidden flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-2 relative z-10 text-center sm:text-left">
                    <span class="inline-flex items-center gap-1.5 bg-white/10 px-3 py-1 rounded-full text-xs font-bold text-rose-200 backdrop-blur-sm">
                        <i class="fa-solid fa-heart text-rose-400"></i> Begin Your Journey
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-white">Find Your Verified Life Partner</h3>
                    <p class="text-xs text-rose-100/90 max-w-md">
                        Join over 2,000+ verified Nepali singles across Nepal, Australia, USA, and UK. Free registration with 100% privacy control.
                    </p>
                </div>
                <div class="relative z-10 shrink-0 w-full sm:w-auto">
                    <a href="{{ route('register') }}" class="btn bg-white hover:bg-rose-50 text-rose-700 font-black border-none rounded-2xl px-6 py-3 shadow-md transition transform hover:-translate-y-0.5 w-full sm:w-auto text-xs sm:text-sm">
                        <i class="fa-solid fa-user-plus mr-1.5"></i> Register Free Today
                    </a>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-10 text-white pointer-events-none text-9xl">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
            </div>

            <!-- Author Bio Card -->
            <div class="p-6 sm:p-7 rounded-3xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row items-center sm:items-start gap-4 text-center sm:text-left">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-600 to-pink-600 text-white flex items-center justify-center font-black text-xl shadow-md shadow-rose-200 shrink-0">
                    MZ
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h4 class="font-black text-sm text-slate-900">MeroZodi Matchmaking Research & Editorial Desk</h4>
                        <span class="badge badge-success badge-xs font-bold text-white px-2 py-0.5"><i class="fa-solid fa-check text-[9px] mr-1"></i> Verified</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Curating authentic cultural insights, Vedic Kundali compatibility analyses, and relationship advice to empower Nepali singles and families worldwide.
                    </p>
                </div>
            </div>

            <!-- Bottom Share & Back Bar -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('blog') }}" class="btn btn-ghost btn-sm gap-2 text-xs font-bold text-slate-600 hover:text-rose-600 rounded-xl">
                    <i class="fa-solid fa-arrow-left"></i> Back to All Guides
                </a>
                <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                    <span>Enjoyed this article? Share with your friends & family!</span>
                </div>
            </div>

        </article>

        <!-- Recommended Matrimonial Guides (Uniform Grid) -->
        @if($relatedBlogs->count() > 0)
            <div class="mt-14 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-rose-600 uppercase tracking-wider">Explore More</span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">Recommended Matrimonial Guides</h3>
                    </div>
                    <a href="{{ route('blog') }}" class="text-xs font-bold text-rose-600 hover:underline flex items-center gap-1">
                        View All <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedBlogs as $rel)
                        <a href="{{ route('blog.detail', $rel->slug) }}" class="bg-white rounded-3xl p-4 border border-slate-200/80 shadow-2xs hover:shadow-xl hover:border-rose-300 transition-all duration-300 block group flex flex-col justify-between transform hover:-translate-y-1">
                            <div>
                                <div class="h-44 rounded-2xl overflow-hidden mb-3.5 relative bg-slate-100">
                                    <img src="{{ $rel->featured_image }}" 
                                         alt="{{ $rel->title }}" 
                                         onerror="this.onerror=null; this.src='{{ asset('images/blogs/blog-tradition-modernity.jpg') }}';"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <span class="absolute top-2.5 left-2.5 bg-white/95 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[10px] font-bold text-slate-700 shadow-xs border border-white/40">
                                        Guide
                                    </span>
                                </div>
                                <h4 class="text-sm font-black text-slate-900 group-hover:text-rose-600 line-clamp-2 transition leading-snug">
                                    {{ $rel->title }}
                                </h4>
                                <p class="text-xs text-slate-500 line-clamp-2 mt-1.5 leading-relaxed">
                                    {{ $rel->summary }}
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 font-semibold">
                                <span>{{ $rel->published_at ? $rel->published_at->format('M d, Y') : 'Recent' }}</span>
                                <span class="text-rose-600 font-bold group-hover:translate-x-1 transition-transform">Read Article &rarr;</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
