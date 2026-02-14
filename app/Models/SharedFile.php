<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id', 'channel_id', 'message_id',
        'uploaded_by', 'original_name', 'file_path',
        'file_type',   // image | video | audio | document | link
        'mime_type', 'file_size', 'thumbnail_path',
        'metadata',    // duration, dimensions, link_preview etc.
    ];

    protected $casts = [
        'file_size' => 'integer',
        'metadata'  => 'array',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function company()  { return $this->belongsTo(Company::class); }
    public function channel()  { return $this->belongsTo(Channel::class); }
    public function message()  { return $this->belongsTo(Message::class); }
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }

    // ── Accessors ──────────────────────────────────────────────

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : null;
    }

    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopeImages($q)    { return $q->where('file_type', 'image'); }
    public function scopeVideos($q)    { return $q->where('file_type', 'video'); }
    public function scopeAudio($q)     { return $q->where('file_type', 'audio'); }
    public function scopeDocuments($q) { return $q->where('file_type', 'document'); }
    public function scopeLinks($q)     { return $q->where('file_type', 'link'); }
}
