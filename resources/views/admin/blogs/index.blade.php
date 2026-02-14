@extends('layouts.admin')
@section('title', 'Blog Posts')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;">
  <div>
    <h2 style="font-family:'Syne',sans-serif;font-size:1.4rem;font-weight:800;color:var(--text-h);">Blog Posts</h2>
    <p style="color:var(--muted);font-size:.85rem;margin-top:3px;">{{ $blogs->total() }} total posts</p>
  </div>
  <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">✍️ New Post</a>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom:20px;padding:16px 24px;">
  <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
    <div style="flex:1;min-width:200px;">
      <div class="search-bar">
        <span>🔍</span>
        <input type="text" name="search" placeholder="Search posts…" value="{{ request('search') }}">
      </div>
    </div>
    <select name="status" class="form-control" style="padding:10px 14px;min-width:130px;">
      <option value="">All Status</option>
      <option value="published" {{ request('status')=='published' ? 'selected':'' }}>Published</option>
      <option value="draft"     {{ request('status')=='draft'     ? 'selected':'' }}>Draft</option>
    </select>
    <select name="category" class="form-control" style="padding:10px 14px;min-width:140px;">
      <option value="">All Categories</option>
      @foreach($categories as $cat)
        <option value="{{ $cat }}" {{ request('category')==$cat ? 'selected':'' }}>{{ $cat }}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    @if(request()->hasAny(['search','status','category']))
      <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline btn-sm">Clear</a>
    @endif
  </form>
</div>

{{-- Blog Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:18px;">
  @forelse($blogs as $blog)
  <div class="card" style="padding:0;overflow:hidden;transition:all .25s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(80,40,180,.12)'" onmouseout="this.style.boxShadow=''">

    {{-- Cover --}}
    <div style="height:160px;background:linear-gradient(135deg,#1a0d2e,#2d1b69);position:relative;overflow:hidden;">
      @if($blog->cover_image)
        <img src="{{ $blog->cover_url }}" style="width:100%;height:100%;object-fit:cover;" alt="">
      @else
        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;opacity:.3;">✍️</div>
      @endif
      {{-- Status badge --}}
      <div style="position:absolute;top:12px;left:12px;display:flex;gap:6px;">
        <span class="badge {{ $blog->status==='published' ? 'badge-green' : 'badge-yellow' }}" style="backdrop-filter:blur(8px);background:{{ $blog->status==='published' ? 'rgba(34,197,94,.9)' : 'rgba(251,191,36,.9)' }};color:#fff;">
          {{ $blog->status==='published' ? '✅ Live' : '✏️ Draft' }}
        </span>
        @if($blog->is_featured)
          <span class="badge" style="background:rgba(233,30,140,.9);color:#fff;">⭐ Featured</span>
        @endif
      </div>
      {{-- Views --}}
      <div style="position:absolute;bottom:10px;right:12px;font-size:.72rem;color:rgba(255,255,255,.8);background:rgba(0,0,0,.4);padding:2px 8px;border-radius:4px;">
        👁️ {{ number_format($blog->views) }}
      </div>
    </div>

    <div style="padding:18px;">
      @if($blog->category)
        <span style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--violet);">{{ $blog->category }}</span>
      @endif
      <h3 style="font-family:'Syne',sans-serif;font-size:.95rem;font-weight:700;color:var(--text-h);margin:6px 0 8px;line-height:1.3;">{{ Str::limit($blog->title, 65) }}</h3>
      <p style="font-size:.8rem;color:var(--muted);line-height:1.5;margin-bottom:14px;">{{ Str::limit($blog->excerpt, 90) }}</p>

      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
        <div style="display:flex;align-items:center;gap:8px;">
          <div style="width:26px;height:26px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:#fff;">{{ $blog->author->initials ?? 'A' }}</div>
          <span style="font-size:.78rem;color:var(--muted);">{{ $blog->author->name ?? 'Admin' }}</span>
        </div>
        <span style="font-size:.75rem;color:var(--muted2);">{{ $blog->reading_time }}</span>
      </div>

      <div style="display:flex;gap:7px;flex-wrap:wrap;">
        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">✏️ Edit</a>

        <form method="POST" action="{{ route('admin.blogs.toggle-status', $blog) }}" style="flex:1;">
          @csrf @method('PATCH')
          <button class="btn btn-sm" style="width:100%;background:{{ $blog->status==='published' ? 'rgba(251,191,36,.12)' : 'rgba(34,197,94,.1)' }};color:{{ $blog->status==='published' ? '#b45309' : '#15803d' }};border:1px solid {{ $blog->status==='published' ? 'rgba(251,191,36,.3)' : 'rgba(34,197,94,.2)' }};">
            {{ $blog->status==='published' ? '⬇️ Draft' : '🚀 Publish' }}
          </button>
        </form>

        <form method="POST" action="{{ route('admin.blogs.toggle-featured', $blog) }}">
          @csrf @method('PATCH')
          <button class="btn btn-sm" title="{{ $blog->is_featured ? 'Remove featured' : 'Mark featured' }}" style="background:{{ $blog->is_featured ? 'rgba(233,30,140,.12)' : 'rgba(100,80,200,.08)' }};color:{{ $blog->is_featured ? 'var(--magenta)' : 'var(--muted)' }};border:1px solid {{ $blog->is_featured ? 'rgba(233,30,140,.25)' : 'var(--border)' }};">
            ⭐
          </button>
        </form>

        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" onsubmit="return confirm('Delete this post?')">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">🗑️</button>
        </form>
      </div>
    </div>
  </div>
  @empty
  <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--muted);">
    No blog posts yet. <a href="{{ route('admin.blogs.create') }}" style="color:var(--violet);">Create your first post →</a>
  </div>
  @endforelse
</div>

<div class="pagination" style="margin-top:24px;">{{ $blogs->links() }}</div>
@endsection
