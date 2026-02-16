<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') — Akshar Plus Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --magenta: #e91e8c;
      --violet: #7c3aed;
      --blue: #2563eb;
      --teal: #06b6d4;
      --orange: #f97316;
      --amber: #fbbf24;
      --bg: #f8f7ff;
      --bg2: #fff;
      --bg3: #f1f0fa;
      --border: rgba(100, 80, 200, .1);
      --border2: rgba(100, 80, 200, .18);
      --text-h: #0f0a1e;
      --text: #2d2545;
      --muted: #7168a0;
      --muted2: #a89fc8;
      --sidebar-w: 260px;
      --grad: linear-gradient(135deg, var(--magenta) 0%, var(--violet) 35%, var(--blue) 65%, var(--teal) 100%);
      --shadow: 0 4px 20px rgba(80, 40, 180, .1);
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
    }

    ::-webkit-scrollbar {
      width: 4px;
    }

    ::-webkit-scrollbar-thumb {
      background: var(--grad);
      border-radius: 4px;
    }

    /* ── Sidebar ── */
    .sidebar {
      width: var(--sidebar-w);
      flex-shrink: 0;
      background: var(--text-h);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      z-index: 100;
      overflow-y: auto;
      transition: transform .3s;
    }

    .sidebar-logo {
      padding: 24px 20px;
      display: flex;
      align-items: center;
      gap: 11px;
      border-bottom: 1px solid rgba(255, 255, 255, .07);
    }

    .logo-icon-sm {
      width: 36px;
      height: 36px;
      flex-shrink: 0;
    }

    .logo-wordmark-sm {
      font-size: 1.1rem;
      font-weight: 700;
      color: #fff;
    }

    .logo-wordmark-sm span {
      background: var(--grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nav-section {
      padding: 20px 12px 8px;
    }

    .nav-section-label {
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .25);
      padding: 0 8px;
      margin-bottom: 8px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      color: rgba(255, 255, 255, .55);
      font-size: .88rem;
      font-weight: 500;
      text-decoration: none;
      transition: all .2s;
      margin-bottom: 2px;
    }

    .nav-item:hover {
      background: rgba(255, 255, 255, .07);
      color: #fff;
    }

    .nav-item.active {
      background: rgba(124, 58, 237, .25);
      color: #fff;
      font-weight: 600;
    }

    .nav-item .icon {
      font-size: 1rem;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
    }

    .nav-badge {
      margin-left: auto;
      background: var(--magenta);
      color: #fff;
      font-size: .65rem;
      font-weight: 700;
      padding: 2px 7px;
      border-radius: 20px;
    }

    .sidebar-footer {
      margin-top: auto;
      padding: 16px 12px;
      border-top: 1px solid rgba(255, 255, 255, .07);
    }

    .user-chip {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      transition: background .2s;
    }

    .user-chip:hover {
      background: rgba(255, 255, 255, .07);
    }

    .user-av {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: var(--grad);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: .85rem;
      color: #fff;
      flex-shrink: 0;
    }

    .user-info p {
      font-size: .82rem;
      font-weight: 600;
      color: #fff;
    }

    .user-info span {
      font-size: .72rem;
      color: rgba(255, 255, 255, .4);
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 9px 12px;
      border-radius: 10px;
      color: rgba(255, 255, 255, .4);
      font-size: .83rem;
      text-decoration: none;
      transition: all .2s;
      margin-top: 6px;
      background: none;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .logout-btn:hover {
      background: rgba(239, 68, 68, .15);
      color: #f87171;
    }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: rgba(248, 247, 255, .9);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .page-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text-h);
    }

    .breadcrumb {
      font-size: .8rem;
      color: var(--muted);
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .topbar-btn {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: var(--bg3);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: .95rem;
      transition: all .2s;
      position: relative;
    }

    .topbar-btn:hover {
      background: var(--bg2);
      border-color: var(--violet);
    }

    .notif-dot {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--magenta);
      border: 2px solid var(--bg);
    }

    /* ── Content ── */
    .content {
      padding: 28px;
      flex: 1;
    }

    /* ── Cards ── */
    .card {
      background: var(--bg2);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 1px 4px rgba(80, 40, 180, .06);
    }

    .card-title {
      font-size: .95rem;
      font-weight: 700;
      color: var(--text-h);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* ── Stat Cards ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-bottom: 24px;
    }

    .stat-card {
      background: var(--bg2);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 22px;
      position: relative;
      overflow: hidden;
      transition: all .25s;
    }

    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
    }

    .stat-card:nth-child(1)::before {
      background: linear-gradient(90deg, var(--magenta), var(--violet));
    }

    .stat-card:nth-child(2)::before {
      background: linear-gradient(90deg, var(--blue), var(--teal));
    }

    .stat-card:nth-child(3)::before {
      background: linear-gradient(90deg, var(--orange), var(--amber));
    }

    .stat-card:nth-child(4)::before {
      background: linear-gradient(90deg, var(--violet), var(--magenta));
    }

    .stat-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      margin-bottom: 14px;
    }

    .stat-num {
      font-size: 2rem;
      font-weight: 800;
      color: var(--text-h);
    }

    .stat-label {
      font-size: .8rem;
      color: var(--muted);
      margin-top: 3px;
    }

    .stat-change {
      font-size: .75rem;
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .stat-up {
      color: #16a34a;
    }

    .stat-down {
      color: #dc2626;
    }

    /* ── Tables ── */
    .table-wrap {
      overflow-x: auto;
      border-radius: 14px;
      border: 1px solid var(--border);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--bg2);
    }

    thead tr {
      background: var(--bg3);
    }

    th {
      padding: 12px 16px;
      font-size: .75rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--muted);
      text-align: left;
      border-bottom: 1px solid var(--border);
    }

    td {
      padding: 13px 16px;
      font-size: .87rem;
      border-bottom: 1px solid rgba(100, 80, 200, .05);
      vertical-align: middle;
    }

    tr:last-child td {
      border: none;
    }

    tr:hover td {
      background: rgba(100, 80, 200, .03);
    }

    /* ── Badges ── */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: .72rem;
      font-weight: 700;
    }

    .badge-green {
      background: rgba(34, 197, 94, .1);
      color: #16a34a;
    }

    .badge-red {
      background: rgba(239, 68, 68, .1);
      color: #dc2626;
    }

    .badge-yellow {
      background: rgba(251, 191, 36, .15);
      color: #b45309;
    }

    .badge-blue {
      background: rgba(37, 99, 235, .1);
      color: var(--blue);
    }

    .badge-purple {
      background: rgba(124, 58, 237, .1);
      color: var(--violet);
    }

    .badge-gray {
      background: rgba(100, 100, 120, .1);
      color: var(--muted);
    }

    /* ── Buttons ── */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 9px 18px;
      border-radius: 10px;
      font-size: .85rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: all .2s;
      text-decoration: none;
    }

    .btn-primary {
      background: var(--grad);
      color: #fff;
      box-shadow: 0 4px 14px rgba(124, 58, 237, .3);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, .4);
    }

    .btn-outline {
      background: transparent;
      border: 1.5px solid var(--border2);
      color: var(--text);
    }

    .btn-outline:hover {
      border-color: var(--violet);
      color: var(--violet);
    }

    .btn-danger {
      background: rgba(239, 68, 68, .1);
      color: #dc2626;
      border: 1px solid rgba(239, 68, 68, .2);
    }

    .btn-danger:hover {
      background: #dc2626;
      color: #fff;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: .78rem;
      border-radius: 8px;
    }

    /* ── Forms ── */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: .82rem;
      font-weight: 600;
      color: var(--text-h);
      margin-bottom: 7px;
    }

    .form-control {
      width: 100%;
      background: var(--bg3);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 14px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: .9rem;
      outline: none;
      transition: border-color .2s;
    }

    .form-control:focus {
      border-color: var(--violet);
      background: #fff;
    }

    .form-control::placeholder {
      color: var(--muted2);
    }

    select.form-control {
      cursor: pointer;
    }

    .form-error {
      font-size: .78rem;
      color: #dc2626;
      margin-top: 5px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    /* ── Alerts ── */
    .alert {
      padding: 12px 16px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: .88rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-success {
      background: rgba(34, 197, 94, .1);
      border: 1px solid rgba(34, 197, 94, .2);
      color: #15803d;
    }

    .alert-error {
      background: rgba(239, 68, 68, .1);
      border: 1px solid rgba(239, 68, 68, .2);
      color: #b91c1c;
    }

    /* ── Avatar ── */
    .av {
      width: 34px;
      height: 34px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .78rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    /* ── Pagination ── */
    .pagination {
      display: flex;
      gap: 6px;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
      padding: 7px 13px;
      border-radius: 8px;
      font-size: .82rem;
      border: 1px solid var(--border);
      background: var(--bg2);
      color: var(--muted);
      text-decoration: none;
      transition: all .2s;
    }

    .pagination .active span {
      background: var(--grad);
      color: #fff;
      border-color: transparent;
    }

    .pagination a:hover {
      border-color: var(--violet);
      color: var(--violet);
    }

    /* ── Search bar ── */
    .search-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      background: var(--bg3);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 8px 14px;
      transition: border-color .2s;
    }

    .search-bar:focus-within {
      border-color: var(--violet);
      background: #fff;
    }

    .search-bar input {
      background: none;
      border: none;
      outline: none;
      flex: 1;
      font-size: .9rem;
      color: var(--text);
    }

    .search-bar input::placeholder {
      color: var(--muted2);
    }

    /* ── Responsive ── */
    .hamburger-top {
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      flex-direction: column;
      gap: 4px;
      padding: 4px;
    }

    .hamburger-top span {
      display: block;
      width: 20px;
      height: 2px;
      background: var(--text-h);
      border-radius: 2px;
    }

    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .5);
      z-index: 99;
    }

    @media(max-width:900px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .main {
        margin-left: 0;
      }

      .hamburger-top {
        display: flex;
      }

      .sidebar-overlay.open {
        display: block;
      }

      .stats-grid {
        grid-template-columns: 1fr 1fr;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    @media(max-width:500px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }

      .content {
        padding: 16px;
      }
    }

    input {
      margin-bottom: 15px;
      margin-top: 15px;
    }
  </style>
  @stack('styles')
</head>

<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <svg class="logo-icon-sm" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="sg1" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#f53889" />
            <stop offset="100%" stop-color="#7c3aed" />
          </linearGradient>
          <linearGradient id="sg2" x1="1" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2563eb" />
            <stop offset="100%" stop-color="#06b6d4" />
          </linearGradient>
          <linearGradient id="sgc" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#e91e8c" />
            <stop offset="50%" stop-color="#fde047" />
            <stop offset="100%" stop-color="#06b6d4" />
          </linearGradient>
        </defs>
        <path d="M10 90 L50 10 L58 24 L24 90Z" fill="url(#sg1)" />
        <path d="M90 90 L50 10 L42 24 L76 90Z" fill="url(#sg2)" />
        <rect x="22" y="55" width="56" height="14" rx="7" fill="url(#sgc)" />
      </svg>
      <div class="logo-wordmark-sm">Akshar<span> Plus</span></div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Main</div>
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="icon">📊</span> Dashboard
      </a>
      <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <span class="icon">👥</span> Users
      </a>
      <!-- <a href="{{ route('admin.companies.index') }}" class="nav-item {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
        <span class="icon">🏢</span> Companies
      </a> -->
      <a href="{{ route('admin.hero.index') }}" class="nav-item {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
        <span class="icon">🖼</span> Banner Slide
      </a>
      <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
        <span class="icon">🛠</span> Manage services
      </a>
      <a href="{{ route('admin.pages.index') }}" class="nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
        <span class="icon">📄</span> Manage Page
      </a>
      <a href="{{ route('admin.blogs.index') }}" class="nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
        <span class="icon">✍️</span> Blog Posts
      </a>
      <a href="{{ route('admin.media.index') }}" class="nav-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
        <span class="icon">🎬</span> Media
      </a>
      <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
        <span class="icon">★</span> Testimonials
      </a>
      <a href="{{ route('admin.social-links.index') }}" class="nav-item {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
        <span class="icon">🚰</span> Manage Social Links
      </a>
      <a href="{{ route('admin.subscribers.index') }}" class="nav-item {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
        <span class="icon">✉️</span> Manage Subscribers
      </a>
    </div>


    <div class="nav-section">
      <div class="nav-section-label">System</div>
      <a href="{{ route('home') }}" class="nav-item" target="_blank">
        <span class="icon">🌐</span> View Site
      </a>
      <a href="#" class="nav-item">
        <span class="icon">⚙️</span> Settings
      </a>
    </div>

    <div class="sidebar-footer">
      <div class="user-chip">
        <div class="user-av">{{ auth()->user()->initials }}</div>
        <div class="user-info">
          <p>{{ auth()->user()->name }}</p>
          <span>Super Admin</span>
        </div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
          <span>🚪</span> Sign Out
        </button>
      </form>
    </div>
  </aside>

  <!-- ── MAIN ── -->
  <div class="main">
    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="hamburger-top" onclick="openSidebar()">
          <span></span><span></span><span></span>
        </button>
        <div>
          <div class="page-title">@yield('title', 'Dashboard')</div>
          <div class="breadcrumb">Admin / @yield('title', 'Dashboard')</div>
        </div>
      </div>
      <div class="topbar-right">
        <div class="topbar-btn" title="Notifications">
          🔔
          <span class="notif-dot"></span>
        </div>
        <div class="topbar-btn" title="Theme">🌙</div>
        <div class="av" style="background:var(--grad);font-size:.82rem;font-weight:700;color:#fff;border-radius:10px;width:38px;height:38px;">
          {{ auth()->user()->initials }}
        </div>
      </div>
    </header>

    <!-- Alerts -->
    <div style="padding:0 28px;padding-top:20px;">
      @if(session('success'))
      <div class="alert alert-success">✅ {{ session('success') }}</div>
      @endif
      @if(session('error'))
      <div class="alert alert-error">❌ {{ session('error') }}</div>
      @endif
      @if($errors->any())
      <div class="alert alert-error">
        ❌ @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
      </div>
      @endif
    </div>

    <!-- Content -->
    <div class="content">
      @yield('content')
    </div>
  </div>

  <script>
    function openSidebar() {
      document.getElementById('sidebar').classList.add('open');
      document.getElementById('overlay').classList.add('open');
    }

    function closeSidebar() {
      document.getElementById('sidebar').classList.remove('open');
      document.getElementById('overlay').classList.remove('open');
    }
  </script>
  @stack('scripts')
</body>

</html>