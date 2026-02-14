@extends('layouts.admin')
@section('title', 'Edit Post')

@section('content')
<div style="max-width:900px;">
  <div style="margin-bottom:22px;">
    <a href="{{ route('admin.blogs.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Posts</a>
    <h2 style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--text-h);margin-top:8px;">Edit Post</h2>
  </div>

  <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

    <div>
      <div class="card" style="margin-bottom:16px;">
        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}"
              enctype="multipart/form-data" id="blogForm">
          @csrf @method('PUT')

          <div class="form-group">
            <label class="form-label">Post Title *</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $blog->title) }}"
                   style="font-size:1.05rem;font-weight:600;" required>
            @error('title')<div class="form-error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Content * <span style="color:var(--muted2);font-weight:400;font-size:.75rem;">(HTML supported)</span></label>
            <textarea name="body" class="form-control" rows="20"
                      style="font-family:monospace;font-size:.83rem;">{{ old('body', $blog->body) }}</textarea>
            @error('body')<div class="form-error">{{ $message }}</div>@enderror
          </div>
        </form>
      </div>

      <div class="card">
        <div class="card-title" style="margin-bottom:14px;">🔍 SEO</div>
        <div class="form-group">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" form="blogForm" class="form-control"
                 value="{{ old('meta_title', $blog->meta_title) }}" placeholder="Leave blank to use post title">
        </div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Meta Description</label>
          <textarea name="meta_description" form="blogForm" class="form-control" rows="2">{{ old('meta_description', $blog->meta_description) }}</textarea>
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:14px;">

      <div class="card">
        <div class="card-title" style="margin-bottom:14px;">⚙️ Settings</div>

        <div class="form-group">
          <label class="form-label">Status</label>
          <select name="status" form="blogForm" class="form-control">
            <option value="draft"     {{ (old('status',$blog->status)=='draft')     ? 'selected':'' }}>✏️ Draft</option>
            <option value="published" {{ (old('status',$blog->status)=='published') ? 'selected':'' }}>✅ Published</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Publish Date</label>
          <input type="datetime-local" name="published_at" form="blogForm" class="form-control"
                 value="{{ old('published_at', $blog->published_at?->format('Y-m-d\TH:i')) }}">
        </div>

        <div style="display:flex;align-items:center;gap:9px;padding:11px;background:var(--bg3);border-radius:10px;margin-bottom:14px;">
          <input type="hidden" name="is_featured" value="0" form="blogForm">
          <input type="checkbox" id="feat" name="is_featured" value="1" form="blogForm"
                 {{ old('is_featured',$blog->is_featured) ? 'checked':'' }}
                 style="accent-color:var(--violet);width:16px;height:16px;">
          <label for="feat" style="font-size:.87rem;font-weight:600;color:var(--text-h);cursor:pointer;">⭐ Featured Post</label>
        </div>

        <button type="submit" form="blogForm" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:8px;">💾 Save Changes</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-bottom:8px;">Cancel</a>
        <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;">👁️ View Live</a>
      </div>

      <div class="card">
        <div class="card-title" style="margin-bottom:14px;">🏷️ Category & Tags</div>
        <div class="form-group">
          <label class="form-label">Category</label>
          <input type="text" name="category" form="blogForm" class="form-control"
                 list="cats" value="{{ old('category', $blog->category) }}" placeholder="e.g. Product">
          <datalist id="cats">
            @foreach($categories as $c)<option value="{{ $c }}">@endforeach
            <option value="Product"><option value="Features"><option value="Productivity">
            <option value="Business"><option value="News"><option value="Tutorial">
          </datalist>
        </div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Tags <span style="color:var(--muted2);font-weight:400;font-size:.75rem;">(comma separated)</span></label>
          <input type="text" name="tags" form="blogForm" class="form-control"
                 value="{{ old('tags', implode(', ', $blog->tags_list)) }}">
        </div>
      </div>

      <div class="card">
        <div class="card-title" style="margin-bottom:14px;">🖼️ Cover Image</div>
        @if($blog->cover_image)
          <img src="{{ $blog->cover_url }}" style="width:100%;border-radius:10px;margin-bottom:10px;aspect-ratio:16/9;object-fit:cover;" alt="">
        @endif
        <input type="file" name="cover_image" form="blogForm" class="form-control" accept="image/*" onchange="prev(this)">
        <img id="prev-img" style="display:none;width:100%;border-radius:10px;margin-top:10px;aspect-ratio:16/9;object-fit:cover;" alt="">
      </div>

      <div class="card" style="padding:16px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;text-align:center;margin-bottom:12px;">
          <div style="background:var(--bg3);border-radius:10px;padding:10px;">
            <div style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--text-h);">{{ number_format($blog->views) }}</div>
            <div style="font-size:.68rem;color:var(--muted2);">Views</div>
          </div>
          <div style="background:var(--bg3);border-radius:10px;padding:10px;">
            <div style="font-family:'Syne',sans-serif;font-size:.9rem;font-weight:800;color:var(--text-h);">{{ $blog->reading_time }}</div>
            <div style="font-size:.68rem;color:var(--muted2);">Read Time</div>
          </div>
        </div>
        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" onsubmit="return confirm('Delete this post permanently?')">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm" style="width:100%;justify-content:center;">🗑️ Delete Post</button>
        </form>
      </div>

    </div>
  </div>
</div>
@push('scripts')
<script>
function prev(i){const p=document.getElementById('prev-img');if(i.files[0]){const r=new FileReader();r.onload=e=>{p.src=e.target.result;p.style.display='block';};r.readAsDataURL(i.files[0]);}}
</script>
@endpush
@endsection
