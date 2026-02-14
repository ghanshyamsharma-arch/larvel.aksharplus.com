<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'avatar',
        'status', 'is_online', 'last_seen_at',
        'current_company_id', 'phone', 'bio',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen_at'      => 'datetime',
        'is_online'         => 'boolean',
        'password'          => 'hashed',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_user')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function currentCompany()
    {
        return $this->belongsTo(Company::class, 'current_company_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function pinnedMessages()
    {
        return $this->hasMany(PinnedMessage::class, 'pinned_by');
    }

    public function scheduledMessages()
    {
        return $this->hasMany(ScheduledMessage::class, 'sender_id');
    }

    public function uploadedFiles()
    {
        return $this->hasMany(SharedFile::class, 'uploaded_by');
    }

    // ── Accessors ──────────────────────────────────────────────

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        return strtoupper(
            count($words) >= 2
                ? $words[0][0] . $words[1][0]
                : substr($this->name, 0, 2)
        );
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
