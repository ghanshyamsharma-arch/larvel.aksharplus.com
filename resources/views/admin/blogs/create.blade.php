@extends('layouts.admin')
@section('title', isset($blog) ? 'Edit Post' : 'New Blog Post')

@section('content')
<div style="max-width:900px;">
  <div style="margin-bottom:22px;display:flex;align-items:center;gap:12px;">
    <a href="{{ route('admin.blogs.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Posts</a>
  </div>

  <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

    {{-- LEFT: Main Content --}}
    <div>
      <div class="card" style="margin-bottom:16px;">
        <form method="POST"
              action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}"
              enctype="multipart/form-data"
              id="blogForm">
          @csrf
          @if(isset($blog)) @method('PUT') @endif

          {{-- Title --}}
          <div class="form-group">
            <label class="form-label">Post Title *</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $blog->title ?? '') }}"
                   placeholder="Write an engaging title…" required
                   style="font-size:1.1rem;font-weight:600;">
            @error('title')<div class="form-error">{{ $message }}</div>@enderror
          </div>

          {{-- Excerpt --}}
          <div class="form-group">
            <label class="form-label">Excerpt <span style="color:var(--muted2);font-weight:400;">(shown on listing page)</span></label>
            <textarea name="excerpt" class="form-control" rows="2"
                      placeholder="Short summary of the post…">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
            @error('excerpt')<div class="form-error">{{ $message }}</div>@enderror
          </div>

          {{-- Body --}}
          <div class="form-group">
            <label class="form-label">Content *</label>
            <textarea name="body" id="body" class="form-control" rows="18"
                      placeholder="Write your blog post content here… (HTML supported)"
                      style="font-family:monospace;font-size:.85rem;">{{ old('body', $blog->body ?? '') }}</textarea>
            <p style="font-size:.73rem;color:var(--muted2);margin-top:6px;">💡 HTML tags supported: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;a&gt;</p>
            @error('body')<div class="form-error">{{ $message }}</div>@enderror
          </div>

        </form>
      </div>

      {{-- SEO Card --}}
      <div class="card">
        <div class="card-title" style="margin-bottom:16px;">🔍 SEO Settings</div>
        <form id="seoForm">
          <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" form="blogForm" class="form-control"
                   value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                   placeholder="SEO title (leave blank to use post title)">
          </div>
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" form="blogForm" class="form-control" rows="2"
                      placeholder="SEO description (max 300 chars)">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
          </div>
        </form>
      </div>
    </div>

    {{-- RIGHT: Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

      {{-- Publish Settings --}}
      <div class="card">
        <div class="card-title" style="margin-bottom:16px;">⚙️ Publish Settings</div>

        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" form="blogForm" class="form-control">
            <option value="draft"     {{ old('status', $blog->status ?? 'draft')=='draft'     ? 'selected':'' }}>✏️ Draft</option>
            <option value="published" {{ old('status', $blog->status ?? '')=='published' ? 'selected':'' }}>✅ Published</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Publish Date</label>
          <input type="datetime-local" name="published_at" form="blogForm" class="form-control"
                 value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at?->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div style="display:flex;align-items:center;gap:10px;padding:12px;background:var(--bg3);border-radius:10px;margin-bottom:16px;">
          <input type="hidden" name="is_featured" value="0" form="blogForm">
          <input type="checkbox" name="is_featured" id="is_featured" value="1" form="blogForm"
                 {{ old('is_featured', $blog->is_featured ?? false) ? 'checked':'' }}
                 style="accent-color:var(--violet);width:16px;height:16px;">
          <label for="is_featured" style="font-size:.88rem;font-weight:600;color:var(--text-h);cursor:pointer;">
            ⭐ Mark as Featured
          </label>
        </div>

        <div style="display:flex;flex-direction:column;gap:8px;">
          <button type="submit" form="blogForm" class="btn btn-primary" style="justify-content:center;">
            {{ isset($blog) ? '💾 Update Post' : '🚀 Publish Post' }}
          </button>
          <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline" style="justify-content:center;">Cancel</a>
          @if(isset($blog))
            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank"
               class="btn btn-outline btn-sm" style="justify-content:center;">👁️ Preview</a>
          @endif
        </div>
      </div>

      {{-- Category & Tags --}}
      <div class="card">
        <div class="card-title" style="margin-bottom:16px;">🏷️ Category & Tags</div>

        <div class="form-group">
          <label class="form-label">Category</label>
          <input type="text" name="category" form="blogForm" class="form-control"
                 list="cat-list"
                 value="{{ old('category', $blog->category ?? '') }}"
                 placeholder="e.g. Product, Tips, News">
          <datalist id="cat-list">
            @foreach($categories as $cat)
              <option value="{{ $cat }}">
            @endforeach
            <option value="Product"><option value="Features">
            <option value="Productivity"><option value="Business">
            <option value="News"><option value="Tutorial">
          </datalist>
        </div>

        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Tags <span style="color:var(--muted2);font-weight:400;">(comma separated)</span></label>
          <input type="text" name="tags" form="blogForm" class="form-control"
                 value="{{ old('tags', isset($blog) ? implode(', ', $blog->tags_list) : '') }}"
                 placeholder="remote work, tips, team">
        </div>
      </div>

      {{-- Cover Image --}}
      <div class="card">
        <div class="card-title" style="margin-bottom:16px;">🖼️ Cover Image</div>
        @if(isset($blog) && $blog->cover_image)
          <img src="{{ $blog->cover_url }}" style="width:100%;border-radius:10px;margin-bottom:12px;aspect-ratio:16/9;object-fit:cover;" alt="">
          <p style="font-size:.73rem;color:var(--muted2);margin-bottom:10px;">Upload new image to replace</p>
        @endif
        <input type="file" name="cover_image" form="blogForm" class="form-control" accept="image/*"
               onchange="previewImg(this)">
        <img id="imgPreview" style="width:100%;border-radius:10px;margin-top:12px;display:none;aspect-ratio:16/9;object-fit:cover;" alt="">
        <p style="font-size:.73rem;color:var(--muted2);margin-top:6px;">Max 3MB. JPG, PNG, WebP</p>
      </div>

      {{-- Stats (edit mode only) --}}
      @if(isset($blog))
      <div class="card" style="padding:16px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;text-align:center;">
          <div style="background:var(--bg3);border-radius:10px;padding:12px;">
            <div style="font-family:'Syne',sans-serif;font-size:1.4rem;font-weight:800;color:var(--text-h);">{{ number_format($blog->views) }}</div>
            <div style="font-size:.7rem;color:var(--muted2);">Views</div>
          </div>
          <div style="background:var(--bg3);border-radius:10px;padding:12px;">
            <div style="font-family:'Syne',sans-serif;font-size:1.4rem;font-weight:800;color:var(--text-h);">{{ $blog->reading_time }}</div>
            <div style="font-size:.7rem;color:var(--muted2);">Read time</div>
          </div>
        </div>
        <p style="font-size:.73rem;color:var(--muted2);text-align:center;margin-top:10px;">Created {{ $blog->created_at->diffForHumans() }}</p>
      </div>
      @endif

    </div>
  </div>
</div>

@push('scripts')
<script>
function previewImg(input) {
  const preview = document.getElementById('imgPreview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection
