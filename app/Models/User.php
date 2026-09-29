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
        return in_array($this->role, ['super_admin', 'admin', 'staff', 'moderator']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    public function isStaff(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'staff', 'moderator']);
    }

    public function isUser(): bool
    {
        return $this->role === 'user' || blank($this->role);
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = (array) $roles;
        return in_array($this->role, $roles, true);
    }

    public function hasPermission(string $permission): bool
    {
        // Super Admin has unrestricted access to all actions
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Admin permissions
        if ($this->role === 'admin') {
            return in_array($permission, [
                'view_admin_panel',
                'manage_users',
                'verify_kyc',
                'manage_blogs',
                'manage_events',
                'manage_inquiries',
                'manage_coupons',
                'manage_payments',
                'manage_reports',
                'manage_cms_pages',
                'view_settings',
            ], true);
        }

        // Staff / Moderator permissions
        if (in_array($this->role, ['staff', 'moderator'], true)) {
            return in_array($permission, [
                'view_admin_panel',
                'verify_kyc',
                'manage_blogs',
                'manage_events',
                'manage_inquiries',
                'manage_reports',
            ], true);
        }

        // Regular users have standard frontend permissions
        return false;
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'super_admin' => 'Super Admin',
            'admin' => 'Administrator',
            'staff' => 'Staff / Support',
            'moderator' => 'Moderator',
            default => 'Matchseeker (User)',
        };
    }

    public function getRoleBadgeColorAttribute(): string
    {
        return match ($this->role) {
            'super_admin' => 'danger',
            'admin' => 'primary',
            'staff', 'moderator' => 'warning',
            default => 'gray',
        };
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

    protected ?int $memoizedProfileCompletion = null;

    public function getProfileCompletionPercentageAttribute(): int
    {
        if ($this->memoizedProfileCompletion !== null) {
            return $this->memoizedProfileCompletion;
        }

        $score = 0;

        // Ensure relations
        $profile = $this->relationLoaded('profile') ? $this->profile : $this->profile;
        $education = $this->relationLoaded('education') ? $this->education : $this->education;
        $physical = $this->relationLoaded('physical') ? $this->physical : $this->physical;
        $family = $this->relationLoaded('family') ? $this->family : $this->family;

        // 1. Basic Account & Identity (20 pts)
        if (!empty($this->name)) $score += 4;
        if (!empty($this->gender)) $score += 4;
        if (!empty($this->dob)) $score += 4;
        if (!empty($this->phone)) $score += 4;
        if (!empty($this->marital_status) || !empty($profile?->marital_status)) $score += 4;

        // 2. Bio & About Me (10 pts)
        if (!empty($profile?->about_me) || !empty($profile?->bio) || !empty($this->about_me)) $score += 10;

        // 3. Religious, Caste & Vedic Astrology (15 pts)
        if (!empty($profile?->religion_id) || !empty($profile?->religion)) $score += 4;
        if (!empty($profile?->caste_id) || !empty($profile?->caste)) $score += 4;
        if (!empty($profile?->rashi)) $score += 4;
        if (!empty($profile?->gotra) || !empty($profile?->nakshatra)) $score += 3;

        // 4. Location & Origins (10 pts)
        if (!empty($profile?->current_city) || !empty($profile?->living_city)) $score += 5;
        if (!empty($profile?->permanent_city) || !empty($profile?->origin_district)) $score += 5;

        // 5. Education & Career (15 pts)
        if (!empty($education?->education_level_id) || !empty($education?->degree)) $score += 5;
        if (!empty($education?->occupation_id) || !empty($education?->designation)) $score += 5;
        if (!empty($education?->annual_income_range) || !empty($education?->annual_income) || !empty($education?->income)) $score += 5;

        // 6. Physical & Lifestyle (15 pts)
        if (!empty($physical?->height_feet) || !empty($physical?->height_cm) || !empty($physical?->height)) $score += 4;
        if (!empty($physical?->diet)) $score += 4;
        if (!empty($physical?->smoking) || !empty($physical?->drinking)) $score += 4;
        if (!empty($physical?->body_type) || !empty($physical?->complexion)) $score += 3;

        // 7. Family & Photos / Verification (15 pts)
        if (!empty($family?->father_occupation) || !empty($family?->family_type) || !empty($family?->family_values)) $score += 5;
        if (!empty($this->avatar)) $score += 5;
        
        $hasGalleries = $this->relationLoaded('galleries') ? $this->galleries->isNotEmpty() : false;
        if ($this->is_verified || $hasGalleries) {
            $score += 5;
        } elseif (!$this->relationLoaded('galleries') && $this->galleries()->exists()) {
            $score += 5;
        }

        return $this->memoizedProfileCompletion = min(100, max(20, (int) round($score)));
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
                return $this->avatar;
            }
            if (str_starts_with($this->avatar, 'images/') || str_starts_with($this->avatar, '/images/')) {
                return asset(ltrim($this->avatar, '/'));
            }
            return asset('storage/' . $this->avatar);
        }

        return $this->gender === 'female'
            ? asset('images/avatars/avatar_f1.jpg')
            : asset('images/avatars/avatar_m1.jpg');
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

    public function scopeVerified($query)
    {
        return $query->where('role', 'user')
                     ->where('status', 'active')
                     ->where('is_verified', true);
    }
}
