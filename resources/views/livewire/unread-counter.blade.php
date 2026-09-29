<div wire:poll.5s class="contents">
    @if($unreadCount > 0)
        @if($type === 'header')
            <span class="badge badge-error badge-xs absolute -top-0.5 -right-0.5 text-white font-black text-[9px] px-1 py-0.5 animate-pulse">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @else
            <span class="badge badge-error badge-xs absolute -top-1 -right-2 text-white font-black text-[8px] px-1 py-0.5 animate-pulse">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    @endif
</div>
