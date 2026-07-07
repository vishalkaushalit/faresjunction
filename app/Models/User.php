<?php

namespace App\Models;

use Database\Factories\UserFactory;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_AUTHOR = 'author';
    public const INDIA_TIMEZONE = 'Asia/Kolkata';

    public const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_AUTHOR => 'Author',
    ];

    protected $fillable = [
        'name',
        'age',
        'experience',
        'bio',
        'social_media_profile',
        'contact_number',
        'email',
        'profile_image',
        'password',
        'role',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'age' => 'integer',
            'status' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    public static function formatLocalDateTime(?DateTimeInterface $dateTime, string $empty = 'Not set'): string
    {
        if (! $dateTime) {
            return $empty;
        }

        return Carbon::instance($dateTime)
            ->timezone(self::INDIA_TIMEZONE)
            ->format('M d, Y h:i A');
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isAuthor(): bool
    {
        return $this->hasRole(self::ROLE_AUTHOR);
    }
}
