{{-- resources/views/frontend/blog/index.blade.php ke TOP pe paste karo, <!DOCTYPE> se pehle --}}

@section('meta_title')
@if(request('search'))
Search: "{{ request('search') }}" — Akshar Plus Blog
@elseif(request('category'))
{{ request('category') }} Articles — Akshar Plus Blog
@elseif(request('tag'))
#{{ request('tag') }} — Akshar Plus Blog
@else
Blog — Stories for Modern Teams | Akshar Plus
@endif
@endsection

@section('meta')
<meta name="description" content="Product updates, remote work guides, productivity tips and team communication insights from Akshar Plus. Learn how to build better remote workplaces.">
<meta name="keywords" content="team communication, remote work, productivity, Akshar Plus, blog, workplace tips">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:title" content="Blog — Stories for Modern Teams | Akshar Plus">
<meta property="og:description" content="Product updates, remote work guides, productivity tips and team communication insights.">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('image/blog-og.png') }}">
<meta property="og:site_name" content="Akshar Plus">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Blog — Stories for Modern Teams">
<meta name="twitter:description" content="Product updates, remote work guides, productivity tips and team communication insights.">
<meta name="twitter:image" content="{{ asset('image/blog-og.png') }}">
<meta name="twitter:site" content="@aksharplus">

{{-- Canonical --}}
<link rel="canonical" href="{{ route('blog.index') }}">
@endsection
@include('frontend.layouts.navbar')

<!-- ════ HERO ════ -->
<section class="blog-hero">
  <div class="hero-inner">
    <div class="hero-eyebrow"><i></i> Akshar Plus Blog</div>
    <h1>Stories for <em>Modern Teams</em></h1>
    <p>Product updates, remote work guides, productivity tips and more — from the Akshar Plus team.</p>
    <form method="GET" action="{{ route('blog.index') }}" class="search-form">
      <input type="text" name="search" placeholder="Search articles…" value="{{ request('search') }}">
      <button type="submit">Search →</button>
    </form>
  </div>
</section>

<!-- ════ MAIN ════ -->
<div class="page-wrap">
  <div class="page-grid">

    <!-- ── LEFT COLUMN ── -->
    <main>

      {{-- FEATURED --}}
      @if($featured->count() > 0 && !request()->hasAny(['search','category','tag']))
      <div class="section-label">
        <h2>⭐ Featured Stories</h2>
        <a href="{{ route('blog.index') }}">All posts →</a>
      </div>
      <div class="featured-grid">

        {{-- Big card --}}
        <a href="{{ route('blog.show', $featured->first()->slug) }}" class="feat-big">
          <div class="cover">
            <img src="{{ $featured->first()->cover_url }}" alt="{{ $featured->first()->title }}">
          </div>
          <div class="overlay">
            @if($featured->first()->category)
            <div class="feat-cat">{{ $featured->first()->category }}</div>
            @endif
            <h3>{{ $featured->first()->title }}</h3>
            <p>{{ Str::limit($featured->first()->excerpt, 100) }}</p>
            <div class="feat-read">Read story →</div>
          </div>
        </a>

        {{-- Two small cards --}}
        <div class="feat-col">
          @foreach($featured->skip(1)->take(2) as $fp)
          <a href="{{ route('blog.show', $fp->slug) }}" class="feat-small">
            <div class="cover">
              <img src="{{ $fp->cover_url }}" alt="{{ $fp->title }}">
            </div>
            <div class="overlay">
              @if($fp->category)<div class="feat-cat">{{ $fp->category }}</div>@endif
              <h4>{{ Str::limit($fp->title, 60) }}</h4>
            </div>
          </a>
          @endforeach
        </div>

      </div>
      @endif

      {{-- FILTER BAR --}}
      @if(request()->hasAny(['search','category','tag']))
      <div class="filter-bar">
        <span>Filtering:</span>
        @if(request('search'))<span class="filter-chip">🔍 "{{ request('search') }}"</span>@endif
        @if(request('category'))<span class="filter-chip">🏷 {{ request('category') }}</span>@endif
        @if(request('tag'))<span class="filter-chip"># {{ request('tag') }}</span>@endif
        <a href="{{ route('blog.index') }}" class="filter-clear">✕ Clear all</a>
      </div>
      @endif

      {{-- ARTICLES HEADING --}}
      <div class="articles-head">
        <h2>{{ request()->hasAny(['search','category','tag']) ? 'Results' : 'All Articles' }}</h2>
        <span class="count">{{ $blogs->total() }} posts</span>
      </div>

      {{-- BLOG CARDS --}}
      <div class="blog-list">
        @forelse($blogs as $blog)
        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card">

          {{-- Thumbnail --}}
          <div class="bc-img">
            <img src="{{ $blog->cover_url }}" alt="{{ $blog->title }}" loading="lazy">
            @if($blog->category)
            <span class="bc-cat-badge">{{ $blog->category }}</span>
            @endif
          </div>

          {{-- Body --}}
          <div class="bc-body">
            <div class="bc-top">
              <div class="bc-meta">
                <span>{{ $blog->published_at?->format('d M Y') }}</span>
                <span class="dot"></span>
                <span>{{ $blog->reading_time }}</span>
                @if($blog->is_featured)
                <span class="dot"></span>
                <span class="bc-feat-badge">⭐ Featured</span>
                @endif
              </div>
              <h3 class="bc-title">{{ $blog->title }}</h3>
              <p class="bc-excerpt">{{ $blog->excerpt }}</p>
              @if($blog->tags_list)
              <div class="bc-tags">
                @foreach(array_slice($blog->tags_list, 0, 3) as $tag)
                <span class="bc-tag">#{{ $tag }}</span>
                @endforeach
              </div>
              @endif
            </div>
            <div class="bc-bottom">
              <div class="bc-author">
                <div class="bc-av">{{ $blog->author->initials ?? 'A' }}</div>
                <span class="bc-author-name">{{ $blog->author->name ?? 'Akshar Plus' }}</span>
              </div>
              <div class="bc-right">
                <span class="bc-views">👁 {{ number_format($blog->views) }}</span>
                <span class="bc-readmore">Read →</span>
              </div>
            </div>
          </div>

        </a>
        @empty
        <div class="empty">
          <div class="icon">📭</div>
          <h3>No articles found</h3>
          <p>Try a different search or browse all categories.</p>
          <a href="{{ route('blog.index') }}">← View all posts</a>
        </div>
        @endforelse
      </div>

      {{-- PAGINATION --}}
      @if($blogs->hasPages())
      <div class="pagi">{{ $blogs->links() }}</div>
      @endif

    </main>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar">

      {{-- Categories --}}
      @if($categories->count() > 0)
      <div class="scard">
        <div class="scard-title">🏷 Categories</div>
        <div class="cat-pills">
          <a href="{{ route('blog.index') }}" class="cat-pill {{ !request('category') ? 'on':'' }}">All</a>
          @foreach($categories as $cat)
          <a href="{{ route('blog.index',['category'=>$cat]) }}" class="cat-pill {{ request('category')==$cat?'on':'' }}">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
      @endif

      {{-- Recent Posts --}}
      @if($recent->count())
      <div class="scard">
        <div class="scard-title">🕐 Recent Posts</div>
        @foreach($recent as $r)
        <a href="{{ route('blog.show',$r->slug) }}" class="recent-item">
          <div class="recent-thumb">
            <img src="{{ $r->cover_url }}" alt="{{ $r->title }}" loading="lazy">
          </div>
          <div class="recent-info">
            <h4>{{ Str::limit($r->title, 52) }}</h4>
            <span>{{ $r->published_at?->format('d M Y') }} · {{ $r->reading_time }}</span>
          </div>
        </a>
        @endforeach
      </div>
      @endif

      {{-- Tags --}}
      @php
      $allTags = \App\Models\Blog::published()->pluck('tags')->flatten()->filter()->countBy()->sortDesc()->take(14);
      @endphp
      @if($allTags->count())
      <div class="scard">
        <div class="scard-title">🔖 Popular Tags</div>
        <div class="tag-cloud">
          @foreach($allTags as $tag => $count)
          <a href="{{ route('blog.index',['tag'=>$tag]) }}">#{{ $tag }} <sup style="opacity:.5;">{{ $count }}</sup></a>
          @endforeach
        </div>
      </div>
      @endif


    </aside>
  </div>
</div>

@include('frontend.layouts.footer')