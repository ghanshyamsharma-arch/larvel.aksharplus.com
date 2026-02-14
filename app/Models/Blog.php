<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body',
        'cover_image', 'category', 'tags',
        'author_id', 'status',   // draft | published
        'is_featured',
        'meta_title', 'meta_description',
        'published_at', 'views',
    ];

    protected $casts = [
        'tags'         => 'array',
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
        'views'        => 'integer',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopePublished($q)
    {
        return $q->where('status', 'published')
                 ->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
    }

    public function scopeFeatured($q)
    {
        return $q->where('is_featured', true);
    }

    public function scopeByCategory($q, $category)
    {
        return $q->where('category', $category);
    }

    // ── Accessors ──────────────────────────────────────────────

    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : 'https://picsum.photos/seed/' . $this->id . '/800/450';
    }

    public function getReadingTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->body));
        $minutes = max(1, ceil($words / 200));
        return $minutes . ' min read';
    }

    public function getTagsListAttribute(): array
    {
        return $this->tags ?? [];
    }

    // ── Auto-slug on create ───────────────────────────────────

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title) . '-' . Str::random(5);
            }
        });
    }
}
