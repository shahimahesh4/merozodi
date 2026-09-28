@props([
    'user',
    'size' => 'md',
    'mode' => 'dot',
    'position' => 'top-right'
])

@php
    $isOnline = ($user && method_exists($user, 'isOnline')) ? $user->isOnline() : false;
    
    $dotSizes = [
        'xs' => 'w-2.5 h-2.5 ring-1.5',
        'sm' => 'w-3 h-3 ring-2',
        'md' => 'w-3.5 h-3.5 ring-2',
        'lg' => 'w-4 h-4 ring-2',
    ];
    $dotClass = $dotSizes[$size] ?? $dotSizes['md'];

    $posClasses = [
        'top-right' => 'absolute -top-1 -right-1',
        'top-right-offset' => 'absolute -top-1.5 -right-1.5',
        'top-right-inside' => 'absolute top-2.5 right-2.5',
        'top-right-card' => 'absolute top-3 right-3',
        'bottom-right' => 'absolute -bottom-1 -right-1',
    ];
    $posClass = $posClasses[$position] ?? $posClasses['top-right'];
@endphp

@if($mode === 'pill')
    @if($isOnline)
        <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-500/40 shadow-sm flex items-center gap-1.5" title="Online Now">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            <span class="text-emerald-300 font-bold">Online</span>
        </span>
    @else
        <span class="bg-black/60 backdrop-blur-md text-slate-300 text-[10px] font-medium px-2 py-0.5 rounded-full border border-white/10 shadow-sm flex items-center gap-1.5" title="Offline">
            <span class="w-2.5 h-2.5 rounded-full bg-slate-400 ring-2 ring-white"></span>
            <span>Offline</span>
        </span>
    @endif
@else
    @if($isOnline)
        <span class="{{ $posClass }} {{ $dotClass }} bg-emerald-500 rounded-full ring-white shadow-xs z-10" title="Online Now"></span>
    @else
        <span class="{{ $posClass }} {{ $dotClass }} bg-slate-400 rounded-full ring-white shadow-xs z-10" title="Offline"></span>
    @endif
@endif
