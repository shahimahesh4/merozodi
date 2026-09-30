<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    
    @php
        $siteFavicon = !empty($globalSettings['site_favicon']) ? (str_starts_with($globalSettings['site_favicon'], 'http') ? $globalSettings['site_favicon'] : asset($globalSettings['site_favicon'])) : asset('images/logo.png');
        $siteLogo = !empty($globalSettings['site_logo']) ? (str_starts_with($globalSettings['site_logo'], 'http') ? $globalSettings['site_logo'] : asset($globalSettings['site_logo'])) : asset('images/logo.png');
        $siteName = $globalSettings['site_name'] ?? 'MeroZodi';
        $siteTagline = $globalSettings['tagline'] ?? "Nepal's Leading Matrimony & Matchmaking Platform";
        $defaultTitle = $siteName . ' - ' . $siteTagline;
        $defaultDesc = $globalSettings['site_description'] ?? 'Find your ideal life partner with MeroZodi. 100% KYC ID-verified Nepali singles across Nepal, Australia, USA, UK, and worldwide with photo privacy shield and private video dating.';
    @endphp

    <!-- Primary SEO Meta Tags -->
    <title>{{ $title ?? $defaultTitle }}</title>
    <meta name="description" content="{{ $description ?? $defaultDesc }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#e11d48">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ $siteFavicon }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $siteFavicon }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:title" content="{{ $title ?? $defaultTitle }}">
    <meta property="og:description" content="{{ $description ?? $defaultDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="en_NP">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/nepali-wedding-banner.png') }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="{{ $title ?? $defaultTitle }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? $defaultTitle }}">
    <meta name="twitter:description" content="{{ $description ?? $defaultDesc }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/nepali-wedding-banner.png') }}">
    <meta name="twitter:image:alt" content="{{ $title ?? $defaultTitle }}">

    <!-- Mobile Web App & PWA Meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="{{ $siteName }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <!-- DNS Prefetch & Preconnect for External CDNs -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Dynamic Page Meta & SEO Schema -->
    @stack('meta')

    <!-- Styles and Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body x-data="{ mobileDrawerOpen: false }" class="bg-slate-50 text-slate-800 font-['Plus_Jakarta_Sans',sans-serif] min-h-screen flex flex-col justify-between antialiased selection:bg-rose-500 selection:text-white pb-20 md:pb-0 overflow-x-hidden">
    
    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                
                <!-- Mobile Left: Drawer Toggle Button -->
                <div class="flex items-center gap-2 md:hidden">
                    <button @click="mobileDrawerOpen = true" class="btn btn-ghost btn-circle btn-sm text-slate-700 hover:text-rose-600 tap-active" aria-label="Open Navigation Menu">
                        <i class="fa-solid fa-bars-staggered text-lg"></i>
                    </button>
                </div>

                <!-- Brand Logo -->
                <a wire:navigate href="{{ route('home') }}" class="flex items-center gap-2 group py-1" title="{{ $siteName }}">
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="h-9 sm:h-11 md:h-14 w-auto object-contain transition transform group-hover:scale-105">
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a wire:navigate href="{{ route('home') }}" class="group hover:text-rose-600 transition flex items-center gap-1.5 {{ request()->routeIs('home') ? 'text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-house text-xs transition-colors {{ request()->routeIs('home') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Home
                    </a>
                    <a wire:navigate href="{{ route('browse') }}" class="group hover:text-rose-600 transition flex items-center gap-1.5 {{ request()->routeIs('browse') ? 'text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-compass text-xs transition-colors {{ request()->routeIs('browse') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Find Matches
                    </a>
                    <a wire:navigate href="{{ route('events') }}" class="group hover:text-rose-600 transition flex items-center gap-1.5 {{ request()->routeIs('events') ? 'text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-calendar-days text-xs transition-colors {{ request()->routeIs('events') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Events
                    </a>
                    <a wire:navigate href="{{ route('blog') }}" class="group hover:text-rose-600 transition flex items-center gap-1.5 {{ request()->routeIs('blog*') ? 'text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-book-open text-xs transition-colors {{ request()->routeIs('blog*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Guides & Stories
                    </a>
                    <a wire:navigate href="{{ route('pricing') }}" class="group hover:text-rose-600 transition flex items-center gap-1.5 {{ request()->routeIs('pricing') ? 'text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-crown text-xs transition-colors {{ request()->routeIs('pricing') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Membership
                    </a>
                </nav>

                <!-- Header Actions (Desktop & Mobile) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <!-- Message Icon with Real-Time Livewire Unread Counter -->
                        <a wire:navigate href="{{ route('messages') }}" class="btn btn-ghost btn-circle btn-sm text-slate-700 hover:text-rose-600 relative tap-active" title="Messages">
                            <i class="fa-solid fa-comments text-base"></i>
                            @livewire('unread-counter', ['type' => 'header'])
                        </a>

                        <!-- Dashboard Shortcut for Desktop -->
                        <a wire:navigate href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm text-xs font-bold text-slate-700 hidden sm:inline-flex rounded-xl">
                            <i class="fa-solid fa-gauge mr-1 text-slate-400"></i> Dashboard
                        </a>

                        <!-- User Profile Dropdown -->
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar tap-active relative">
                                <div class="w-9 sm:w-10 rounded-full ring-2 ring-rose-500 ring-offset-2">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="object-cover" />
                                </div>
                                <span class="absolute top-0 right-0 w-3 h-3 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                            </div>
                            <ul tabindex="0" class="mt-3 z-50 p-2 shadow-2xl menu menu-sm dropdown-content bg-base-100 rounded-2xl w-64 border border-slate-100">
                                <li class="menu-title px-4 py-3 border-b border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-xs">
                                            {{ substr(auth()->user()->name, 0, 1) }}
                                        </div>
                                        <div class="truncate">
                                            <span class="font-extrabold text-slate-900 block truncate">{{ auth()->user()->name }}</span>
                                            <span class="text-[10px] text-slate-400 block truncate">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                    @if(auth()->user()->is_verified)
                                        <span class="badge badge-success badge-xs text-white font-bold text-[9px] mt-1">
                                            <i class="fa-solid fa-circle-check mr-1"></i> Verified Member
                                        </span>
                                    @endif
                                </li>
                                <li><a wire:navigate href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge text-slate-500"></i> My Dashboard</a></li>
                                <li><a wire:navigate href="{{ route('my-profile') }}"><i class="fa-solid fa-user-pen text-slate-500"></i> Edit Profile</a></li>
                                <li><a wire:navigate href="{{ route('my-gallery') }}"><i class="fa-solid fa-images text-slate-500"></i> Photo Gallery</a></li>
                                <li><a wire:navigate href="{{ route('my-kyc') }}"><i class="fa-solid fa-id-card text-slate-500"></i> KYC Document Verification</a></li>
                                <li><a wire:navigate href="{{ route('my-activity') }}"><i class="fa-solid fa-heart text-rose-500"></i> Activity & Interests</a></li>
                                <li><a wire:navigate href="{{ route('messages') }}"><i class="fa-solid fa-comments text-rose-500"></i> Chat Messages</a></li>
                                <li><a wire:navigate href="{{ route('browse') }}"><i class="fa-solid fa-compass text-slate-500"></i> Browse Matches</a></li>

                                <li class="border-t border-slate-100 mt-1">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="text-rose-600 w-full text-left flex items-center gap-2 font-bold py-2">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a wire:navigate href="{{ route('login') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 hover:text-rose-600 transition tap-active inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-right-to-bracket text-xs text-rose-500"></i>
                            <span>Log In</span>
                        </a>
                        <a wire:navigate href="{{ route('register') }}" class="px-3.5 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 rounded-xl shadow-md shadow-rose-200 transition transform hover:-translate-y-0.5 tap-active inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-user-plus text-xs"></i>
                            <span>Register Free</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Slide-Over App Drawer -->
    <div x-show="mobileDrawerOpen" 
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm md:hidden"
         style="display: none;"
         @click="mobileDrawerOpen = false">
        
        <div x-show="mobileDrawerOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-4/5 max-w-sm bg-white shadow-2xl flex flex-col justify-between z-50 overflow-y-auto"
             @click.stop>
            
            <!-- Drawer Top Profile Card -->
            <div>
                <div class="p-6 bg-gradient-to-br from-rose-600 via-rose-700 to-pink-700 text-white relative">
                    <button @click="mobileDrawerOpen = false" class="btn btn-circle btn-ghost btn-sm absolute right-4 top-4 text-white/80 hover:text-white" aria-label="Close Drawer">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>

                    @auth
                        <div class="flex items-center gap-3.5 mt-2">
                            <div class="relative shrink-0">
                                <div class="w-14 h-14 rounded-2xl ring-2 ring-white/50 overflow-hidden shadow-md">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                </div>
                                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                            </div>
                            <div class="truncate">
                                <h3 class="font-extrabold text-base truncate">{{ auth()->user()->name }}</h3>
                                <p class="text-xs text-rose-100 truncate">{{ auth()->user()->email }}</p>
                                <div class="flex items-center gap-1.5 mt-1.5">
                                    @if(auth()->user()->is_verified)
                                        <span class="badge badge-success badge-xs text-white font-black text-[9px] px-2 py-0.5">
                                             <i class="fa-solid fa-circle-check mr-1"></i> Verified
                                        </span>
                                    @endif
                                    @if(auth()->user()->is_premium)
                                        <span class="badge badge-warning badge-xs text-slate-900 font-black text-[9px] px-2 py-0.5">
                                            <i class="fa-solid fa-crown mr-1"></i> Premium
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-2 space-y-3">
                            <div class="inline-flex bg-white px-3.5 py-2 rounded-2xl shadow-md">
                                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="h-8 sm:h-9 w-auto object-contain">
                            </div>
                            <p class="text-xs text-rose-100 font-medium">Welcome to {{ $siteName }} - {{ $siteTagline }}</p>
                            <div class="flex gap-2 pt-1">
                                <a wire:navigate href="{{ route('login') }}" class="btn btn-sm bg-white hover:bg-rose-50 text-rose-600 font-bold border-none rounded-xl flex-1 shadow-sm flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-right-to-bracket text-xs"></i> Log In
                                </a>
                                <a wire:navigate href="{{ route('register') }}" class="btn btn-sm bg-rose-900/80 hover:bg-rose-950 text-white font-bold border border-white/20 rounded-xl flex-1 shadow-sm flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-user-plus text-xs"></i> Register
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- Navigation List -->
                <div class="p-4 space-y-1 text-sm font-semibold text-slate-700">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-3 py-1.5 block">Explore</span>
                    <a wire:navigate href="{{ route('home') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('home') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-house w-5 text-center transition-colors {{ request()->routeIs('home') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Home
                    </a>
                    <a wire:navigate href="{{ route('browse') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('browse') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-compass w-5 text-center transition-colors {{ request()->routeIs('browse') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Discover Matches
                    </a>
                    <a wire:navigate href="{{ route('events') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('events') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-calendar-days w-5 text-center transition-colors {{ request()->routeIs('events') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Matrimonial Events
                    </a>
                    <a wire:navigate href="{{ route('blog') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('blog*') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-book-open w-5 text-center transition-colors {{ request()->routeIs('blog*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Guides & Astrological Advice
                    </a>
                    <a wire:navigate href="{{ route('pricing') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('pricing') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-crown w-5 text-center transition-colors {{ request()->routeIs('pricing') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Membership Plans
                    </a>

                    <!-- Company & Legal -->
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-3 py-1.5 block">Information</span>
                    <a wire:navigate href="{{ route('about') }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('about*') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-circle-info w-5 text-center transition-colors {{ request()->routeIs('about*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> About MeroZodi
                    </a>
                    <a wire:navigate href="{{ route('contact') }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('contact*') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-headset w-5 text-center transition-colors {{ request()->routeIs('contact*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Contact & Support
                    </a>
                    <a wire:navigate href="{{ route('privacy') }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('privacy*') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-shield-halved w-5 text-center transition-colors {{ request()->routeIs('privacy*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Privacy Policy
                    </a>
                    <a wire:navigate href="{{ route('terms') }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('terms*') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                        <i class="fa-solid fa-file-contract w-5 text-center transition-colors {{ request()->routeIs('terms*') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Terms & Conditions
                    </a>

                    @auth
                        <div class="border-t border-slate-100 my-2 pt-2">
                            <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-3 py-1.5 block">My Account</span>
                            <a wire:navigate href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('dashboard') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-gauge w-5 text-center transition-colors {{ request()->routeIs('dashboard') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Dashboard
                            </a>
                            <a wire:navigate href="{{ route('my-profile') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('my-profile') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-user-pen w-5 text-center transition-colors {{ request()->routeIs('my-profile') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Edit Profile
                            </a>
                            <a wire:navigate href="{{ route('my-gallery') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('my-gallery') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-images w-5 text-center transition-colors {{ request()->routeIs('my-gallery') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Photo Gallery
                            </a>
                            <a wire:navigate href="{{ route('my-kyc') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('my-kyc') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-id-card w-5 text-center transition-colors {{ request()->routeIs('my-kyc') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> KYC Document Verification
                            </a>
                            <a wire:navigate href="{{ route('my-activity') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('my-activity') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-heart w-5 text-center transition-colors {{ request()->routeIs('my-activity') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Activity & Interests
                            </a>
                            <a wire:navigate href="{{ route('messages') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition {{ request()->routeIs('messages') ? 'bg-rose-50 text-rose-600 font-bold' : '' }}">
                                <i class="fa-solid fa-comments w-5 text-center transition-colors {{ request()->routeIs('messages') ? 'text-rose-600' : 'text-slate-400 group-hover:text-rose-600' }}"></i> Chat Messages
                            </a>
                        </div>
                    @endauth

                </div>
            </div>

            <!-- Drawer Bottom: Sign Out or Help -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/70">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs flex items-center justify-center gap-2 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                        </button>
                    </form>
                @else
                    <div class="text-center text-xs text-slate-400">
                        Need Help? <a wire:navigate href="{{ route('contact') }}" class="text-rose-600 font-bold">Contact Support</a>
                    </div>
                @endauth
                <div class="mt-3 pt-2.5 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-slate-400">
                    <span>{{ $siteName }} &copy; {{ date('Y') }}</span>
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-rose-100 text-rose-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                        {{ $globalSettings['app_version'] ?? 'Beta Version 2.0' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dynamic Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Mobile Bottom Floating App Navigation Bar (md:hidden) -->
    <nav class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-lg border-t border-slate-200/80 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] md:hidden bottom-nav-safe">
        <div class="grid grid-cols-5 h-14 items-center px-1">
            
            <!-- Tab 1: Home -->
            <a wire:navigate href="{{ route('home') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('home') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                <i class="fa-solid fa-house text-lg mb-0.5"></i>
                <span class="text-[10px] tracking-tight">Home</span>
            </a>

            <!-- Tab 2: Discover / Browse Matches -->
            <a wire:navigate href="{{ route('browse') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('browse') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                <i class="fa-solid fa-compass text-lg mb-0.5"></i>
                <span class="text-[10px] tracking-tight">Discover</span>
            </a>

            <!-- Tab 3: Messages with Real-Time Badge -->
            <a wire:navigate href="{{ route('messages') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('messages*') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                <div class="relative">
                    <i class="fa-solid fa-comments text-lg mb-0.5"></i>
                    @auth
                        @livewire('unread-counter', ['type' => 'bottom_nav'])
                    @endauth
                </div>
                <span class="text-[10px] tracking-tight">Messages</span>
            </a>

            <!-- Tab 4: Events -->
            <a wire:navigate href="{{ route('events') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('events') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                <i class="fa-solid fa-calendar-days text-lg mb-0.5"></i>
                <span class="text-[10px] tracking-tight">Events</span>
            </a>

            <!-- Tab 5: Profile / Dashboard or Login -->
            @auth
                <a wire:navigate href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('dashboard') || request()->routeIs('my-*') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                    <div class="relative mb-0.5">
                        <div class="w-5 h-5 rounded-full ring-1.5 ring-slate-300 overflow-hidden {{ request()->routeIs('dashboard') || request()->routeIs('my-*') ? 'ring-rose-600' : '' }}">
                            <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-emerald-500 rounded-full ring-1 ring-white shadow-xs" title="Online Now"></span>
                    </div>
                    <span class="text-[10px] tracking-tight">Account</span>
                </a>
            @else
                <a wire:navigate href="{{ route('login') }}" class="flex flex-col items-center justify-center text-center tap-active relative py-1 {{ request()->routeIs('login') || request()->routeIs('register') ? 'text-rose-600 font-extrabold' : 'text-slate-400 hover:text-slate-600 font-medium' }}">
                    <i class="fa-solid fa-circle-user text-lg mb-0.5"></i>
                    <span class="text-[10px] tracking-tight">Login</span>
                </a>
            @endauth

        </div>
    </nav>

    <!-- Main Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-24 md:pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: About Us Info & Dynamic Social Icons -->
                <div class="space-y-4">
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">{{ $globalSettings['footer_about_title'] ?? 'About Us' }}</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $globalSettings['footer_about_text'] ?? "Nepal's most trusted matrimonial platform connecting Nepali singles at home and abroad with cultural accuracy, privacy and security." }}
                    </p>
                    <div class="text-xs text-slate-500 space-y-1.5">
                        @if(!empty($globalSettings['office_address']))
                            <p><i class="fa-solid fa-location-dot text-rose-500 mr-2"></i> {{ $globalSettings['office_address'] }}</p>
                        @endif
                        @if(!empty($globalSettings['helpline_phone']) || !empty($globalSettings['whatsapp_desk']))
                            <p>
                                <i class="fa-solid fa-phone text-rose-500 mr-2"></i> 
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $globalSettings['helpline_phone'] ?? '') }}" class="hover:text-rose-400 transition">{{ $globalSettings['helpline_phone'] ?? '' }}</a>
                                @if(!empty($globalSettings['helpline_phone']) && !empty($globalSettings['whatsapp_desk'])) / @endif
                                @if(!empty($globalSettings['whatsapp_desk']))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['whatsapp_desk']) }}" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition">
                                        <i class="fa-brands fa-whatsapp text-emerald-400 ml-1"></i> {{ $globalSettings['whatsapp_desk'] }}
                                    </a>
                                @endif
                            </p>
                        @endif
                        @if(!empty($globalSettings['support_email']))
                            <p>
                                <i class="fa-solid fa-envelope text-rose-500 mr-2"></i> 
                                <a href="mailto:{{ $globalSettings['support_email'] }}" class="hover:text-rose-400 transition">{{ $globalSettings['support_email'] }}</a>
                            </p>
                        @endif
                    </div>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-2.5 pt-2 flex-wrap">
                        @if(!empty($globalSettings['facebook_url']))
                            <a href="{{ $globalSettings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-rose-600 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                            </a>
                        @endif
                        @if(!empty($globalSettings['instagram_url']))
                            <a href="{{ $globalSettings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-pink-600 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="Instagram">
                                <i class="fa-brands fa-instagram text-xs"></i>
                            </a>
                        @endif
                        @if(!empty($globalSettings['youtube_url']))
                            <a href="{{ $globalSettings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-red-600 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="YouTube">
                                <i class="fa-brands fa-youtube text-xs"></i>
                            </a>
                        @endif
                        @if(!empty($globalSettings['tiktok_url']))
                            <a href="{{ $globalSettings['tiktok_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="TikTok">
                                <i class="fa-brands fa-tiktok text-xs"></i>
                            </a>
                        @endif
                        @if(!empty($globalSettings['twitter_url']))
                            <a href="{{ $globalSettings['twitter_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="Twitter / X">
                                <i class="fa-brands fa-x-twitter text-xs"></i>
                            </a>
                        @endif
                        @if(!empty($globalSettings['linkedin_url']))
                            <a href="{{ $globalSettings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-blue-600 text-slate-400 hover:text-white flex items-center justify-center transition shadow-xs" aria-label="LinkedIn">
                                <i class="fa-brands fa-linkedin-in text-xs"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Explore</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a wire:navigate href="{{ route('browse') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-xs text-rose-500"></i> Browse Profiles</a></li>
                        <li><a wire:navigate href="{{ route('events') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-xs text-rose-500"></i> Matrimonial Events</a></li>
                        <li><a wire:navigate href="{{ route('blog') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-xs text-rose-500"></i> Guides & Advice</a></li>
                        <li><a wire:navigate href="{{ route('pricing') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-xs text-rose-500"></i> Membership Packages</a></li>
                        <li><a wire:navigate href="{{ route('register') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-xs text-rose-500"></i> Free Registration</a></li>
                    </ul>
                </div>

                <!-- Col 3: Company & Information -->
                <div>
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Company & Help</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a wire:navigate href="{{ route('about') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-circle-info text-xs text-rose-500"></i> About Us</a></li>
                        <li><a wire:navigate href="{{ route('contact') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-headset text-xs text-rose-500"></i> Contact Us & Support</a></li>
                        <li><a wire:navigate href="{{ route('privacy') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-xs text-rose-500"></i> Privacy Policy</a></li>
                        <li><a wire:navigate href="{{ route('terms') }}" class="hover:text-white transition flex items-center gap-1.5"><i class="fa-solid fa-file-contract text-xs text-rose-500"></i> Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Col 4: Payments & Security -->
                <div>
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">{{ $globalSettings['footer_payment_title'] ?? 'Secure Local Payments' }}</h4>
                    <p class="text-xs text-slate-400 mb-3">{{ $globalSettings['footer_payment_text'] ?? "Instant automated activation via Nepal's digital wallets:" }}</p>
                    <div class="flex flex-wrap gap-2 text-xs font-semibold text-slate-300">
                        <span class="inline-flex items-center gap-1.5 bg-slate-800 border border-slate-700/80 px-2.5 py-1.5 rounded-xl hover:border-emerald-500/50 hover:bg-slate-800/90 transition shadow-xs">
                            <img src="{{ asset('images/payments/esewa-icon.svg') }}" alt="eSewa" class="w-4 h-4 rounded object-contain shrink-0">
                            <span class="text-slate-200">eSewa ePay</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-800 border border-slate-700/80 px-2.5 py-1.5 rounded-xl hover:border-purple-500/50 hover:bg-slate-800/90 transition shadow-xs">
                            <img src="{{ asset('images/payments/khalti-icon.svg') }}" alt="Khalti" class="w-4 h-4 rounded object-contain shrink-0">
                            <span class="text-slate-200">Khalti</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-800 border border-slate-700/80 px-2.5 py-1.5 rounded-xl hover:border-rose-500/50 hover:bg-slate-800/90 transition shadow-xs">
                            <img src="{{ asset('images/payments/fonepay-icon.svg') }}" alt="Fonepay" class="w-4 h-4 rounded object-contain shrink-0">
                            <span class="text-slate-200">Fonepay</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-800 border border-slate-700/80 px-2.5 py-1.5 rounded-xl hover:border-blue-500/50 hover:bg-slate-800/90 transition shadow-xs">
                            <img src="{{ asset('images/payments/connectips-icon.svg') }}" alt="ConnectIPS" class="w-4 h-4 rounded object-contain shrink-0">
                            <span class="text-slate-200">ConnectIPS</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <div class="flex items-center gap-3 flex-wrap justify-center md:justify-start">
                    <p>{{ $globalSettings['copyright_text'] ?? ('© ' . date('Y') . ' ' . $siteName . '. All rights reserved.') }} Powered By: <a href="{{ $globalSettings['powered_by_url'] ?? 'https://siddhitechnepal.com' }}" target="_blank" rel="noopener noreferrer" class="text-rose-400 hover:text-rose-300 font-semibold transition hover:underline">{{ $globalSettings['powered_by_text'] ?? 'Siddhi Tech Nepal' }}</a></p>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-rose-500/10 text-rose-400 border border-rose-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-pulse"></span>
                        {{ $globalSettings['app_version'] ?? 'Beta Version 2.0' }}
                    </span>
                </div>
                <div class="flex gap-6">
                    <a wire:navigate href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a>
                    <a wire:navigate href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a>
                    <a wire:navigate href="{{ route('about') }}" class="hover:text-white transition">About Us</a>
                    <a wire:navigate href="{{ route('contact') }}" class="hover:text-white transition">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
