<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinnedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id', 'message_id', 'pinned_by',
    ];

    public function channel()  { return $this->belongsTo(Channel::class); }
    public function message()  { return $this->belongsTo(Message::class); }
    public function pinnedBy() { return $this->belongsTo(User::class, 'pinned_by'); }
}
