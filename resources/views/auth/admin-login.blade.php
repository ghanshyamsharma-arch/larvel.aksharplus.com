<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Akshar Plus</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
      --border: rgba(100, 80, 200, .12);
      --text-h: #0f0a1e;
      --text: #2d2545;
      --muted: #7168a0;
      --grad: linear-gradient(135deg, var(--magenta) 0%, var(--violet) 35%, var(--blue) 65%, var(--teal) 100%);
    }

    html,
    body {
      height: 100%;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      position: relative;
      overflow: hidden;
    }

    /* Animated background */
    .bg-blobs {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 0;
    }

    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(90px);
      opacity: .18;
      animation: blobAnim 14s ease-in-out infinite alternate;
    }

    .b1 {
      width: 600px;
      height: 600px;
      top: -150px;
      right: -150px;
      background: radial-gradient(circle, var(--magenta), var(--violet));
    }

    .b2 {
      width: 500px;
      height: 500px;
      bottom: -200px;
      left: -100px;
      background: radial-gradient(circle, var(--teal), var(--blue));
      animation-delay: -6s;
    }

    .b3 {
      width: 300px;
      height: 300px;
      top: 50%;
      left: 40%;
      background: radial-gradient(circle, var(--amber), var(--orange));
      animation-delay: -10s;
      opacity: .1;
    }

    .dot-grid {
      position: fixed;
      inset: 0;
      background-image: radial-gradient(circle, rgba(100, 80, 200, .1) 1px, transparent 1px);
      background-size: 26px 26px;
      pointer-events: none;
      z-index: 0;
    }

    /* Card */
    .login-card {
      position: relative;
      z-index: 1;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 28px;
      box-shadow: 0 24px 80px rgba(80, 40, 180, .14);
      padding: 48px 44px;
      width: 100%;
      max-width: 440px;
      animation: cardIn .5s ease both;
    }

    @keyframes cardIn {
      from {
        opacity: 0;
        transform: translateY(24px);
      }

      to {
        opacity: 1;
        transform: none;
      }
    }

    .card-top {
      text-align: center;
      margin-bottom: 36px;
    }

    .logo-wrap {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .logo-svg {
      width: 44px;
      height: 44px;
    }

    .logo-text {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--text-h);
    }

    .logo-text span {
      background: var(--grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .card-title {
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--text-h);
      margin-bottom: 6px;
    }

    .card-sub {
      font-size: .9rem;
      color: var(--muted);
    }

    /* Top gradient bar */
    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--grad);
      border-radius: 28px 28px 0 0;
    }

    /* Alerts */
    .alert-err {
      background: rgba(239, 68, 68, .08);
      border: 1px solid rgba(239, 68, 68, .2);
      color: #b91c1c;
      border-radius: 10px;
      padding: 11px 14px;
      font-size: .85rem;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .alert-ok {
      background: rgba(34, 197, 94, .08);
      border: 1px solid rgba(34, 197, 94, .2);
      color: #15803d;
      border-radius: 10px;
      padding: 11px 14px;
      font-size: .85rem;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* Form */
    .form-group {
      margin-bottom: 18px;
    }

    .form-label {
      display: block;
      font-size: .82rem;
      font-weight: 600;
      color: var(--text-h);
      margin-bottom: 7px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 1rem;
      pointer-events: none;
    }

    .form-input {
      width: 100%;
      background: #f8f7ff;
      border: 1.5px solid var(--border);
      border-radius: 12px;
      padding: 12px 14px 12px 42px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: .92rem;
      outline: none;
      transition: all .2s;
    }

    .form-input:focus {
      border-color: var(--violet);
      background: #fff;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, .08);
    }

    .form-input::placeholder {
      color: var(--muted);
    }

    .field-error {
      font-size: .76rem;
      color: #dc2626;
      margin-top: 5px;
    }

    .form-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    .remember-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .83rem;
      color: var(--muted);
    }

    .remember-wrap input[type=checkbox] {
      accent-color: var(--violet);
      width: 15px;
      height: 15px;
    }

    .forgot-link {
      font-size: .82rem;
      color: var(--violet);
      text-decoration: none;
      font-weight: 600;
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      background: var(--grad);
      border: none;
      border-radius: 12px;
      color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-weight: 700;
      font-size: .95rem;
      padding: 14px;
      cursor: pointer;
      transition: transform .2s, box-shadow .2s;
      box-shadow: 0 6px 24px rgba(124, 58, 237, .35);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 32px rgba(124, 58, 237, .45);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    .card-footer {
      text-align: center;
      margin-top: 28px;
      font-size: .82rem;
      color: var(--muted);
    }

    .demo-hint {
      background: rgba(124, 58, 237, .06);
      border: 1px solid rgba(124, 58, 237, .15);
      border-radius: 10px;
      padding: 12px 14px;
      font-size: .8rem;
      color: var(--muted);
      margin-top: 20px;
      text-align: center;
    }

    .demo-hint strong {
      color: var(--violet);
    }

    /* Eye toggle */
    .eye-toggle {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--muted);
      font-size: 1rem;
    }

    @keyframes blobAnim {
      from {
        transform: translate(0, 0) scale(1);
      }

      to {
        transform: translate(30px, -20px) scale(1.1);
      }
    }
  </style>
</head>

<body>

  <div class="bg-blobs">
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
  </div>
  <div class="dot-grid"></div>

  <div class="login-card">
    <div class="card-top">
      <div class="logo-wrap">
        <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="ll1" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0%" stop-color="#f53889" />
              <stop offset="100%" stop-color="#7c3aed" />
            </linearGradient>
            <linearGradient id="ll2" x1="1" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#2563eb" />
              <stop offset="100%" stop-color="#06b6d4" />
            </linearGradient>
            <linearGradient id="llc" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#e91e8c" />
              <stop offset="50%" stop-color="#fde047" />
              <stop offset="100%" stop-color="#06b6d4" />
            </linearGradient>
          </defs>
          <path d="M10 90 L50 10 L58 24 L24 90Z" fill="url(#ll1)" />
          <path d="M90 90 L50 10 L42 24 L76 90Z" fill="url(#ll2)" />
          <rect x="22" y="55" width="56" height="14" rx="7" fill="url(#llc)" />
        </svg>
        <div class="logo-text">Akshar<span> Plus</span></div>
      </div>
      <h1 class="card-title">Admin Portal</h1>
      <p class="card-sub">Sign in to manage your platform</p>
    </div>

    @if(session('success'))
    <div class="alert-ok">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-err">❌ {{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <div class="input-wrap">
          <span class="input-icon">📧</span>
          <input
            id="email" type="email" name="email"
            class="form-input"
            placeholder="admin@aksharplus.com"
            value="{{ old('email') }}"
            required autocomplete="email" autofocus>
        </div>
        @error('email')
        <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <div class="input-wrap">
          <span class="input-icon">🔒</span>
          <input
            id="password" type="password" name="password"
            class="form-input" placeholder="••••••••"
            required autocomplete="current-password">
          <button type="button" class="eye-toggle" onclick="togglePwd()">👁️</button>
        </div>
        @error('password')
        <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-row">
        <label class="remember-wrap">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          Remember me
        </label>
        <a href="#" class="forgot-link">Forgot password?</a>
      </div>

      <button type="submit" class="submit-btn">
        🔐 Sign In to Admin
      </button>
    </form>

    <!-- <div class="demo-hint">
    <strong>Demo Credentials</strong><br>
    📧 admin@aksharplus.com &nbsp;·&nbsp; 🔑 password
  </div> -->

    <div class="card-footer">
      <a href="{{ route('home') }}" style="color:var(--violet);text-decoration:none;font-weight:600;">
        ← Back to Akshar Plus
      </a>
    </div>
  </div>

  <script>
    function togglePwd() {
      const p = document.getElementById('password');
      p.type = p.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>

</html>