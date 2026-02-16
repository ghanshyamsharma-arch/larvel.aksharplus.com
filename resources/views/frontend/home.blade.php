@include('frontend.layouts.navbar')


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


        <h1 class="hero-h1">
          {!! nl2br(e($hero->title)) !!}
          <br>
          <span class="grad-text">
            {{ $hero->highlight_text }}
          </span>
        </h1>
        <p class="hero-p">
          {{ $hero->description }}

        </p>
        <div class="hero-btns">

          <a href="{{ $hero->button_link }}" class="btn-cta">
            {{ $hero->button_text }} →
          </a>

          <a href="#features" class="btn-ghost">
            Explore Features
          </a>
        </div>
      </div>
      <div class="hero-visual">
        <div class="chat-mockup">
          <img src="{{ asset('storage/'.$hero->image) }}">

        </div>
      </div>

    </div>

    @endforeach


  </div>

  <!-- Dots + Arrows -->
  <div class="hero-dots" id="heroDots">
    @for($i = 0; $i < count($heroes); $i++)
      <button class="hero-dot {{ $i == 0 ? 'active' : '' }}"></button>
      @endfor

  </div>
  <div class="hero-arrow-row">
    <button class="hero-arrow" id="heroPrev">←</button>
    <button class="hero-arrow" id="heroNext">→</button>
  </div>
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
        <img src="{{ asset('storage/'.$service->file) }}">

      </div>

      <h3>

        {{ $service->name }}

      </h3>

      <p>

        {{ $service->description }}

      </p>

    </div>

    @endforeach

  </div>

</section>

<!-- ══════════════════ CALLING ══════════════════ -->
<section class="calling-section" id="calling">
  <div class="calling-grid">
    <div class="calling-visual reveal visible">
      <img src="{{ asset('storage/'.$video->image) }}">
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

          <img src="{{ asset('storage/'.$multi->image) }}">
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
      <img src="{{ asset('storage/'.$smartMessage->image) }}">
      @endif

    </div>

    <!-- Scheduled Messages -->
    <div class="ps-card reveal reveal-delay-2 visible">
      @if($smartMessage->additional_image)
      <img src="{{ asset('storage/'.$smartMessage->additional_image) }}">
      @endif
    </div>
  </div>

</section>

<!-- ══════════════════ FILES MEDIA SECTION ══════════════════ -->
<section class="files-section" id="files">
  <div class="files-intro reveal visible">
    <div class="section-label"><span class="dot" style="background:var(--teal)"></span> Shared Media</div>
    <h2 class="section-title">All Your Files,<br><span class="grad-text">Auto-Organised</span></h2>
    <p class="section-sub" style="margin:0 auto;">Every file shared in a channel is automatically sorted by type. Find any image, video, audio clip, link, or document instantly — no searching through old messages.</p>
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

      <img class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="150">

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
        <div class="audio-icon"><img class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
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
      <a class="link-item" href="#">
        <div class="link-favicon"><img class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
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
        <div class="doc-icon" style="background:rgba(37,99,235,.1);"><img class="img-thumb" src="{{ asset('storage/'.$item->file) }}" width="20"></div>
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
          <img src="{{ asset('storage/' . $item->avatar) }}"
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