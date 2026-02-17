{{-- resources/views/frontend/blog/show.blade.php ke TOP pe paste karo --}}

@section('meta_title', ($blog->meta_title ?? $blog->title) . ' — Akshar Plus Blog')

@section('meta')
<meta name="description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt ?? $blog->body), 155) }}">
<meta name="keywords" content="{{ isset($blog->tags_list) && is_array($blog->tags_list) ? implode(', ', $blog->tags_list) : 'Akshar Plus, team communication, blog' }}">
<meta name="author" content="{{ $blog->author->name ?? 'Akshar Plus' }}">
<meta name="publisher" content="Akshar Plus">
<meta property="og:site_name" content="Akshar Plus">
{{-- Open Graph (Facebook, LinkedIn) --}}
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $blog->meta_title ?? $blog->title }}">
<meta property="og:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt ?? $blog->body), 155) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $blog->cover_url }}">
<meta property="og:site_name" content="Akshar Plus">
<meta property="article:published_time" content="{{ optional($blog->published_at)->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $blog->updated_at->toIso8601String() }}">
@if(isset($blog->tags_list) && is_array($blog->tags_list))
@foreach($blog->tags_list as $tag)
<meta property="article:tag" content="{{ $tag }}">
@endforeach
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->meta_title ?? $blog->title }}">
<meta name="twitter:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->excerpt ?? $blog->body), 155) }}">
<meta name="twitter:image" content="{{ $blog->cover_url }}">
<meta name="twitter:site" content="@aksharplus">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ url()->current() }}">
@endsection
@include('frontend.layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  *,
  *::before,
  *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  :root {
    --pink: #e91e8c;
    --violet: #7c3aed;
    --blue: #2563eb;
    --teal: #06b6d4;
    --bg: #f7f6ff;
    --white: #ffffff;
    --surface: #f1f0fa;
    --border: rgba(100, 80, 200, .12);
    --border2: rgba(100, 80, 200, .2);
    --ink: #0d0a1e;
    --ink2: #2a2545;
    --muted: #6b6490;
    --muted2: #a09abc;
    --grad: linear-gradient(135deg, #e91e8c, #7c3aed 45%, #2563eb 75%, #06b6d4);
    --serif: 'Playfair Display', Georgia, serif;
    --sans: 'Plus Jakarta Sans', sans-serif;
    --shadow-sm: 0 2px 12px rgba(80, 40, 180, .08);
    --shadow: 0 6px 28px rgba(80, 40, 180, .12);
    --shadow-lg: 0 16px 48px rgba(80, 40, 180, .16);
    --radius: 16px;
    --radius-sm: 10px;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    background: var(--bg);
    color: var(--ink2);
    font-family: var(--sans);
    -webkit-font-smoothing: antialiased;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  img {
    display: block;
  }

  ::-webkit-scrollbar {
    width: 4px;
  }

  ::-webkit-scrollbar-thumb {
    background: var(--grad);
    border-radius: 4px;
  }

  /* ══════════════════════════════════════
   READING PROGRESS
══════════════════════════════════════ */
  #rp {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    width: 0%;
    background: var(--grad);
    z-index: 9999;
    transition: width .1s linear;
  }

  /* ══════════════════════════════════════
   NAV
══════════════════════════════════════ */
  .nav {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(247, 246, 255, .92);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    height: 64px;
    display: flex;
    align-items: center;
    padding: 0 clamp(16px, 5%, 64px);
    justify-content: space-between;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: var(--serif);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
  }

  .nav-logo svg {
    flex-shrink: 0;
  }

  .nav-logo span {
    background: var(--grad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 28px;
  }

  .nav-links a {
    font-size: .88rem;
    font-weight: 500;
    color: var(--muted);
    transition: color .2s;
  }

  .nav-links a:hover,
  .nav-links a.active {
    color: var(--ink);
  }

  .nav-cta {
    background: var(--grad);
    color: #fff;
    padding: 9px 22px;
    border-radius: 50px;
    font-weight: 700;
    font-size: .85rem;
    box-shadow: 0 4px 14px rgba(124, 58, 237, .3);
  }

  /* ══════════════════════════════════════
   POST HERO
══════════════════════════════════════ */
  .post-hero {
    position: relative;
    min-height: 440px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    background: var(--ink);
    overflow: hidden;
  }

  .hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
  }

  .hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .3;
    display: block;
  }

  .hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10, 5, 25, .96) 0%, rgba(10, 5, 25, .6) 50%, rgba(10, 5, 25, .25) 100%);
  }

  /* Dot grid overlay */
  .hero-dots {
    position: absolute;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    background-image: radial-gradient(circle, rgba(255, 255, 255, .05) 1px, transparent 1px);
    background-size: 30px 30px;
  }

  .hero-content {
    position: relative;
    z-index: 2;
    max-width: 860px;
    margin: 0 auto;
    width: 100%;
    padding: 60px clamp(16px, 5%, 64px) 52px;
  }

  .hero-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .82rem;
    font-weight: 500;
    color: rgba(255, 255, 255, .5);
    margin-bottom: 24px;
    transition: color .2s;
  }

  .hero-back:hover {
    color: #fff;
  }

  .hero-cat {
    display: inline-block;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    background: rgba(124, 58, 237, .5);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(124, 58, 237, .4);
    color: #fff;
    padding: 5px 14px;
    border-radius: 50px;
    margin-bottom: 18px;
  }

  .hero-title {
    font-family: var(--serif);
    font-weight: 900;
    font-size: clamp(1.7rem, 4vw, 3rem);
    color: #fff;
    line-height: 1.1;
    letter-spacing: -.02em;
    margin-bottom: 24px;
  }

  .hero-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  .hero-author {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .h-av {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    flex-shrink: 0;
    background: var(--grad);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: .8rem;
    color: #fff;
  }

  .h-av img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
  }

  .h-name {
    font-weight: 600;
    color: #fff;
    font-size: .88rem;
  }

  .h-date {
    color: rgba(255, 255, 255, .45);
    font-size: .75rem;
    margin-top: 1px;
  }

  .hero-stats {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-left: auto;
  }

  .h-stat {
    font-size: .8rem;
    color: rgba(255, 255, 255, .5);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  /* ══════════════════════════════════════
   CONTENT LAYOUT
══════════════════════════════════════ */
  .content-wrap {
    max-width: 1160px;
    margin: 0 auto;
    padding: 52px clamp(16px, 5%, 64px);
  }

  .content-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 52px;
    align-items: start;
  }

  /* ══════════════════════════════════════
   ARTICLE CARD
══════════════════════════════════════ */
  .article-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
  }

  .article-inner {
    padding: clamp(24px, 5%, 52px);
  }

  /* Excerpt */
  .art-excerpt {
    font-family: var(--serif);
    font-style: italic;
    font-size: 1.1rem;
    color: var(--muted);
    line-height: 1.75;
    padding-bottom: 28px;
    margin-bottom: 32px;
    border-bottom: 2px solid var(--border);
  }

  /* Body typography */
  .art-body {
    font-family: var(--serif);
    font-size: 1.02rem;
    line-height: 1.88;
    color: var(--ink2);
  }

  .art-body h2 {
    font-family: var(--serif);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    margin: 38px 0 14px;
    line-height: 1.2;
    padding-left: 16px;
    border-left: 3px solid var(--violet);
  }

  .art-body h3 {
    font-family: var(--serif);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
    margin: 28px 0 10px;
  }

  .art-body p {
    margin-bottom: 22px;
  }

  .art-body p:last-child {
    margin-bottom: 0;
  }

  .art-body ul,
  .art-body ol {
    margin: 0 0 22px 22px;
  }

  .art-body li {
    margin-bottom: 8px;
    line-height: 1.72;
  }

  .art-body strong {
    font-weight: 700;
    color: var(--ink);
  }

  .art-body em {
    font-style: italic;
    color: var(--muted);
  }

  .art-body a {
    color: var(--violet);
    text-decoration: underline;
    text-decoration-color: rgba(124, 58, 237, .3);
  }

  .art-body a:hover {
    text-decoration-color: var(--violet);
  }

  .art-body blockquote {
    border-left: 3px solid var(--violet);
    padding: 18px 22px;
    margin: 24px 0;
    background: rgba(124, 58, 237, .04);
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    font-style: italic;
    color: var(--muted);
  }

  .art-body code {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 5px;
    padding: 2px 7px;
    font-size: .86em;
    font-family: monospace;
    color: var(--pink);
  }

  .art-body pre {
    background: var(--ink);
    border-radius: var(--radius-sm);
    padding: 22px;
    overflow-x: auto;
    margin: 20px 0;
  }

  .art-body pre code {
    background: none;
    border: none;
    color: #e0ddf5;
    font-size: .86rem;
  }

  .art-body img {
    width: 100%;
    border-radius: var(--radius-sm);
    margin: 20px 0;
  }

  /* Tags */
  .art-tags {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    padding: 22px 0 0;
    margin-top: 28px;
    border-top: 1px solid var(--border);
  }

  .art-tags label {
    font-size: .78rem;
    font-weight: 600;
    color: var(--muted2);
  }

  .art-tag {
    font-size: .75rem;
    background: var(--surface);
    color: var(--muted);
    padding: 4px 12px;
    border-radius: 20px;
    transition: all .2s;
  }

  .art-tag:hover {
    background: rgba(124, 58, 237, .1);
    color: var(--violet);
  }

  /* Share */
  .art-share {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    padding: 18px 0 0;
    margin-top: 18px;
    border-top: 1px solid var(--border);
  }

  .share-label {
    font-size: .8rem;
    font-weight: 600;
    color: var(--muted2);
  }

  .share-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--surface);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .82rem;
    font-weight: 700;
    color: var(--muted);
    cursor: pointer;
    transition: all .2s;
  }

  .share-btn:hover {
    background: var(--violet);
    color: #fff;
    border-color: var(--violet);
  }

  /* Author box */
  .author-box {
    margin-top: 28px;
    padding: 26px;
    background: linear-gradient(135deg, rgba(124, 58, 237, .05), rgba(6, 182, 212, .04));
    border: 1px solid var(--border);
    border-radius: var(--radius);
    display: flex;
    gap: 18px;
    align-items: flex-start;
  }

  .auth-av {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    flex-shrink: 0;
    background: var(--grad);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.2rem;
    color: #fff;
  }

  .auth-info .role {
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--violet);
    background: rgba(124, 58, 237, .1);
    padding: 2px 10px;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 6px;
  }

  .auth-info h4 {
    font-family: var(--serif);
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 5px;
  }

  .auth-info p {
    font-size: .84rem;
    color: var(--muted);
    line-height: 1.6;
  }

  /* ══════════════════════════════════════
   RELATED POSTS
══════════════════════════════════════ */
  .related {
    margin-top: 40px;
  }

  .related h2 {
    font-family: var(--serif);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 20px;
  }

  .related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
  }

  .rel-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all .3s;
    cursor: pointer;
  }

  .rel-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(124, 58, 237, .15);
  }

  .rel-cover {
    height: 140px;
    background: linear-gradient(135deg, #1a0d2e, #2d1b69);
    overflow: hidden;
  }

  .rel-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .75;
    transition: transform .4s;
  }

  .rel-card:hover .rel-cover img {
    transform: scale(1.06);
  }

  .rel-body {
    padding: 16px;
  }

  .rel-cat {
    font-size: .66rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--violet);
    margin-bottom: 5px;
  }

  .rel-title {
    font-family: var(--serif);
    font-size: .88rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
    margin-bottom: 6px;
  }

  .rel-meta {
    font-size: .73rem;
    color: var(--muted2);
  }

  /* ══════════════════════════════════════
   SIDEBAR
══════════════════════════════════════ */
  .sidebar {
    position: sticky;
    top: 80px;
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .scard {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
  }

  .scard-title {
    font-family: var(--serif);
    font-size: .88rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 14px;
  }

  /* TOC */
  .toc-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .toc-list li a {
    display: block;
    padding: 7px 12px;
    border-radius: var(--radius-sm);
    font-size: .82rem;
    color: var(--muted);
    border-left: 2px solid transparent;
    transition: all .2s;
  }

  .toc-list li a:hover,
  .toc-list li a.active {
    color: var(--violet);
    background: rgba(124, 58, 237, .06);
    border-left-color: var(--violet);
  }

  /* Post info */
  .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
  }

  .info-row:last-child {
    border: none;
    padding-bottom: 0;
  }

  .info-label {
    font-size: .8rem;
    color: var(--muted);
  }

  .info-val {
    font-size: .8rem;
    font-weight: 600;
    color: var(--ink);
  }

  .info-cat {
    font-size: .74rem;
    font-weight: 700;
    background: rgba(124, 58, 237, .1);
    color: var(--violet);
    padding: 2px 10px;
    border-radius: 20px;
  }

  /* Related in sidebar */
  .sr-item {
    display: flex;
    gap: 10px;
    padding: 9px 0;
    border-bottom: 1px solid var(--border);
  }

  .sr-item:last-child {
    border: none;
    padding-bottom: 0;
  }

  .sr-thumb {
    width: 54px;
    height: 48px;
    border-radius: var(--radius-sm);
    flex-shrink: 0;
    background: linear-gradient(135deg, #1a0d2e, #2d1b69);
    overflow: hidden;
  }

  .sr-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .7;
  }

  .sr-info h4 {
    font-size: .78rem;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.3;
    margin-bottom: 3px;
    transition: color .2s;
  }

  .sr-item:hover h4 {
    color: var(--violet);
  }

  .sr-info span {
    font-size: .7rem;
    color: var(--muted2);
  }

  /* Newsletter */
  .scard-dark {
    background: var(--ink);
    border-color: transparent;
  }

  .scard-dark .scard-title {
    color: #fff;
  }

  .scard-dark .sub-desc {
    font-size: .8rem;
    color: rgba(255, 255, 255, .45);
    line-height: 1.6;
    margin-bottom: 14px;
  }

  .scard-dark input {
    width: 100%;
    background: rgba(255, 255, 255, .08);
    border: 1px solid rgba(255, 255, 255, .14);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
    color: #fff;
    font-family: var(--sans);
    font-size: .82rem;
    outline: none;
    margin-bottom: 10px;
  }

  .scard-dark button {
    width: 100%;
    background: var(--grad);
    border: none;
    border-radius: var(--radius-sm);
    padding: 11px;
    color: #fff;
    font-family: var(--sans);
    font-weight: 700;
    font-size: .82rem;
    cursor: pointer;
  }

  /* Back link */
  .back-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    background: var(--white);
    border: 1.5px solid var(--border2);
    border-radius: var(--radius);
    padding: 13px;
    font-size: .85rem;
    font-weight: 600;
    color: var(--ink2);
    transition: all .2s;
  }

  .back-link:hover {
    border-color: var(--violet);
    color: var(--violet);
  }

  /* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
  @media(max-width:1060px) {
    .content-grid {
      grid-template-columns: 1fr;
    }

    .sidebar {
      position: static;
    }

    .related-grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media(max-width:640px) {
    .nav-links {
      display: none;
    }

    .hero-stats {
      display: none;
    }

    .related-grid {
      grid-template-columns: 1fr;
    }

    .article-inner {
      padding: 20px;
    }
  }
</style>


<div id="rp"></div>

<!-- ════ NAV ════ -->
<nav class="nav">
  <a href="{{ route('home') }}" class="nav-logo" title="Logo">
    <svg viewBox="0 0 100 100" width="34" height="34" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="ng1" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0%" stop-color="#f53889" />
          <stop offset="100%" stop-color="#7c3aed" />
        </linearGradient>
        <linearGradient id="ng2" x1="1" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="#2563eb" />
          <stop offset="100%" stop-color="#06b6d4" />
        </linearGradient>
        <linearGradient id="ngc" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0%" stop-color="#e91e8c" />
          <stop offset="50%" stop-color="#fde047" />
          <stop offset="100%" stop-color="#06b6d4" />
        </linearGradient>
      </defs>
      <path d="M10 90 L50 10 L58 24 L24 90Z" fill="url(#ng1)" />
      <path d="M90 90 L50 10 L42 24 L76 90Z" fill="url(#ng2)" />
      <rect x="22" y="55" width="56" height="14" rx="7" fill="url(#ngc)" />
    </svg>
    Akshar <span>Plus</span>
  </a>
  <div class="nav-links">
    <a href="{{ route('home') }}" title="Home">Home</a>
    <a href="{{ route('blog.index') }}" class="active" title="Blog">Blog</a>
    <a href="{{ route('home') }}#features" title="Features">Features</a>
  </div>
  <a href="#" class="nav-cta" title="Get Started">Get Started</a>
</nav>

<!-- ════ HERO ════ -->
<div class="post-hero">
  <div class="hero-bg">
    <img src="{{ $blog->cover_url }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">
  </div>
  <div class="hero-dots"></div>
  <div class="hero-content">
    <a href="{{ route('blog.index') }}" class="hero-back" title="Back to Blog">← Back to Blog</a>
    @if($blog->category)
    <div><span class="hero-cat">{{ $blog->category }}</span></div>
    @endif
    <h1 class="hero-title">{{ $blog->title }}</h1>
    <div class="hero-meta">
      <div class="hero-author">
        <div class="h-av">{{ $blog->author->initials ?? 'A' }}</div>
        <div>
          <div class="h-name">{{ $blog->author->name ?? 'Akshar Plus' }}</div>
          <div class="h-date">{{ $blog->published_at?->format('d M Y') }}</div>
        </div>
      </div>
      <div class="hero-stats">
        <span class="h-stat">⏱ {{ $blog->reading_time }}</span>
        <span class="h-stat">👁 {{ number_format($blog->views) }} views</span>
        @if($blog->is_featured)<span class="h-stat" style="color:var(--pink);">⭐ Featured</span>@endif
      </div>
    </div>
  </div>
</div>

<!-- ════ CONTENT ════ -->
<div class="content-wrap">
  <div class="content-grid">

    <!-- ── ARTICLE ── -->
    <main>
      <div class="article-card">
        <div class="article-inner">

          @if($blog->excerpt)
          <p class="art-excerpt">{{ $blog->excerpt }}</p>
          @endif

          <div class="art-body" id="artBody">
            {!! $blog->body !!}
          </div>

          {{-- Tags --}}
          @if($blog->tags_list)
          <div class="art-tags">
            <label>Tags:</label>
            @foreach($blog->tags_list as $tag)
            <a href="{{ route('blog.index',['tag'=>$tag]) }}" class="art-tag" title="{{ $tag }}">#{{ $tag }}</a>
            @endforeach
          </div>
          @endif

          {{-- Share --}}
          <div class="art-share">
            <span class="share-label">Share:</span>
            <a class="share-btn" href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" title="Twitter">𝕏</a>
            <a class="share-btn" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}" target="_blank" title="LinkedIn" style="font-size:.7rem;">in</a>
            <a class="share-btn" href="https://wa.me/?text={{ urlencode($blog->title.' '.request()->url()) }}" target="_blank" title="WhatsApp">💬</a>
            <button class="share-btn" id="copyBtn" onclick="copyLink()" title="Copy link">🔗</button>
          </div>

        </div>
      </div>

      {{-- Author box --}}
      <div class="author-box">
        <div class="auth-av">{{ $blog->author->initials ?? 'A' }}</div>
        <div class="auth-info">
          <span class="role">Author</span>
          <h4>{{ $blog->author->name ?? 'Akshar Plus Team' }}</h4>
          <!-- <p>{{ $blog->author->bio ?? 'Part of the Akshar Plus team, writing about productivity, team communication, and building better remote workplaces.' }}</p> -->
        </div>
      </div>

      {{-- Related --}}
      @if($related->count() > 0)
      <div class="related">
        <h2>📚 Related Articles</h2>
        <div class="related-grid">
          @foreach($related as $rel)
          <a href="{{ route('blog.show',$rel->slug) }}" class="rel-card" title="{{ $rel->title }}">
            <div class="rel-cover">
              <img src="{{ $rel->cover_url }}" alt="{{ $rel->title }}" title="{{ $rel->title }}" loading="lazy">
            </div>
            <div class="rel-body">
              @if($rel->category)<div class="rel-cat">{{ $rel->category }}</div>@endif
              <div class="rel-title">{{ Str::limit($rel->title,64) }}</div>
              <div class="rel-meta">{{ $rel->reading_time }} · {{ $rel->published_at?->format('d M Y') }}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif
    </main>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar">

      {{-- TOC --}}
      @php preg_match_all('#<h2[^>]*>(.*?)</h2>#si',$blog->body,$m); $hs=$m[1]??[]; @endphp
        @if(count($hs))
        <div class="scard">
          <div class="scard-title">📋 Table of Contents</div>
          <ul class="toc-list">
            @foreach($hs as $i=>$h)
            <li><a href="#h-{{$i}}" title="Table of Contents" class="toc-link">{{ strip_tags($h) }}</a></li>
            @endforeach
          </ul>
        </div>
        @endif

        {{-- Post Info --}}
        <div class="scard">
          <div class="scard-title">📊 Post Info</div>
          <div class="info-row"><span class="info-label">Published</span><span class="info-val">{{ $blog->published_at?->format('d M Y') }}</span></div>
          <div class="info-row"><span class="info-label">Reading Time</span><span class="info-val">{{ $blog->reading_time }}</span></div>
          <div class="info-row"><span class="info-label">Views</span><span class="info-val">{{ number_format($blog->views) }}</span></div>
          @if($blog->category)
          <div class="info-row"><span class="info-label">Category</span><a href="{{ route('blog.index',['category'=>$blog->category]) }}" class="info-cat" title="{{ $blog->category }}">{{ $blog->category }}</a></div>
          @endif
        </div>

        {{-- More Like This --}}
        @if($related->count())
        <div class="scard">
          <div class="scard-title">🔗 More Like This</div>
          @foreach($related as $r)
          <a href="{{ route('blog.show',$r->slug) }}" class="sr-item" title="{{ $r->title }} ">
            <div class="sr-thumb"><img src="{{ $r->cover_url }}" alt="{{ $r->title }}" title="{{ $r->title }} " loading="lazy"></div>
            <div class="sr-info">
              <h4>{{ Str::limit($r->title,50) }}</h4>
              <span>{{ $r->reading_time }}</span>
            </div>
          </a>
          @endforeach
        </div>
        @endif



        {{-- Back link --}}
        <a href="{{ route('blog.index') }}" class="back-link" title="Back to All Posts">← Back to All Posts</a>

    </aside>
  </div>
</div>

<script>
  // Reading progress
  window.addEventListener('scroll', () => {
    const d = document.documentElement;
    document.getElementById('rp').style.width = ((d.scrollTop / (d.scrollHeight - d.clientHeight)) * 100) + '%';
  });

  // Add IDs to h2s for TOC
  document.querySelectorAll('#artBody h2').forEach((h, i) => h.id = 'h-' + i);

  // TOC highlight
  const tls = document.querySelectorAll('.toc-link');
  const hs2 = document.querySelectorAll('#artBody h2');
  if (hs2.length) {
    const ob = new IntersectionObserver(es => {
      es.forEach(e => {
        if (e.isIntersecting) {
          tls.forEach(l => l.classList.remove('active'));
          const a = document.querySelector('.toc-link[href="#' + e.target.id + '"]');
          if (a) a.classList.add('active');
        }
      });
    }, {
      rootMargin: '-20% 0px -70% 0px'
    });
    hs2.forEach(h => ob.observe(h));
  }

  // Copy link
  function copyLink() {
    navigator.clipboard.writeText(location.href).then(() => {
      const b = document.getElementById('copyBtn');
      b.textContent = '✅';
      setTimeout(() => b.textContent = '🔗', 2000);
    });
  }
</script>


@include('frontend.layouts.footer')