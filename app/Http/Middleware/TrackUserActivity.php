<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivity
{
    /**
     * Handle an incoming request and update the authenticated user's last_active_at timestamp.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            // Only update once every 60 seconds to optimize database performance
            if (! $user->last_active_at || $user->last_active_at->diffInSeconds(now()) > 60) {
                User::where('id', $user->id)->update([
                    'last_active_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
