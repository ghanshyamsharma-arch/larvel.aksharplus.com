<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'logo', 'description',
        'owner_id', 'status', 'primary_color',
        'plan', 'max_members', 'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'company_user')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function messages()
    {
        return $this->hasManyThrough(Message::class, Channel::class);
    }

    public function sharedFiles()
    {
        return $this->hasMany(SharedFile::class);
    }

    // ── Accessors ──────────────────────────────────────────────

    public function getLogoUrlAttribute(): string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=7c3aed&color=fff';
    }

    public function getMemberCountAttribute(): int
    {
        return $this->members()->count();
    }
}
