@include('frontend.layouts.navbar')
<!-- HERO -->
<div class="blog-hero">
  <div style="max-width:1200px;margin:0 auto;padding:0 5%;">
    <div class="hero-label"><span class="dot"></span> Akshar Plus Blog</div>
    <h1>Insights for <span class="grad-text">Modern Teams</span></h1>
    <p>Product updates, remote work tips, team communication guides, and everything in between.</p>

    <div class="search-wrap">
      <form method="GET" action="{{ route('blog.index') }}">
        <div class="search-box">
          <span style="font-size:1rem;color:var(--muted2);">🔍</span>
          <input type="text" name="search" placeholder="Search articles…" value="{{ request('search') }}">
          <button type="submit" class="search-btn">Search</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="blog-wrap">
  <div class="blog-layout">

    <!-- MAIN CONTENT -->
    <div>

      {{-- Featured Posts --}}
      @if($featured->count() > 0 && !request()->hasAny(['search','category','tag']))
      <div class="featured-section">
        <div class="section-head">
          <h2>⭐ Featured Stories</h2>
          <a href="{{ route('blog.index') }}" class="see-all">All posts →</a>
        </div>
        <div class="featured-grid">

          {{-- Main featured --}}
          <a href="{{ route('blog.show', $featured->first()->slug) }}" class="featured-main">
            <div class="cover-bg">
              @if($featured->first()->cover_image)
              <img src="{{ $featured->first()->cover_url }}" alt="{{ $featured->first()->title }}">
              @endif
              <div class="featured-overlay" style="display:flex;flex-direction:column;justify-content:flex-end;">
                @if($featured->first()->category)
                <div class="cat">{{ $featured->first()->category }}</div>
                @endif
                <h3>{{ $featured->first()->title }}</h3>
                <p>{{ Str::limit($featured->first()->excerpt, 100) }}</p>
                <span class="read-link">Read story →</span>
              </div>
            </div>
          </a>

          {{-- Side featured --}}
          <div class="featured-side">
            @foreach($featured->skip(1)->take(2) as $fp)
            <a href="{{ route('blog.show', $fp->slug) }}" class="featured-thumb" style="flex:1;">
              <div class="cover-bg" style="background:linear-gradient(135deg,{{ ['#0d2818,#1a5c3a','#2a0d1a,#5c1a3a'][$loop->index % 2] }})">
                @if($fp->cover_image)
                <img src="{{ $fp->cover_url }}" alt="{{ $fp->title }}">
                @endif
                <div class="thumb-overlay" style="display:flex;flex-direction:column;justify-content:flex-end;">
                  @if($fp->category)<div class="cat">{{ $fp->category }}</div>@endif
                  <h4>{{ Str::limit($fp->title, 55) }}</h4>
                </div>
              </div>
            </a>
            @endforeach
          </div>
        </div>
      </div>
      @endif

      {{-- Active Filters --}}
      @if(request()->hasAny(['search','category','tag']))
      <div style="background:rgba(124,58,237,.06);border:1px solid rgba(124,58,237,.15);border-radius:12px;padding:12px 18px;margin-bottom:28px;display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="font-size:.82rem;color:var(--muted);">Showing results for:</span>
        @if(request('search'))<span style="background:var(--violet);color:#fff;padding:3px 12px;border-radius:20px;font-size:.78rem;">🔍 "{{ request('search') }}"</span>@endif
        @if(request('category'))<span style="background:var(--violet);color:#fff;padding:3px 12px;border-radius:20px;font-size:.78rem;">🏷️ {{ request('category') }}</span>@endif
        @if(request('tag'))<span style="background:var(--violet);color:#fff;padding:3px 12px;border-radius:20px;font-size:.78rem;"># {{ request('tag') }}</span>@endif
        <a href="{{ route('blog.index') }}" style="margin-left:auto;font-size:.78rem;color:var(--magenta);font-weight:600;">✕ Clear</a>
      </div>
      @endif

      {{-- All Posts --}}
      <div class="section-head">
        <h2>{{ request()->hasAny(['search','category','tag']) ? '📄 Results' : '📰 All Articles' }}
          <span style="font-family:var(--font-b);font-size:.75rem;font-weight:400;color:var(--muted2);">{{ $blogs->total() }} posts</span>
        </h2>
      </div>

      <div class="blog-grid">
        @forelse($blogs as $blog)
        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card">
          <div class="bc-thumb">
            @if($blog->cover_image)
            <img src="{{ $blog->cover_url }}" alt="{{ $blog->title }}">
            @else
            <div class="no-img">✍️</div>
            @endif
            @if($blog->category)
            <span class="bc-cat">{{ $blog->category }}</span>
            @endif
          </div>
          <div class="bc-body">
            <div class="bc-meta">
              <span>{{ $blog->published_at?->format('d M Y') }}</span>
              <span class="sep">·</span>
              <span>{{ $blog->reading_time }}</span>
              @if($blog->is_featured)
              <span class="sep">·</span>
              <span style="color:var(--magenta);">⭐ Featured</span>
              @endif
            </div>
            <h3 class="bc-title">{{ $blog->title }}</h3>
            <p class="bc-excerpt">{{ Str::limit($blog->excerpt, 130) }}</p>

            @if($blog->tags_list)
            <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:14px;">
              @foreach(array_slice($blog->tags_list, 0, 3) as $tag)
              <a href="{{ route('blog.index', ['tag' => $tag]) }}"
                style="font-size:.72rem;background:var(--bg3);color:var(--muted);padding:3px 10px;border-radius:20px;"
                onclick="event.stopPropagation()">
                #{{ $tag }}
              </a>
              @endforeach
            </div>
            @endif

            <div class="bc-footer">
              <div class="bc-author">
                <div class="bc-av">{{ $blog->author->initials ?? 'A' }}</div>
                <span class="bc-author-name">{{ $blog->author->name ?? 'Akshar Plus' }}</span>
              </div>
              <div style="display:flex;align-items:center;gap:14px;">
                <span style="font-size:.75rem;color:var(--muted2);">👁️ {{ number_format($blog->views) }}</span>
                <span class="read-more">Read →</span>
              </div>
            </div>
          </div>
        </a>
        @empty
        <div class="empty-state">
          <div class="empty-icon">📭</div>
          <h3>No articles found</h3>
          <p>Try a different search or browse all categories.</p>
          <a href="{{ route('blog.index') }}" style="display:inline-block;margin-top:16px;color:var(--violet);font-weight:600;">← Back to all posts</a>
        </div>
        @endforelse
      </div>

      {{-- Pagination --}}
      @if($blogs->hasPages())
      <div class="pagination-wrap">{{ $blogs->links() }}</div>
      @endif
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar">

      {{-- Categories --}}
      @if($categories->count() > 0)
      <div class="sidebar-card">
        <div class="sidebar-title">🏷️ Categories</div>
        <div class="cat-list">
          <a href="{{ route('blog.index') }}"
            class="cat-pill {{ !request('category') ? 'active' : '' }}">All</a>
          @foreach($categories as $cat)
          <a href="{{ route('blog.index', ['category' => $cat]) }}"
            class="cat-pill {{ request('category') == $cat ? 'active' : '' }}">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
      @endif

      {{-- Recent Posts --}}
      @if($recent->count() > 0)
      <div class="sidebar-card">
        <div class="sidebar-title">🕐 Recent Posts</div>
        @foreach($recent as $post)
        <a href="{{ route('blog.show', $post->slug) }}" class="recent-item">
          <div class="recent-thumb">
            @if($post->cover_image)
            <img src="{{ $post->cover_url }}" alt="{{ $post->title }}">
            @endif
          </div>
          <div class="recent-info">
            <h4>{{ Str::limit($post->title, 55) }}</h4>
            <span>{{ $post->published_at?->format('d M Y') }} · {{ $post->reading_time }}</span>
          </div>
        </a>
        @endforeach
      </div>
      @endif

      {{-- Popular Tags --}}
      @php
      $allTags = \App\Models\Blog::published()->pluck('tags')->flatten()->filter()->countBy()->sortDesc()->take(15);
      @endphp
      @if($allTags->count() > 0)
      <div class="sidebar-card">
        <div class="sidebar-title">🔖 Popular Tags</div>
        <div class="tags-cloud">
          @foreach($allTags as $tag => $count)
          <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="tag-chip">
            #{{ $tag }} <span style="opacity:.5;font-size:.68rem;">({{ $count }})</span>
          </a>
          @endforeach
        </div>
      </div>
      @endif

      {{-- Newsletter CTA --}}
      <div class="sidebar-card" style="background:var(--text-h);border-color:transparent;">
        <div style="font-size:1.8rem;margin-bottom:12px;">📬</div>
        <div style="font-family:var(--font-h);font-size:1rem;font-weight:800;color:#fff;margin-bottom:8px;">Stay in the loop</div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.55);line-height:1.6;margin-bottom:16px;">Get the latest articles delivered straight to your inbox.</p>
        <input type="email" placeholder="your@email.com"
          style="width:100%;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:10px;padding:10px 14px;color:#fff;font-size:.85rem;outline:none;margin-bottom:10px;">
        <button style="width:100%;background:var(--grad);border:none;border-radius:10px;padding:11px;color:#fff;font-weight:700;font-size:.85rem;cursor:pointer;">Subscribe →</button>
      </div>

    </aside>
  </div>
</div>

<!-- FOOTER -->
<footer style="background:var(--text-h);color:rgba(255,255,255,.5);text-align:center;padding:32px 5%;font-size:.85rem;border-top:1px solid rgba(255,255,255,.07);">
  <p>© {{ date('Y') }} Akshar Plus · <a href="{{ route('blog.index') }}" style="color:var(--violet);">Blog</a> · <a href="{{ route('home') }}" style="color:var(--violet);">Home</a></p>
</footer>

</body>

</html>