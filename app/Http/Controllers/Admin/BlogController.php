<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('author')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs      = $query->paginate(12);
        $categories = Blog::distinct()->pluck('category')->filter()->values();

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = Blog::distinct()->pluck('category')->filter()->values();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:191',
            'excerpt'          => 'nullable|string|max:500',
            'body'             => 'required|string',
            'category'         => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'status'           => 'required|in:draft,published',
            'is_featured'      => 'boolean',
            'meta_title'       => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:300',
            'cover_image'      => 'nullable|image|max:3072',
            'published_at'     => 'nullable|date',
        ]);

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('blogs/covers', 'public');
        }

        // Parse tags
        $validated['tags'] = $this->parseTags($request->tags);

        // Slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        // Auto set published_at
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['author_id'] = auth()->id();
        $validated['is_featured'] = $request->boolean('is_featured');

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = Blog::distinct()->pluck('category')->filter()->values();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:191',
            'excerpt'          => 'nullable|string|max:500',
            'body'             => 'required|string',
            'category'         => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'status'           => 'required|in:draft,published',
            'is_featured'      => 'boolean',
            'meta_title'       => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:300',
            'cover_image'      => 'nullable|image|max:3072',
            'published_at'     => 'nullable|date',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('blogs/covers', 'public');
        }

        $validated['tags']        = $this->parseTags($request->tags);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && ! $blog->published_at) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted!');
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['is_featured' => ! $blog->is_featured]);
        return back()->with('success', 'Featured status updated!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->update([
            'status'       => $blog->status === 'published' ? 'draft' : 'published',
            'published_at' => $blog->status === 'draft' ? now() : $blog->published_at,
        ]);
        return back()->with('success', 'Status updated!');
    }

    private function parseTags(?string $tags): array
    {
        if (empty($tags)) return [];
        return collect(explode(',', $tags))
            ->map(fn($t) => trim($t))
            ->filter()
            ->values()
            ->toArray();
    }
}
