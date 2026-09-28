<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'dob' => 'date',
            'is_verified' => 'boolean',
            'is_premium' => 'boolean',
            'last_active_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'moderator']);
    }

    public function isOnline(): bool
    {
        return $this->last_active_at && $this->last_active_at->gt(now()->subMinutes(5));
    }

    public function getOnlineStatusAttribute(): string
    {
        if ($this->isOnline()) {
            return 'Online Now';
        }

        if (! $this->last_active_at) {
            return 'Offline';
        }

        return $this->last_active_at->diffForHumans();
    }

    public function getMatrimonyIdAttribute(): string
    {
        return 'MZ' . str_pad((string) $this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->dob ? Carbon::parse($this->dob)->age : null;
    }

    public function getMaritalStatusLabelAttribute(): string
    {
        $status = $this->marital_status ?? $this->profile?->marital_status ?? 'unmarried';
        return match (strtolower($status)) {
            'never_married', 'unmarried' => 'Unmarried',
            'widow', 'widowed' => 'Widow',
            'divorced' => 'Divorced',
            'separated' => 'Separated',
            default => ucwords(str_replace('_', ' ', $status)),
        };
    }

    public function getProfileCreatedByLabelAttribute(): string
    {
        $val = $this->profile_created_by ?? $this->profile?->profile_created_by ?? 'self';
        return match (strtolower($val)) {
            'self' => 'Self',
            'parents', 'parent' => 'Parents',
            'sibling', 'brother', 'sister' => 'Sibling',
            'relative' => 'Relative',
            'friend' => 'Friend',
            default => ucwords(str_replace('_', ' ', $val)),
        };
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return str_starts_with($this->avatar, 'http')
                ? $this->avatar
                : asset('storage/' . $this->avatar);
        }

        $defaultImage = $this->gender === 'female'
            ? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&h=300&fit=crop&crop=faces'
            : 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=300&fit=crop&crop=faces';

        return $defaultImage;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function physical(): HasOne
    {
        return $this->hasOne(PhysicalLifestyle::class);
    }

    public function education(): HasOne
    {
        return $this->hasOne(EducationProfession::class);
    }

    public function family(): HasOne
    {
        return $this->hasOne(FamilyDetail::class);
    }

    public function preferences(): HasOne
    {
        return $this->hasOne(PartnerPreference::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(UserGallery::class);
    }

    public function sentConnects(): HasMany
    {
        return $this->hasMany(ConnectRequest::class, 'sender_id');
    }

    public function receivedConnects(): HasMany
    {
        return $this->hasMany(ConnectRequest::class, 'receiver_id');
    }

    public function sentLikes(): HasMany
    {
        return $this->hasMany(UserLike::class, 'liker_id');
    }

    public function receivedLikes(): HasMany
    {
        return $this->hasMany(UserLike::class, 'liked_id');
    }

    public function viewedProfiles(): HasMany
    {
        return $this->hasMany(ProfileView::class, 'viewer_id');
    }

    public function profileVisitors(): HasMany
    {
        return $this->hasMany(ProfileView::class, 'viewed_id');
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(UserVerification::class);
    }

    public function latestVerification(): HasOne
    {
        return $this->hasOne(UserVerification::class)->latestOfMany();
    }

    public function savedSearches(): HasMany
    {
        return $this->hasMany(SavedSearch::class);
    }

    public function blockedUsers(): HasMany
    {
        return $this->hasMany(BlockedUser::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('is_active', true)
            ->where('ends_at', '>', now())
            ->latestOfMany();
    }

    public function hasLiked(int $targetUserId): bool
    {
        return $this->sentLikes()->where('liked_id', $targetUserId)->exists();
    }

    public function connectionStatusWith(int $targetUserId): ?string
    {
        $req = ConnectRequest::where(function ($q) use ($targetUserId) {
            $q->where('sender_id', $this->id)->where('receiver_id', $targetUserId);
        })->orWhere(function ($q) use ($targetUserId) {
            $q->where('sender_id', $targetUserId)->where('receiver_id', $this->id);
        })->first();

        return $req?->status;
    }

    public function unreadMessagesCount(): int
    {
        return Message::where('receiver_id', $this->id)->where('is_read', false)->count();
    }

    public function pendingReceivedRequestsCount(): int
    {
        return $this->receivedConnects()->where('status', 'pending')->count();
    }

    public function canAccessVideoCalling(): bool
    {
        if ($this->role === 'admin') return true;
        return (bool) $this->activeSubscription?->plan?->allows_video_calling;
    }

    public function canAccessDirectMessaging(): bool
    {
        if ($this->role === 'admin') return true;
        return (bool) ($this->is_premium || $this->activeSubscription?->plan?->allows_direct_messaging);
    }

    public function canViewContactDetails(): bool
    {
        if ($this->role === 'admin') return true;
        return (bool) ($this->is_premium || $this->activeSubscription?->plan?->allows_contact_view);
    }
}
