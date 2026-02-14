<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id', 'sender_id', 'body',
        'scheduled_at', 'sent_at', 'status', // pending | sent | cancelled
        'metadata',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at'      => 'datetime',
        'metadata'     => 'array',
    ];

    public function channel() { return $this->belongsTo(Channel::class); }
    public function sender()  { return $this->belongsTo(User::class, 'sender_id'); }

    public function scopePending($query)    { return $query->where('status', 'pending'); }
    public function scopeDue($query)        { return $query->pending()->where('scheduled_at', '<=', now()); }
}
