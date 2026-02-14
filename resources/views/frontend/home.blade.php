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
    <div class="section-label"><span class="dot"></span> Smart Messaging</div>
    <h2 class="section-title">Pin Important Updates &amp;<br><span class="grad-text">Schedule Any Message</span></h2>
    <p class="section-sub" style="margin:0 auto;">Keep your team focused on what matters. Pin critical announcements and schedule messages to go out at exactly the right time — even while you're offline.</p>
  </div>
  <div class="ps-grid">
    <!-- Pinned Messages -->
    <div class="ps-card reveal reveal-delay-1 visible">
      <div class="ps-card-head">
        <div class="ps-head-icon pin-bg">📌</div>
        <h3>Pinned Messages</h3>
        <span style="margin-left:auto;background:rgba(251,191,36,.15);color:#b45309;font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:20px;">3 pinned</span>
      </div>
      <div class="ps-card-body">
        <div class="pin-item">
          <div class="pin-dot" style="background:var(--violet);"></div>
          <div class="pin-text">
            <p>Q4 OKR Document — Now Live</p>
            <span>Pinned by Sonia R. · #general · 2 hrs ago</span>
          </div>
          <button class="pin-unpin">Unpin</button>
        </div>
        <div class="pin-item">
          <div class="pin-dot" style="background:var(--teal);"></div>
          <div class="pin-text">
            <p>New API credentials shared</p>
            <span>Pinned by Arjun M. · #engineering · 1 day ago</span>
          </div>
          <button class="pin-unpin">Unpin</button>
        </div>
        <div class="pin-item">
          <div class="pin-dot" style="background:var(--amber);"></div>
          <div class="pin-text">
            <p>All-hands call: Friday 5 PM</p>
            <span>Pinned by Admin · #announcements · 3 days ago</span>
          </div>
          <button class="pin-unpin">Unpin</button>
        </div>
      </div>
    </div>

    <!-- Scheduled Messages -->
    <div class="ps-card reveal reveal-delay-2 visible">
      <div class="ps-card-head">
        <div class="ps-head-icon sched-bg">⏰</div>
        <h3>Scheduled Messages</h3>
        <span style="margin-left:auto;background:rgba(37,99,235,.1);color:var(--blue);font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:20px;">4 queued</span>
      </div>
      <div class="ps-card-body">
        <div class="sched-item">
          <div class="sched-time">Tomorrow 9 AM</div>
          <div class="sched-text">"Good morning team! 🌟 Sprint 12 begins today…"</div>
          <button class="sched-cancel">Cancel</button>
        </div>
        <div class="sched-item">
          <div class="sched-time">Fri 5 PM</div>
          <div class="sched-text">"Weekly wrap-up summary is ready for review…"</div>
          <button class="sched-cancel">Cancel</button>
        </div>
        <div class="sched-item">
          <div class="sched-time">Mon 10 AM</div>
          <div class="sched-text">"Reminder: performance reviews due by EOD…"</div>
          <button class="sched-cancel">Cancel</button>
        </div>
        <div class="sched-item">
          <div class="sched-time">Mon 3 PM</div>
          <div class="sched-text">"Client presentation assets uploaded to Design…"</div>
          <button class="sched-cancel">Cancel</button>
        </div>
      </div>
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
      <div class="img-thumb" style="background:linear-gradient(135deg,#fce4ec,#f8bbd9);font-size:2.5rem;">🎨</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#e8eaf6,#c5cae9);font-size:2.5rem;">📊</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#e0f7fa,#b2ebf2);font-size:2.5rem;">🏔️</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#fff8e1,#ffecb3);font-size:2.5rem;">✨</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#f3e5f5,#e1bee7);font-size:2.5rem;">🖼️</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9);font-size:2.5rem;">🌿</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#fbe9e7,#ffccbc);font-size:2.5rem;">🌅</div>
      <div class="img-thumb" style="background:linear-gradient(135deg,#e1f5fe,#b3e5fc);font-size:2.5rem;">🎭</div>
    </div>
  </div>

  <!-- Videos -->
  <div class="files-panel" id="tab-videos">
    <div class="files-grid-2">
      <div class="vid-thumb vid-thumb-img" style="background:linear-gradient(135deg,#1a1030,#2d1b69);">
        <div class="vid-play">
          <div class="vid-play-btn">▶</div>
          <p>Sprint Review Recording</p>
        </div>
        <div class="vid-dur">24:10</div>
      </div>
      <div class="vid-thumb vid-thumb-img" style="background:linear-gradient(135deg,#0d1b2a,#1a3a5c);">
        <div class="vid-play">
          <div class="vid-play-btn">▶</div>
          <p>Product Demo v2.1</p>
        </div>
        <div class="vid-dur">08:43</div>
      </div>
      <div class="vid-thumb vid-thumb-img" style="background:linear-gradient(135deg,#1a0820,#3d1460);">
        <div class="vid-play">
          <div class="vid-play-btn">▶</div>
          <p>Client Onboarding Walk-through</p>
        </div>
        <div class="vid-dur">15:22</div>
      </div>
      <div class="vid-thumb vid-thumb-img" style="background:linear-gradient(135deg,#0d2818,#1a5c3a);">
        <div class="vid-play">
          <div class="vid-play-btn">▶</div>
          <p>Team Building Event Highlights</p>
        </div>
        <div class="vid-dur">03:57</div>
      </div>
    </div>
  </div>

  <!-- Audio -->
  <div class="files-panel" id="tab-audio">
    <div class="files-list">
      <div class="audio-item">
        <div class="audio-icon">🎵</div>
        <div class="audio-info">
          <p>Weekly Standup — Voice Note</p>
          <span>Sonia R. · #design · Yesterday</span>
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
        <div class="audio-dur">2:34</div>
      </div>
      <div class="audio-item">
        <div class="audio-icon" style="background:linear-gradient(135deg,var(--blue),var(--sky));">🎤</div>
        <div class="audio-info">
          <p>Q4 Kickoff Announcement</p>
          <span>Admin · #general · 3 days ago</span>
          <div class="audio-waveform">
            <span style="height:10px;animation-delay:0s"></span>
            <span style="height:6px;animation-delay:.15s"></span>
            <span style="height:16px;animation-delay:.3s"></span>
            <span style="height:8px;animation-delay:.45s"></span>
            <span style="height:18px;animation-delay:.6s"></span>
            <span style="height:12px;animation-delay:.75s"></span>
            <span style="height:6px;animation-delay:.9s"></span>
            <span style="height:14px;animation-delay:1.05s"></span>
          </div>
        </div>
        <div class="audio-dur">1:12</div>
      </div>
      <div class="audio-item">
        <div class="audio-icon" style="background:linear-gradient(135deg,var(--teal),var(--cyan));">🎙️</div>
        <div class="audio-info">
          <p>Client Feedback Recording</p>
          <span>Priya K. · #client-acme · 1 week ago</span>
          <div class="audio-waveform">
            <span style="height:14px;animation-delay:0s"></span>
            <span style="height:18px;animation-delay:.12s"></span>
            <span style="height:8px;animation-delay:.24s"></span>
            <span style="height:12px;animation-delay:.36s"></span>
            <span style="height:16px;animation-delay:.48s"></span>
            <span style="height:6px;animation-delay:.6s"></span>
            <span style="height:14px;animation-delay:.72s"></span>
            <span style="height:10px;animation-delay:.84s"></span>
          </div>
        </div>
        <div class="audio-dur">4:08</div>
      </div>
    </div>
  </div>

  <!-- Links -->
  <div class="files-panel" id="tab-links">
    <div class="files-list">
      <a class="link-item" href="#">
        <div class="link-favicon">🌐</div>
        <div class="link-info">
          <p>Akshar Plus Documentation</p><span>docs.aksharplus.io · Shared by Arjun M. · Today</span>
        </div>
        <span class="link-arrow">↗</span>
      </a>
      <a class="link-item" href="#">
        <div class="link-favicon">📊</div>
        <div class="link-info">
          <p>Q4 Analytics Report — Google Sheets</p><span>docs.google.com · Shared by Sonia R. · Yesterday</span>
        </div>
        <span class="link-arrow">↗</span>
      </a>
      <a class="link-item" href="#">
        <div class="link-favicon">🎨</div>
        <div class="link-info">
          <p>Brand Kit 2025 — Figma File</p><span>figma.com · Shared by Priya K. · 3 days ago</span>
        </div>
        <span class="link-arrow">↗</span>
      </a>
      <a class="link-item" href="#">
        <div class="link-favicon">📹</div>
        <div class="link-info">
          <p>Product Walkthrough — Loom Video</p><span>loom.com · Shared by Vikram B. · 1 week ago</span>
        </div>
        <span class="link-arrow">↗</span>
      </a>
    </div>
  </div>

  <!-- Documents -->
  <div class="files-panel" id="tab-docs">
    <div class="files-list">
      <div class="doc-item">
        <div class="doc-icon" style="background:rgba(37,99,235,.1);">📝</div>
        <div class="doc-info">
          <p>Sprint 12 Planning Document.docx</p><span>Arjun M. · #engineering · Today · </span>
        </div>
        <div class="doc-size">248 KB</div>
      </div>
      <div class="doc-item">
        <div class="doc-icon" style="background:rgba(34,197,94,.1);">📊</div>
        <div class="doc-info">
          <p>Q4 Budget Forecast.xlsx</p><span>Admin · #finance · Yesterday</span>
        </div>
        <div class="doc-size">1.2 MB</div>
      </div>
      <div class="doc-item">
        <div class="doc-icon" style="background:rgba(239,68,68,.1);">📄</div>
        <div class="doc-info">
          <p>Client Proposal — ACME Corp.pdf</p><span>Priya K. · #sales · 2 days ago</span>
        </div>
        <div class="doc-size">3.8 MB</div>
      </div>
      <div class="doc-item">
        <div class="doc-icon" style="background:rgba(249,115,22,.1);">📋</div>
        <div class="doc-info">
          <p>Akshar Plus Brand Guidelines.pdf</p><span>Design Team · #general · 1 week ago</span>
        </div>
        <div class="doc-size">5.1 MB</div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════ TESTIMONIALS ══════════════════ -->
<section class="testimonials" id="testimonials">
  <div style="text-align:center;margin-bottom:72px;" class="reveal visible">
    <div class="section-label"><span class="dot"></span> Customer Love</div>
    <h2 class="section-title">Teams Who Swear By<br><span class="grad-text">Akshar Plus</span></h2>
    <p class="section-sub" style="margin:0 auto;">Join 50,000+ users across 2,000+ companies who've made Akshar Plus their primary communication platform.</p>
  </div>

  <div class="testi-track-wrap">
    <div class="testi-track" id="testiTrack" style="transform: translateX(-557px);">
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">The multi-company workspace is a game-changer. We manage 6 client accounts from one login and the isolation between workspaces is flawless.</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#e91e8c,#7c3aed)">SR</div>
          <div>
            <div class="testi-name">Sonia Rao</div>
            <div class="testi-role">Creative Director · Pixelcraft</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">We replaced 4 tools — Slack, Zoom, Loom, and Dropbox — with just Akshar Plus. The media library alone saved us hours of file hunting every week.</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#2563eb,#06b6d4)">AM</div>
          <div>
            <div class="testi-name">Arjun Mehta</div>
            <div class="testi-role">CTO · NovaByte Technologies</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">Pinned messages and scheduled broadcasts have transformed how we run company-wide communications. Our team actually reads announcements now!</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#f97316,#fbbf24)">PK</div>
          <div>
            <div class="testi-name">Priya Kapoor</div>
            <div class="testi-role">Head of Ops · LaunchPad HQ</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">Video call quality is outstanding and the noise cancellation is exceptional. Our remote team feels more connected than ever — even across 3 time zones.</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#7c3aed,#06b6d4)">VB</div>
          <div>
            <div class="testi-name">Vikram Bose</div>
            <div class="testi-role">Engineering Lead · CloudScale</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">Scheduled messages have made our global async communication effortless. I draft messages in the evening and they send at the right local time for each team.</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#e91e8c,#f97316)">NJ</div>
          <div>
            <div class="testi-name">Neha Joshi</div>
            <div class="testi-role">Product Manager · MarketPulse</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testi-quote">The audio file organisation is incredible. Every voice note and recording is right there in the media library — searchable, categorised, and ready to replay instantly.</p>
        <div class="testi-author">
          <div class="testi-av" style="background:linear-gradient(135deg,#06b6d4,#2563eb)">RS</div>
          <div>
            <div class="testi-name">Rohan Sharma</div>
            <div class="testi-role">Podcast Producer · WaveCast</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="testi-footer">
    <div class="testi-dots" id="testiDots"><button class="t-dot"></button><button class="t-dot active"></button><button class="t-dot"></button><button class="t-dot"></button></div>
    <div style="text-align:center;font-size:.85rem;color:rgba(255,255,255,.35);">50,000+ happy users across 120+ countries</div>
    <div class="testi-arrows">
      <button class="t-arrow" id="testiPrev">←</button>
      <button class="t-arrow" id="testiNext">→</button>
    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer id="footer">
  <div class="footer-grid">
    <div>
      <a class="nav-logo" href="#" style="margin-bottom:16px;display:inline-flex;">
        <div class="logo-icon">
          <img src="{{ asset('image/logo.png') }}">
        </div>

      </a>
      <p class="footer-desc">The all-in-one communication platform for teams — live chat, voice &amp; video calling, multi-company workspaces, and smart file management.</p>
      <div class="social-row">
        <a class="soc-btn" href="#" title="Twitter">𝕏</a>
        <a class="soc-btn" href="#" title="LinkedIn">in</a>
        <a class="soc-btn" href="#" title="Instagram">ig</a>
        <a class="soc-btn" href="#" title="YouTube">▶</a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Product</h4>
      <ul>
        <li><a href="#">Live Chat</a></li>
        <li><a href="#">Audio Calling</a></li>
        <li><a href="#">Video Calling</a></li>
        <li><a href="#">Multi-Company</a></li>
        <li><a href="#">Media Library</a></li>
        <li><a href="#">Pricing</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Press Kit</a></li>
        <li><a href="#">Status</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Stay in the loop</h4>
      <p style="color:var(--muted);font-size:.88rem;line-height:1.6;margin-bottom:0;">Get product updates and tips delivered to your inbox.</p>
      <div class="nl-form">
        <input type="email" placeholder="your@email.com">
        <button>Subscribe</button>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 Akshar Plus. All rights reserved.</p>
    <div class="footer-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="#">Cookie Policy</a>
    </div>
  </div>
</footer>

<!-- ══════════════════ JS ══════════════════ -->
<script src="{{ asset('js/script.js') }}"></script>

</script>


</body>

</html>