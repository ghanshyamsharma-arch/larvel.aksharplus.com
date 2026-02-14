<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id', 'name', 'slug', 'description',
        'type',        // general | private | direct
        'is_private', 'created_by',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    public function pinnedMessages()
    {
        return $this->hasMany(PinnedMessage::class);
    }

    public function scheduledMessages()
    {
        return $this->hasMany(ScheduledMessage::class);
    }

    public function sharedFiles()
    {
        return $this->hasMany(SharedFile::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'channel_members')
            ->withTimestamps();
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }

    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }
}
