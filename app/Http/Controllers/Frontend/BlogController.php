<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('author')->published()->latest('published_at');

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $blogs      = $query->paginate(9)->withQueryString();
        $featured   = Blog::published()->featured()->latest('published_at')->limit(3)->get();
        $categories = Blog::published()->distinct()->pluck('category')->filter()->values();
        $recent     = Blog::published()->latest('published_at')->limit(4)->get();

        return view('frontend.blog.index', compact('blogs', 'featured', 'categories', 'recent'));
    }

    public function show(string $slug)
    {
        $blog = Blog::with('author')->published()->where('slug', $slug)->firstOrFail();

        // Increment views
        $blog->increment('views');

        // Related posts (same category, excluding current)
        $related = Blog::published()
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('frontend.blog.show', compact('blog', 'related'));
    }
}
