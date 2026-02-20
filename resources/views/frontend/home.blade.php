{{-- resources/views/frontend/home.blade.php ke TOP pe paste karo --}}

@section('meta_title', 'Best Online Meeting Platform for Business | Akshar Plus')

@section('meta')
<meta name="description" content="Akshar Plus is the best online meeting platform for business. Host secure video meetings, webinars, chat, file sharing, and manage workspaces in one place.">
<meta name="keywords" content="team communication, video calling, live chat, remote work, collaboration platform, screen sharing, file management, workspace, Slack alternative, Zoom alternative">
<meta name="author" content="Akshar Plus">
<meta name="publisher" content="Akshar Plus">
<meta property="og:site_name" content="Akshar Plus">
{{-- Open Graph (Facebook, LinkedIn) --}}
<meta property="og:title" content="best online meeting platform for business | akshar plus" />
<meta property="og:type" content="akshar plus" />
<meta property="og:url" content="https://me.aksharplus.com/" />
<meta property="og:image" content="https://me.aksharplus.com/image/logo.png" />

<link rel="alternate" href="https://me.aksharplus.com/" hreflang="en-us" />
<link rel="alternate" href="https://me.aksharplus.com/" hreflang="en-in" />

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Akshar Plus — Team Communication Platform">
<meta name="twitter:description" content="Replace 4+ tools with one platform. Live chat, HD calls, screen sharing, and smart file management.">
<meta name="twitter:image" content="{{ asset('image/logo.png') }}">
<meta name="twitter:site" content="@aksharplus">
<meta name="twitter:creator" content="@aksharplus">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ url('/') }}">

{{-- Additional SEO --}}
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="googlebot" content="index, follow">
<meta name="google" content="notranslate">

{{-- Geo Tags --}}
<meta name="geo.region" content="IN">
<meta name="geo.placename" content="India">

{{-- Mobile --}}
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Akshar Plus">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

{{-- JSON-LD Schema - Organization --}}
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "AksharPlus",
    "url": "https://me.aksharplus.com/",
    "logo": "https://me.aksharplus.com/image/logo.png",
    "contactPoint": {
      "sameAs": [
        "https://instagram.com/aksharplus",
        "https://linkedin.com/company/aksharplus",
        "https://x.com/aksharplus"
        "@type": "ContactPoint",
        "telephone": "81908 38230",
        "contactType": "technical support",
        "areaServed": ["US", "IN"],
        "availableLanguage": "en"
      }
    }
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "AksharPlus",
    "url": "https://me.aksharplus.com/",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://me.aksharplus.com/{search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "AksharPlus",
    "url": "https://me.aksharplus.com/",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "Web",
    "description": "AksharPlus is a digital platform providing online tools and services.",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "INR"
    }
  }
</script>


@endsection


@include('frontend.layouts.navbar')
@include('frontend.modals.contact-popup')
{{--
  Apni home.blade.php mein empty div ki jagah paste karo
  Nav ke neeche, hero section ke upar
--}}
<div class="announce-bar" id="announceBar">
  <div class="announce-inner">

    {{-- Left: Fixed dot --}}
    <span class="announce-dot"></span>

    {{-- Center: Marquee scrolling H1 --}}
    <div class="announce-marquee-wrap">
      <div class="announce-marquee">
        <h1 class="announce-h1">
          Akshar Plus — The All-in-One Team Communication Platform &nbsp;&nbsp;&nbsp;⭐&nbsp;&nbsp;&nbsp;
          Live Chat · HD Video Calling · Screen Sharing · Smart File Management · Multi-Company Workspaces &nbsp;&nbsp;&nbsp;⭐&nbsp;&nbsp;&nbsp;
          Akshar Plus — The All-in-One Team Communication Platform &nbsp;&nbsp;&nbsp;⭐&nbsp;&nbsp;&nbsp;
          Live Chat · HD Video Calling · Screen Sharing · Smart File Management · Multi-Company Workspaces &nbsp;&nbsp;&nbsp;⭐&nbsp;&nbsp;&nbsp;
        </h1>
      </div>
    </div>

    {{-- Right: Fixed close --}}
    <button class="announce-close"
      onclick="document.getElementById('announceBar').style.display='none'"
      title="Dismiss">✕</button>

  </div>
</div>

<style>
  .announce-bar {
    width: 100%;
    background: linear-gradient(90deg,
        rgba(233, 30, 140, .07) 0%,
        rgba(124, 58, 237, .1) 50%,
        rgba(37, 99, 235, .07) 100%);
    border-bottom: 1px solid rgba(124, 58, 237, .14);
    padding: 10px 16px;
    overflow: hidden;
    margin-top: 68px;
  }

  .hero {
    margin-top: 0;
  }

  .announce-inner {
    max-width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  /* Fixed dot */
  .announce-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #e91e8c;
    flex-shrink: 0;
    box-shadow: 0 0 0 0 rgba(233, 30, 140, .5);
    animation: pulse-dot 2s infinite;
  }

  @keyframes pulse-dot {
    0% {
      box-shadow: 0 0 0 0 rgba(233, 30, 140, .5);
    }

    70% {
      box-shadow: 0 0 0 7px rgba(233, 30, 140, 0);
    }

    100% {
      box-shadow: 0 0 0 0 rgba(233, 30, 140, 0);
    }
  }

  /* Marquee container */
  .announce-marquee-wrap {
    flex: 1;
    overflow: hidden;
    /* Fade edges */
    mask-image: linear-gradient(90deg,
        transparent 0%,
        black 8%,
        black 92%,
        transparent 100%);
    -webkit-mask-image: linear-gradient(90deg,
        transparent 0%,
        black 8%,
        black 92%,
        transparent 100%);
  }

  .announce-marquee {
    display: flex;
    width: max-content;
    animation: marquee-scroll 28s linear infinite;
  }

  .announce-marquee:hover {
    animation-play-state: paused;
  }

  @keyframes marquee-scroll {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-50%);
    }
  }

  /* H1 styled as announcement text */
  .announce-h1 {
    font-size: .85rem;
    font-weight: 600;
    color: #2a2545;
    margin: 0;
    white-space: nowrap;
    letter-spacing: -.01em;
    line-height: 1;
  }

  /* Fixed close */
  .announce-close {
    flex-shrink: 0;
    background: none;
    border: none;
    font-size: .78rem;
    color: #a09abc;
    cursor: pointer;
    padding: 2px 4px;
    line-height: 1;
    transition: color .2s;
  }

  .announce-close:hover {
    color: #2a2545;
  }

  @media (max-width: 560px) {
    .announce-h1 {
      font-size: .78rem;
    }
  }
</style>
<!-- ══════════════════ HERO BANNER (SLIDER) ══════════════════ -->
<section class="hero" id="hero">
  <div class="hero-bg">
    <div class="mesh-blob mb1"></div>
    <div class="mesh-blob mb2"></div>
    <div class="mesh-blob mb3"></div>
  </div>

  <div class="hero-track" id="heroTrack">

    <!-- Slide 1 — Chat -->
    @foreach($heroes as $hero)

    <div class="hero-slide">

      <div class="hero-content">
        <div class="hero-badge badge-purple">
          <span class="dot"></span>
          {{ $hero->tagline }}
        </div>


        <h3 class="hero-h1">
          {!! nl2br(e($hero->title)) !!}
          <br>
          <span class="grad-text">
            {{ $hero->highlight_text }}
          </span>
        </h3>
        <p class="hero-p">
          {{ $hero->description }}

        </p>
        <div class="hero-btns">

          <a target="_blank" title="Our demos" href="{{ (!empty($hero->button_link) && $hero->button_link != '#')  ?$hero->button_link: 'https://aksharplus.com/' }}" class="btn-cta">
            {{ (!empty($hero->button_text) && $hero->button_text != '#') ? $hero->button_text : 'Get demo' }} →
          </a>

          <button
            onclick="openContactModal('explore_features')"
            style="background: white; 
           color: #7c3aed; 
           padding: 14px 28px; 
           border-radius: 12px; 
           border: 2px solid #7c3aed; 
           font-weight: 700; 
           cursor: pointer;">
            Contact us
          </button>
        </div>
      </div>
      <div class="hero-visual">
        <div class="chat-mockup">
          <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$hero->image) }}">

        </div>
      </div>

    </div>

    @endforeach


  </div>

  <!-- Dots + Arrows -->
  <!-- <div class="hero-dots" id="heroDots">
    @for($i = 0; $i < count($heroes); $i++)
      <button class="hero-dot {{ $i == 0 ? 'active' : '' }}"></button>
      @endfor

  </div>
  <div class="hero-arrow-row">
    <button class="hero-arrow" id="heroPrev">←</button>
    <button class="hero-arrow" id="heroNext">→</button>
  </div> -->
</section>
@php

$cardClasses = [
'fc-pink',
'fc-blue',
'fc-teal',
'fc-purple',
'fc-orange',
'fc-grad'
];

$iconClasses = [
'fc-p',
'fc-b',
'fc-t',
'fc-v',
'fc-o',
'fc-g'
];

$delays = [
'reveal-delay-1',
'reveal-delay-2',
'reveal-delay-3'
];

@endphp
<!-- ══════════════════ FEATURES ══════════════════ -->
<section class="features-section" id="features">
  <div class="features-intro reveal visible">
    <div class="section-label"><span class="dot"></span> {{$included->title}}</div>
    {!!$included->description!!}
  </div>
  <div class="features-grid">


    @foreach($services as $index => $service)

    <div class="feature-card 
{{ $cardClasses[array_rand($cardClasses)] }}
reveal 
{{ $delays[array_rand($delays)] }} 
visible">

      <div class="fc-icon 
{{ $iconClasses[array_rand($iconClasses)] }}">
        <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$service->file) }}">

      </div>

      <h3>

        {{ $service->name }}

      </h3>

      <p>

        {!! $service->description !!}

      </p>

    </div>

    @endforeach

  </div>

</section>

<!-- ══════════════════ CALLING ══════════════════ -->
<section class="calling-section" id="calling">
  <div class="calling-grid">
    <div class="calling-visual reveal visible">
      <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$video->image) }}">
    </div>

    <div class="reveal reveal-delay-2 visible">
      <div class="section-label"><span class="dot" style="background:var(--magenta)"></span> {{$video->title}}</div>
      {!!$video->description!!}
    </div>
  </div>
</section>

<!-- ══════════════════ MULTI-COMPANY ══════════════════ -->
<section class="multicomp-section" id="multicompany">
  <div class="multicomp-grid">
    <div class="reveal visible">
      <div class="section-label"><span class="dot" style="background:var(--teal)"></span> {{$multi->title}}</div>
      {!!$multi->description!!}
    </div>

    <div class="reveal reveal-delay-2 visible">
      <div class="workspace-mockup">
        <div class="ws-sidebar">

          <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$multi->image) }}">
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<!-- ══════════════════ PIN + SCHEDULE ══════════════════ -->
<section class="pinschedule-section" id="pinschedule">
  <div style="text-align:center;margin-bottom:72px;" class="reveal visible">
    <div class="section-label"><span class="dot"></span> {{$smartMessage->title}}</div>
    {!!$smartMessage->description!!}
  </div>
  <div class="ps-grid">
    <!-- Pinned Messages -->
    <div class="ps-card reveal reveal-delay-1 visible">
      @if($smartMessage->image)
      <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$smartMessage->image) }}">
      @endif

    </div>

    <!-- Scheduled Messages -->
    <div class="ps-card reveal reveal-delay-2 visible">
      @if($smartMessage->additional_image)
      <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/'.$smartMessage->additional_image) }}">
      @endif
    </div>
  </div>

</section>

<!-- ══════════════════ FILES MEDIA SECTION ══════════════════ -->
<section class="files-section" id="files">

  <div class="files-intro reveal visible">
    <div class="section-label"><span class="dot" style="background:var(--teal)"></span> {{$shared->title}}</div>
    {!!$shared->description!!}
  </div>
  <div class="files-tabs reveal visible">
    <button class="file-tab active" data-tab="images">🖼️ Images</button>
    <button class="file-tab" data-tab="videos">🎬 Videos</button>
    <button class="file-tab" data-tab="audio">🎵 Audio</button>
    <button class="file-tab" data-tab="links">🔗 Links</button>
    <button class="file-tab" data-tab="docs">📄 Documents</button>
  </div>

  <!-- Images -->
  <div class="files-panel active" id="tab-images">
    <div class="files-grid-4">

      @foreach($images as $item)

      <img alt="Akshar Plus" title="Akshar Plus" class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="150">

      @endforeach
    </div>
  </div>

  <!-- Videos -->
  <div class="files-panel" id="tab-videos">
    <div class="files-grid-2">
      @foreach($videos as $item)

      <div class="vid-thumb vid-thumb-img" style="background:linear-gradient(135deg,#1a1030,#2d1b69);">
        <div class="vid-play">
          <div class="vid-play-btn">▶</div>
          <p>{{$item->title}}</p>
        </div>
        <div class="vid-dur">{{$item->size}}</div>
      </div>

      @endforeach




    </div>
  </div>

  <!-- Audio -->
  <div class="files-panel" id="tab-audio">
    <div class="files-list">
      @foreach($audio as $item)

      <div class="audio-item">
        <div class="audio-icon"><img alt="Akshar Plus" title="Akshar Plus" class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
        <div class="audio-info">
          <p>{{$item->title}}</p>
          <span>{{$item->link}}</span>
          <div class="audio-waveform">
            <span style="height:6px;animation-delay:0s"></span>
            <span style="height:14px;animation-delay:.1s"></span>
            <span style="height:10px;animation-delay:.2s"></span>
            <span style="height:18px;animation-delay:.3s"></span>
            <span style="height:8px;animation-delay:.4s"></span>
            <span style="height:16px;animation-delay:.5s"></span>
            <span style="height:12px;animation-delay:.6s"></span>
            <span style="height:6px;animation-delay:.7s"></span>
            <span style="height:14px;animation-delay:.8s"></span>
            <span style="height:10px;animation-delay:.9s"></span>
          </div>
        </div>
        <div class="audio-dur">{{$item->size}}</div>
      </div>

      @endforeach


    </div>
  </div>

  <!-- Links -->
  <div class="files-panel" id="tab-links">
    <div class="files-list">
      @foreach($links as $item)
      <a class="link-item" href="#" title="Akshar Plus">
        <div class="link-favicon"><img alt="Akshar Plus" title="Akshar Plus" class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
        <div class="link-info">
          <p>{{$item->title}}</p><span>{{$item->link}}</span>
        </div>
        <span class="link-arrow">↗</span>
      </a>
      @endforeach

    </div>
  </div>

  <!-- Documents -->
  <div class="files-panel" id="tab-docs">
    <div class="files-list">
      @foreach($docs as $item)
      <div class="doc-item">
        <div class="doc-icon" style="background:rgba(37,99,235,.1);"><img alt="Akshar Plus" title="Akshar Plus" class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
        <div class="doc-info">
          <p>{{$item->title}}</p><span>{{$item->link}} </span>
        </div>
        <div class="doc-size">{{$item->size}}</div>
      </div>
      @endforeach



    </div>
  </div>
</section>

<!-- ══════════════════ TESTIMONIALS ══════════════════ -->
<section class="testimonials" id="testimonials">
  <div style="text-align:center;margin-bottom:72px;" class="reveal visible">
    <div class="section-label"><span class="dot"></span> {{$reviewSec->title}}</div>
    {!!$reviewSec->description!!}
  </div>

  <div class="testi-track-wrap">
    <div class="testi-track" id="testiTrack">

      @php
      $gradients = [
      'linear-gradient(135deg,#e91e8c,#7c3aed)',
      'linear-gradient(135deg,#2563eb,#06b6d4)',
      'linear-gradient(135deg,#f97316,#fbbf24)',
      'linear-gradient(135deg,#7c3aed,#06b6d4)',
      'linear-gradient(135deg,#e91e8c,#f97316)',
      'linear-gradient(135deg,#06b6d4,#2563eb)',
      ];
      @endphp

      @foreach($testimonials as $index => $item)
      <div class="testi-card">

        <div class="testi-stars">
          @for($i = 1; $i <= 5; $i++)
            <span>★</span>
            @endfor
        </div>

        <p class="testi-quote">{{ $item->content }}</p>

        <div class="testi-author">
          @if($item->avatar)
          <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('storage/' . $item->avatar) }}"
            class="testi-av"
            style="object-fit:cover;"
            alt="{{ $item->name }}">
          @else
          @php
          $initials = strtoupper(implode('', array_map(
          fn($w) => $w[0],
          array_filter(explode(' ', trim($item->name)))
          )));
          $initials = substr($initials, 0, 2);
          $grad = $gradients[$index % count($gradients)];
          @endphp
          <div class="testi-av"
            style="background: {{ $grad }};">
            {{ $initials }}
          </div>

          @endif

          <div>
            <div class="testi-name">{{ $item->name }}</div>
            <div class="testi-role">
              {{ $item->designation }}@if($item->company) · {{ $item->company }}@endif
            </div>
          </div>
        </div>

      </div>
      @endforeach

    </div>
  </div>

  <div class="testi-footer">
    <div class="testi-dots" id="testiDots">
      @foreach($testimonials as $index => $item)
      <button class="t-dot {{ $index === 0 ? 'active' : '' }}"></button>
      @endforeach
    </div>



    <div class="testi-arrows">
      <button class="t-arrow" id="testiPrev">←</button>
      <button class="t-arrow" id="testiNext">→</button>
    </div>
  </div>
</section>
@include('frontend.layouts.footer')