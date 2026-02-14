<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'channel_id', 'sender_id', 'body',
        'type',        // text | image | file | audio | video | link | system
        'parent_id',   // for threads/replies
        'is_edited', 'edited_at',
        'metadata',    // JSON — link preview, file info etc.
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
        'metadata'  => 'array',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    public function reactions()
    {
        return $this->hasMany(MessageReaction::class);
    }

    public function pinnedMessage()
    {
        return $this->hasOne(PinnedMessage::class);
    }

    // ── Accessors ──────────────────────────────────────────────

    public function getIsPinnedAttribute(): bool
    {
        return $this->pinnedMessage()->exists();
    }

    public function getReactionSummaryAttribute(): array
    {
        return $this->reactions()
            ->selectRaw('emoji, count(*) as count')
            ->groupBy('emoji')
            ->pluck('count', 'emoji')
            ->toArray();
    }
}
