@extends('layouts.app')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --gold: #FFD200;
        --orange: #F7971E;
        --ink: #0e0e0e;
        --surface: #161616;
        --muted: #2a2a2a;
        --border: rgba(255,255,255,0.06);
        --text: #e8e8e8;
        --subtext: #888;
    }

    body {
        background-color: var(--ink);
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        min-height: 100vh;
    }

    /* ── BACKGROUND ── */
    .login-scene {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        overflow: hidden;
    }

    /* Left decorative panel */
    .login-left {
        position: relative;
        background: var(--ink);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 48px;
        overflow: hidden;
    }

    .left-noise {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        pointer-events: none;
    }

    .left-glow {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,210,0,0.12) 0%, transparent 70%);
        top: -100px;
        left: -100px;
        pointer-events: none;
    }
    .left-glow-2 {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(247,151,30,0.1) 0%, transparent 70%);
        bottom: 50px;
        right: -50px;
        pointer-events: none;
    }

    .brand-logo {
        position: relative;
        z-index: 2;
    }
    .brand-logo .logo-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .logo-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #FFD200, #F7971E);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    .logo-text {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        letter-spacing: 3px;
        color: white;
    }

    .left-hero {
        position: relative;
        z-index: 2;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px 0;
    }

    .hero-tag {
        display: inline-block;
        background: rgba(255,210,0,0.1);
        border: 1px solid rgba(255,210,0,0.25);
        color: var(--gold);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 28px;
        width: fit-content;
    }

    .hero-headline {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(52px, 6vw, 88px);
        line-height: 0.95;
        letter-spacing: -1px;
        color: white;
        margin-bottom: 24px;
    }
    .hero-headline span {
        -webkit-text-stroke: 2px rgba(255,210,0,0.6);
        color: transparent;
    }

    .hero-desc {
        font-size: 14px;
        font-weight: 300;
        color: var(--subtext);
        line-height: 1.7;
        max-width: 320px;
        margin-bottom: 40px;
    }

    .hero-stats {
        display: flex;
        gap: 32px;
    }
    .stat {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .stat-num {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 28px;
        color: var(--gold);
        letter-spacing: 1px;
    }
    .stat-label {
        font-size: 11px;
        color: var(--subtext);
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* floating product cards */
    .product-float {
        position: absolute;
        bottom: 160px;
        right: -20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        z-index: 2;
        animation: floatCards 4s ease-in-out infinite;
    }
    @keyframes floatCards {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .mini-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 180px;
        backdrop-filter: blur(20px);
    }
    .mini-card-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #FFD200, #F7971E);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }
    .mini-card-info .title { font-size: 12px; font-weight: 700; color: white; }
    .mini-card-info .sub { font-size: 10px; color: var(--subtext); margin-top: 1px; }

    .left-footer {
        position: relative;
        z-index: 2;
        font-size: 11px;
        color: var(--subtext);
        letter-spacing: 1px;
    }

    /* ── RIGHT: FORM PANEL ── */
    .login-right {
        background: var(--surface);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 40px;
        position: relative;
        border-left: 1px solid var(--border);
    }

    .right-noise {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        pointer-events: none;
    }

    .form-wrap {
        width: 100%;
        max-width: 380px;
        position: relative;
        z-index: 2;
        animation: slideUp 0.6s cubic-bezier(0.16,1,0.3,1) both;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-eyebrow {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-eyebrow::before {
        content: '';
        display: block;
        width: 20px;
        height: 2px;
        background: var(--gold);
    }

    .form-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 46px;
        letter-spacing: 1px;
        color: white;
        line-height: 1;
        margin-bottom: 8px;
    }

    .form-subtitle {
        font-size: 13px;
        color: var(--subtext);
        margin-bottom: 36px;
        font-weight: 300;
    }

    /* ── FIELD ── */
    .field {
        margin-bottom: 20px;
    }
    .field-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #555;
        margin-bottom: 8px;
        display: block;
    }
    .field-inner {
        position: relative;
    }
    .field-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #444;
        font-size: 13px;
        transition: color 0.3s;
        pointer-events: none;
    }
    .field-input {
        width: 100%;
        padding: 14px 16px 14px 44px;
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        transition: all 0.25s;
        outline: none;
        -webkit-appearance: none;
    }
    .field-input::placeholder { color: #3a3a3a; }
    .field-input:focus {
        border-color: rgba(255,210,0,0.5);
        background: rgba(255,210,0,0.04);
        box-shadow: 0 0 0 3px rgba(255,210,0,0.08), inset 0 0 0 1px rgba(255,210,0,0.3);
    }
    .field-input:focus + .field-icon,
    .field-inner:focus-within .field-icon {
        color: var(--gold);
    }

    /* toggle password */
    .toggle-pw {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #444;
        cursor: pointer;
        font-size: 13px;
        padding: 4px;
        transition: color 0.3s;
    }
    .toggle-pw:hover { color: var(--gold); }

    .field-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: -4px;
        margin-bottom: 28px;
    }
    .remember-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: var(--subtext);
        cursor: pointer;
        user-select: none;
    }
    .remember-cb {
        width: 16px;
        height: 16px;
        border: 1px solid var(--border);
        border-radius: 4px;
        background: transparent;
        accent-color: var(--gold);
        cursor: pointer;
    }
    .forgot-link {
        font-size: 12px;
        color: var(--subtext);
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-link:hover { color: var(--gold); }

    /* ── CTA BUTTON ── */
    .btn-login {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #FFD200 0%, #F7971E 100%);
        border: none;
        border-radius: 12px;
        color: #0e0e0e;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 18px;
        letter-spacing: 3px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 8px 32px rgba(255,210,0,0.2);
    }
    .btn-login::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 40px rgba(255,210,0,0.3);
    }
    .btn-login:hover::before { opacity: 1; }
    .btn-login:active { transform: translateY(0); }

    /* ── DIVIDER ── */
    .or-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 24px 0;
        color: #333;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    .or-divider::before, .or-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* ── SOCIAL ── */
    .social-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 28px;
    }
    .btn-social {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--subtext);
        font-size: 13px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s;
        text-decoration: none;
    }
    .btn-social:hover {
        background: rgba(255,255,255,0.06);
        border-color: rgba(255,255,255,0.12);
        color: white;
    }
    .btn-social i { font-size: 14px; }

    /* ── REGISTER LINK ── */
    .register-row {
        text-align: center;
        font-size: 13px;
        color: var(--subtext);
        margin-top: 8px;
    }
    .register-row a {
        color: var(--gold);
        font-weight: 700;
        text-decoration: none;
        transition: opacity 0.2s;
    }
    .register-row a:hover { opacity: 0.8; }

    /* ── ERROR ALERTS ── */
    .alert-box {
        background: rgba(255, 80, 80, 0.08);
        border: 1px solid rgba(255, 80, 80, 0.2);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        color: #ff7070;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .login-scene { grid-template-columns: 1fr; }
        .login-left { display: none; }
        .login-right {
            background: var(--ink);
            border-left: none;
            min-height: 100vh;
        }
    }
</style>

<div class="login-scene">

    {{-- ─── LEFT PANEL ─── --}}
    <div class="login-left">
        <div class="left-noise"></div>
        <div class="left-glow"></div>
        <div class="left-glow-2"></div>

        <div class="brand-logo">
            <div class="logo-badge">
                <div class="logo-icon">⚡</div>
                <span class="logo-text">STREETVIBE</span>
            </div>
        </div>

        <div class="left-hero">
            <div class="hero-tag">New Collection 2025</div>
            <h1 class="hero-headline">
                DRESS<br>
                THE<br>
                <span>STREET.</span>
            </h1>
            <p class="hero-desc">
                Premium streetwear curated for those who move with culture.
                Limited drops. Exclusive collabs. Your vibe, your identity.
            </p>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-num">12K+</span>
                    <span class="stat-label">Members</span>
                </div>
                <div class="stat">
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Products</span>
                </div>
                <div class="stat">
                    <span class="stat-num">48H</span>
                    <span class="stat-label">Fast Ship</span>
                </div>
            </div>

            {{-- Floating cards --}}
            <div class="product-float">
                <div class="mini-card">
                    <div class="mini-card-icon">🔥</div>
                    <div class="mini-card-info">
                        <div class="title">New Drop Alert</div>
                        <div class="sub">Collab Tee — Rp 299K</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">✓</div>
                    <div class="mini-card-info">
                        <div class="title">Order Shipped</div>
                        <div class="sub">Arriving tomorrow</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="left-footer">© 2025 STREETVIBE — All Rights Reserved</div>
    </div>

    {{-- ─── RIGHT PANEL ─── --}}
    <div class="login-right">
        <div class="right-noise"></div>
        <div class="form-wrap">

            <div class="form-eyebrow">Welcome back</div>
            <h2 class="form-title">Sign In</h2>
            <p class="form-subtitle">Enter your credentials to access your account.</p>

            {{-- Error messages --}}
            @if ($errors->any())
                <div class="alert-box">
                    <i class="fa fa-circle-exclamation" style="margin-top:2px;flex-shrink:0;"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-inner">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="field-input"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        >
                        <i class="fa fa-envelope field-icon"></i>
                    </div>
                </div>

                {{-- Password --}}
                <div class="field">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-inner">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="field-input"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <i class="fa fa-lock field-icon"></i>
                        <button type="button" class="toggle-pw" onclick="togglePw()" tabindex="-1">
                            <i class="fa fa-eye" id="pw-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Options row --}}
                <div class="field-options">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-cb">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Enter the Vibe</button>
            </form>

            <div class="or-divider">or continue with</div>

            

            <div class="register-row">
                New to StreetVibe? <a href="{{ route('register') }}">Create account →</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePw() {
        const pw = document.getElementById('password');
        const eye = document.getElementById('pw-eye');
        if (pw.type === 'password') {
            pw.type = 'text';
            eye.className = 'fa fa-eye-slash';
        } else {
            pw.type = 'password';
            eye.className = 'fa fa-eye';
        }
    }
</script>

@endsection
