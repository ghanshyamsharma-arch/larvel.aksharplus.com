<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $blog->meta_title ?? $blog->title }} — Akshar Plus Blog</title>
<meta name="description" content="{{ $blog->meta_description ?? $blog->excerpt }}">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
:root{
  --magenta:#e91e8c;--violet:#7c3aed;--blue:#2563eb;--teal:#06b6d4;--orange:#f97316;
  --bg:#f9f8ff;--bg2:#fff;--bg3:#f1f0fa;
  --border:rgba(100,80,200,.1);--border2:rgba(100,80,200,.18);
  --text-h:#0f0a1e;--text:#2d2545;--muted:#7168a0;--muted2:#a89fc8;
  --grad:linear-gradient(135deg,var(--magenta),var(--violet),var(--blue),var(--teal));
  --font-h:'Syne',sans-serif;--font-s:'Lora',Georgia,serif;--font-b:'DM Sans',sans-serif;
  --shadow:0 4px 24px rgba(80,40,180,.1);--shadow-lg:0 16px 48px rgba(80,40,180,.14);
}
html{scroll-behavior:smooth;}
body{background:var(--bg);color:var(--text);font-family:var(--font-b);line-height:1.6;}
::-webkit-scrollbar{width:4px;}::-webkit-scrollbar-thumb{background:var(--grad);border-radius:4px;}
a{color:inherit;text-decoration:none;}
.grad-text{background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

/* Reading progress bar */
#progress-bar{position:fixed;top:0;left:0;height:3px;background:var(--grad);z-index:9999;width:0%;transition:width .1s linear;}

/* NAV */
nav{background:rgba(249,248,255,.92);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:0 5%;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;}
.nav-logo{display:flex;align-items:center;gap:10px;}
.logo-mark{font-family:var(--font-h);font-size:1.15rem;font-weight:800;color:var(--text-h);}
.logo-mark span{background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.nav-links{display:flex;gap:28px;}
.nav-links a{font-size:.88rem;font-weight:500;color:var(--muted);transition:color .2s;}
.nav-links a:hover,.nav-links a.active{color:var(--text-h);}
.btn-cta{background:var(--grad);color:#fff;border:none;border-radius:50px;padding:9px 20px;font-family:var(--font-b);font-weight:700;font-size:.85rem;cursor:pointer;text-decoration:none;box-shadow:0 4px 16px rgba(124,58,237,.3);}

/* HERO */
.post-hero{position:relative;background:var(--text-h);min-height:480px;display:flex;flex-direction:column;justify-content:flex-end;overflow:hidden;}
.hero-cover{position:absolute;inset:0;z-index:0;}
.hero-cover img{width:100%;height:100%;object-fit:cover;opacity:.35;}
.hero-gradient{position:absolute;inset:0;background:linear-gradient(to top,rgba(10,5,25,.95) 0%,rgba(10,5,25,.5) 50%,rgba(10,5,25,.2) 100%);z-index:1;}
.hero-mesh{position:absolute;inset:0;background-image:radial-gradient(circle,rgba(124,58,237,.15) 1px,transparent 1px);background-size:28px 28px;z-index:1;pointer-events:none;}
.hero-content{position:relative;z-index:2;max-width:800px;margin:0 auto;width:100%;padding:60px 5% 52px;}
.hero-back{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.55);font-size:.82rem;font-weight:500;margin-bottom:28px;transition:color .2s;}
.hero-back:hover{color:#fff;}
.hero-cat{display:inline-flex;align-items:center;gap:6px;font-size:.7rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.75);background:rgba(124,58,237,.4);border:1px solid rgba(124,58,237,.5);border-radius:50px;padding:5px 13px;margin-bottom:18px;}
.hero-title{font-family:var(--font-h);font-size:clamp(1.8rem,4.5vw,3.2rem);font-weight:800;color:#fff;line-height:1.1;letter-spacing:-.02em;margin-bottom:20px;}
.hero-meta{display:flex;align-items:center;gap:20px;flex-wrap:wrap;}
.hero-author{display:flex;align-items:center;gap:10px;}
.author-av{width:38px;height:38px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;color:#fff;flex-shrink:0;}
.author-name{font-weight:600;color:#fff;font-size:.88rem;}
.author-date{color:rgba(255,255,255,.5);font-size:.75rem;}
.hero-stats{display:flex;gap:16px;margin-left:auto;}
.hero-stat{display:flex;align-items:center;gap:5px;color:rgba(255,255,255,.55);font-size:.8rem;}

/* LAYOUT */
.post-wrap{max-width:1100px;margin:0 auto;padding:60px 5%;}
.post-layout{display:grid;grid-template-columns:1fr 300px;gap:60px;align-items:start;}

/* ARTICLE BODY */
.post-body{background:var(--bg2);border:1px solid var(--border);border-radius:24px;padding:52px 56px;}
.post-excerpt{font-family:var(--font-s);font-size:1.15rem;font-style:italic;color:var(--muted);line-height:1.75;padding-bottom:32px;margin-bottom:36px;border-bottom:2px solid var(--border);}
.post-content{font-family:var(--font-s);font-size:1.02rem;line-height:1.85;color:var(--text);}
.post-content h2{font-family:var(--font-h);font-size:1.5rem;font-weight:800;color:var(--text-h);margin:40px 0 16px;letter-spacing:-.01em;line-height:1.2;}
.post-content h3{font-family:var(--font-h);font-size:1.15rem;font-weight:700;color:var(--text-h);margin:32px 0 12px;}
.post-content p{margin-bottom:22px;color:var(--text);}
.post-content p:last-child{margin-bottom:0;}
.post-content ul,.post-content ol{margin:0 0 22px 24px;}
.post-content li{margin-bottom:8px;line-height:1.7;}
.post-content strong{font-weight:700;color:var(--text-h);}
.post-content em{font-style:italic;color:var(--muted);}
.post-content a{color:var(--violet);text-decoration:underline;text-decoration-color:rgba(124,58,237,.3);}
.post-content a:hover{text-decoration-color:var(--violet);}
.post-content blockquote{border-left:4px solid var(--violet);padding:20px 24px;background:rgba(124,58,237,.04);border-radius:0 12px 12px 0;margin:28px 0;font-style:italic;color:var(--muted);}
.post-content code{background:var(--bg3);border:1px solid var(--border);border-radius:6px;padding:2px 8px;font-size:.88em;font-family:monospace;color:var(--magenta);}
.post-content pre{background:var(--text-h);border-radius:14px;padding:24px;overflow-x:auto;margin:24px 0;}
.post-content pre code{background:none;border:none;color:#e8e8e8;font-size:.88rem;}
.post-content img{width:100%;border-radius:14px;margin:24px 0;}

/* TAGS */
.post-tags{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-top:40px;padding-top:32px;border-top:1px solid var(--border);}
.post-tags span{font-size:.78rem;font-weight:600;color:var(--muted2);}
.post-tag{padding:5px 14px;background:var(--bg3);border-radius:50px;font-size:.78rem;color:var(--muted);transition:all .2s;}
.post-tag:hover{background:rgba(124,58,237,.1);color:var(--violet);}

/* SHARE */
.share-row{display:flex;align-items:center;gap:12px;margin-top:28px;padding-top:28px;border-top:1px solid var(--border);}
.share-label{font-size:.82rem;font-weight:600;color:var(--muted2);}
.share-btn{width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.9rem;background:var(--bg3);border:1px solid var(--border);cursor:pointer;transition:all .2s;text-decoration:none;}
.share-btn:hover{background:var(--grad);border-color:transparent;transform:translateY(-2px);}

/* AUTHOR BOX */
.author-box{background:linear-gradient(135deg,rgba(124,58,237,.05),rgba(6,182,212,.05));border:1px solid var(--border);border-radius:20px;padding:32px;margin-top:32px;display:flex;gap:20px;align-items:flex-start;}
.author-box-av{width:64px;height:64px;border-radius:18px;background:var(--grad);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.3rem;color:#fff;flex-shrink:0;}
.author-box-info h4{font-family:var(--font-h);font-size:1rem;font-weight:800;color:var(--text-h);margin-bottom:4px;}
.author-box-info p{font-size:.85rem;color:var(--muted);line-height:1.6;}
.author-role{display:inline-block;font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--violet);background:rgba(124,58,237,.1);border-radius:20px;padding:3px 10px;margin-bottom:8px;}

/* SIDEBAR */
.sidebar{display:flex;flex-direction:column;gap:20px;position:sticky;top:84px;}
.sidebar-card{background:var(--bg2);border:1px solid var(--border);border-radius:18px;padding:22px;}
.sidebar-title{font-family:var(--font-h);font-size:.85rem;font-weight:800;color:var(--text-h);margin-bottom:16px;}

/* TOC */
.toc-list{list-style:none;display:flex;flex-direction:column;gap:4px;}
.toc-list li a{font-size:.82rem;color:var(--muted);display:block;padding:6px 10px;border-radius:8px;border-left:2px solid transparent;transition:all .2s;}
.toc-list li a:hover,.toc-list li a.active{color:var(--violet);background:rgba(124,58,237,.06);border-left-color:var(--violet);}

/* Related posts */
.related-item{display:flex;gap:12px;padding:10px 0;border-bottom:1px solid rgba(100,80,200,.06);cursor:pointer;}
.related-item:last-child{border:none;padding-bottom:0;}
.related-thumb{width:64px;height:54px;border-radius:10px;background:linear-gradient(135deg,#1a0d2e,#2d1b69);flex-shrink:0;overflow:hidden;}
.related-thumb img{width:100%;height:100%;object-fit:cover;}
.related-info h4{font-family:var(--font-h);font-size:.8rem;font-weight:700;color:var(--text-h);line-height:1.3;margin-bottom:4px;transition:color .2s;}
.related-item:hover h4{color:var(--violet);}
.related-info span{font-size:.72rem;color:var(--muted2);}

/* RELATED SECTION */
.related-section{margin-top:60px;}
.related-section h2{font-family:var(--font-h);font-size:1.4rem;font-weight:800;color:var(--text-h);margin-bottom:28px;}
.related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.rel-card{background:var(--bg2);border:1px solid var(--border);border-radius:18px;overflow:hidden;transition:all .3s;}
.rel-card:hover{transform:translateY(-5px);box-shadow:var(--shadow-lg);border-color:transparent;}
.rel-cover{height:150px;background:linear-gradient(135deg,#1a0d2e,#2d1b69);overflow:hidden;}
.rel-cover img{width:100%;height:100%;object-fit:cover;}
.rel-body{padding:18px;}
.rel-cat{font-size:.68rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--violet);margin-bottom:6px;}
.rel-title{font-family:var(--font-h);font-size:.9rem;font-weight:700;color:var(--text-h);line-height:1.3;margin-bottom:8px;}
.rel-meta{font-size:.75rem;color:var(--muted2);}

/* Responsive */
@media(max-width:1024px){.post-layout{grid-template-columns:1fr;}.sidebar{position:static;}}
@media(max-width:768px){.post-body{padding:32px 24px;}.hero-content{padding:40px 5% 36px;}.related-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:480px){.nav-links{display:none;}.related-grid{grid-template-columns:1fr;}.hero-stats{display:none;}}
</style>
</head>
<body>

<div id="progress-bar"></div>

<!-- NAV -->
<nav>
  <a class="nav-logo" href="{{ route('home') }}">
    <svg viewBox="0 0 100 100" width="32" height="32" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="g1" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#f53889"/><stop offset="100%" stop-color="#7c3aed"/></linearGradient>
        <linearGradient id="g2" x1="1" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#2563eb"/><stop offset="100%" stop-color="#06b6d4"/></linearGradient>
        <linearGradient id="gc" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="#e91e8c"/><stop offset="50%" stop-color="#fde047"/><stop offset="100%" stop-color="#06b6d4"/></linearGradient>
      </defs>
      <path d="M10 90 L50 10 L58 24 L24 90Z" fill="url(#g1)"/>
      <path d="M90 90 L50 10 L42 24 L76 90Z" fill="url(#g2)"/>
      <rect x="22" y="55" width="56" height="14" rx="7" fill="url(#gc)"/>
    </svg>
    <div class="logo-mark">Akshar<span> Plus</span></div>
  </a>
  <div class="nav-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('blog.index') }}" class="active">Blog</a>
    <a href="#">Features</a>
    <a href="#">Pricing</a>
  </div>
  <a href="#" class="btn-cta">Get Started</a>
</nav>

<!-- HERO -->
<div class="post-hero">
  <div class="hero-cover">
    <img src="{{ $blog->cover_url }}" alt="{{ $blog->title }}">
  </div>
  <div class="hero-gradient"></div>
  <div class="hero-mesh"></div>
  <div class="hero-content">
    <a href="{{ route('blog.index') }}" class="hero-back">← Back to Blog</a>
    @if($blog->category)
      <div><span class="hero-cat">{{ $blog->category }}</span></div>
    @endif
    <h1 class="hero-title">{{ $blog->title }}</h1>
    <div class="hero-meta">
      <div class="hero-author">
        <div class="author-av">{{ $blog->author->initials ?? 'A' }}</div>
        <div>
          <div class="author-name">{{ $blog->author->name ?? 'Akshar Plus' }}</div>
          <div class="author-date">{{ $blog->published_at?->format('d M Y') }}</div>
        </div>
      </div>
      <div class="hero-stats">
        <span class="hero-stat">⏱️ {{ $blog->reading_time }}</span>
        <span class="hero-stat">👁️ {{ number_format($blog->views) }} views</span>
        @if($blog->is_featured)
          <span class="hero-stat" style="color:var(--amber);">⭐ Featured</span>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- CONTENT -->
<div class="post-wrap">
  <div class="post-layout">

    <!-- ARTICLE -->
    <main>
      <div class="post-body">

        @if($blog->excerpt)
          <p class="post-excerpt">{{ $blog->excerpt }}</p>
        @endif

        <div class="post-content" id="postContent">
          {!! $blog->body !!}
        </div>

        <!-- Tags -->
        @if($blog->tags_list)
        <div class="post-tags">
          <span>Tags:</span>
          @foreach($blog->tags_list as $tag)
            <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="post-tag">#{{ $tag }}</a>
          @endforeach
        </div>
        @endif

        <!-- Share -->
        <div class="share-row">
          <span class="share-label">Share:</span>
          <a class="share-btn" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" title="Share on Twitter">𝕏</a>
          <a class="share-btn" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}" target="_blank" title="Share on LinkedIn">in</a>
          <a class="share-btn" href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" title="Share on WhatsApp">💬</a>
          <button class="share-btn" onclick="copyLink()" title="Copy link" id="copyBtn">🔗</button>
        </div>
      </div>

      <!-- Author Box -->
      <div class="author-box">
        <div class="author-box-av">{{ $blog->author->initials ?? 'A' }}</div>
        <div class="author-box-info">
          <div class="author-role">Author</div>
          <h4>{{ $blog->author->name ?? 'Akshar Plus Team' }}</h4>
          <p>{{ $blog->author->bio ?? 'Part of the Akshar Plus team, writing about productivity, team communication, and building better remote workplaces.' }}</p>
        </div>
      </div>

      <!-- Related Posts -->
      @if($related->count() > 0)
      <div class="related-section">
        <h2>📚 Related Articles</h2>
        <div class="related-grid">
          @foreach($related as $rel)
          <a href="{{ route('blog.show', $rel->slug) }}" class="rel-card">
            <div class="rel-cover">
              <img src="{{ $rel->cover_url }}" alt="{{ $rel->title }}">
            </div>
            <div class="rel-body">
              @if($rel->category)
                <div class="rel-cat">{{ $rel->category }}</div>
              @endif
              <div class="rel-title">{{ Str::limit($rel->title, 65) }}</div>
              <div class="rel-meta">{{ $rel->reading_time }} · {{ $rel->published_at?->format('d M Y') }}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif
    </main>

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <!-- TOC -->
      @php
        preg_match_all('/<h2[^>]*>(.*?)<\/h2>/si', $blog->body, $matches);
        $headings = $matches[1] ?? [];
      @endphp
      @if(count($headings) > 0)
      <div class="sidebar-card">
        <div class="sidebar-title">📋 Table of Contents</div>
        <ul class="toc-list">
          @foreach($headings as $i => $heading)
            <li>
              <a href="#heading-{{ $i }}" class="toc-link">{{ strip_tags($heading) }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Post Info -->
      <div class="sidebar-card">
        <div class="sidebar-title">📊 Post Info</div>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.82rem;color:var(--muted);">Published</span>
            <span style="font-size:.82rem;font-weight:600;color:var(--text-h);">{{ $blog->published_at?->format('d M Y') }}</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.82rem;color:var(--muted);">Reading Time</span>
            <span style="font-size:.82rem;font-weight:600;color:var(--text-h);">{{ $blog->reading_time }}</span>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.82rem;color:var(--muted);">Views</span>
            <span style="font-size:.82rem;font-weight:600;color:var(--text-h);">{{ number_format($blog->views) }}</span>
          </div>
          @if($blog->category)
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.82rem;color:var(--muted);">Category</span>
            <a href="{{ route('blog.index', ['category' => $blog->category]) }}"
               style="font-size:.78rem;font-weight:700;background:rgba(124,58,237,.1);color:var(--violet);padding:3px 10px;border-radius:20px;">{{ $blog->category }}</a>
          </div>
          @endif
        </div>
      </div>

      <!-- Related in sidebar -->
      @if($related->count() > 0)
      <div class="sidebar-card">
        <div class="sidebar-title">🔗 More Like This</div>
        @foreach($related as $rel)
        <a href="{{ route('blog.show', $rel->slug) }}" class="related-item">
          <div class="related-thumb">
            <img src="{{ $rel->cover_url }}" alt="{{ $rel->title }}">
          </div>
          <div class="related-info">
            <h4>{{ Str::limit($rel->title, 50) }}</h4>
            <span>{{ $rel->reading_time }}</span>
          </div>
        </a>
        @endforeach
      </div>
      @endif

      <!-- Newsletter -->
      <div class="sidebar-card" style="background:var(--text-h);border-color:transparent;">
        <div style="font-size:1.6rem;margin-bottom:10px;">📬</div>
        <div style="font-family:var(--font-h);font-size:.95rem;font-weight:800;color:#fff;margin-bottom:8px;">Enjoyed this article?</div>
        <p style="font-size:.8rem;color:rgba(255,255,255,.5);line-height:1.6;margin-bottom:14px;">Get the latest posts straight to your inbox.</p>
        <input type="email" placeholder="your@email.com"
               style="width:100%;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:10px;padding:10px 14px;color:#fff;font-size:.82rem;outline:none;margin-bottom:10px;">
        <button style="width:100%;background:var(--grad);border:none;border-radius:10px;padding:11px;color:#fff;font-weight:700;font-size:.82rem;cursor:pointer;">Subscribe →</button>
      </div>

      <!-- Back to Blog -->
      <a href="{{ route('blog.index') }}"
         style="display:flex;align-items:center;justify-content:center;gap:8px;background:var(--bg2);border:1.5px solid var(--border2);border-radius:14px;padding:14px;font-weight:600;font-size:.88rem;color:var(--text);transition:all .2s;"
         onmouseover="this.style.borderColor='var(--violet)';this.style.color='var(--violet)'"
         onmouseout="this.style.borderColor='var(--border2)';this.style.color='var(--text)'">
        ← Back to All Posts
      </a>

    </aside>
  </div>
</div>

<!-- FOOTER -->
<footer style="background:var(--text-h);color:rgba(255,255,255,.5);text-align:center;padding:32px 5%;font-size:.85rem;border-top:1px solid rgba(255,255,255,.07);margin-top:60px;">
  <p>© {{ date('Y') }} Akshar Plus · <a href="{{ route('blog.index') }}" style="color:var(--violet);">Blog</a> · <a href="{{ route('home') }}" style="color:var(--violet);">Home</a></p>
</footer>

<script>
// Reading progress bar
window.addEventListener('scroll', () => {
  const doc = document.documentElement;
  const scrollTop = doc.scrollTop || document.body.scrollTop;
  const scrollHeight = doc.scrollHeight - doc.clientHeight;
  const progress = (scrollTop / scrollHeight) * 100;
  document.getElementById('progress-bar').style.width = progress + '%';
});

// Add IDs to h2 headings for TOC
document.querySelectorAll('#postContent h2').forEach((h, i) => {
  h.id = 'heading-' + i;
});

// TOC active highlight on scroll
const tocLinks = document.querySelectorAll('.toc-link');
const headings = document.querySelectorAll('#postContent h2');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const id = entry.target.id;
      tocLinks.forEach(l => l.classList.remove('active'));
      const active = document.querySelector(`.toc-link[href="#${id}"]`);
      if (active) active.classList.add('active');
    }
  });
}, { rootMargin: '-20% 0px -70% 0px' });
headings.forEach(h => observer.observe(h));

// Copy link
function copyLink() {
  navigator.clipboard.writeText(window.location.href).then(() => {
    const btn = document.getElementById('copyBtn');
    btn.textContent = '✅';
    setTimeout(() => btn.textContent = '🔗', 2000);
  });
}
</script>
</body>
</html>
