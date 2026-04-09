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

    /* ── SCENE ── */
    .reg-scene {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        overflow: hidden;
    }

    /* ── RIGHT: FORM ── */
    .reg-form-panel {
        background: var(--surface);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 40px;
        position: relative;
        border-right: 1px solid var(--border);
        order: 1;
    }

    .panel-noise {
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
        to   { opacity: 1; transform: translateY(0); }
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
        margin-bottom: 6px;
    }

    .form-subtitle {
        font-size: 13px;
        color: var(--subtext);
        margin-bottom: 32px;
        font-weight: 300;
    }

    /* ── FIELDS ── */
    .field { margin-bottom: 16px; }

    .field-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #555;
        margin-bottom: 7px;
        display: block;
    }

    .field-inner { position: relative; }

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
        padding: 13px 16px 13px 44px;
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
    .field-inner:focus-within .field-icon { color: var(--gold); }

    /* row of 2 fields */
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    /* password toggle */
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

    /* password strength */
    .pw-strength {
        display: flex;
        gap: 4px;
        margin-top: 8px;
    }
    .pw-bar {
        height: 3px;
        flex: 1;
        border-radius: 99px;
        background: var(--muted);
        transition: background 0.3s;
    }

    /* ── TERMS ── */
    .terms-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 20px 0 24px;
    }
    .terms-cb {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        accent-color: var(--gold);
        cursor: pointer;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .terms-text {
        font-size: 12px;
        color: var(--subtext);
        line-height: 1.6;
    }
    .terms-text a { color: var(--gold); font-weight: 600; text-decoration: none; }
    .terms-text a:hover { opacity: 0.8; }

    /* ── CTA ── */
    .btn-register {
        width: 100%;
        padding: 15px;
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
    .btn-register::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .btn-register:hover { transform: translateY(-2px); box-shadow: 0 16px 40px rgba(255,210,0,0.3); }
    .btn-register:hover::before { opacity: 1; }
    .btn-register:active { transform: translateY(0); }

    /* login link */
    .login-row {
        text-align: center;
        font-size: 13px;
        color: var(--subtext);
        margin-top: 20px;
    }
    .login-row a {
        color: var(--gold);
        font-weight: 700;
        text-decoration: none;
    }
    .login-row a:hover { opacity: 0.8; }

    /* error */
    .alert-box {
        background: rgba(255,80,80,0.08);
        border: 1px solid rgba(255,80,80,0.2);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        color: #ff7070;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    /* ── LEFT: DECO PANEL ── */
    .reg-deco-panel {
        position: relative;
        background: var(--ink);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 48px;
        overflow: hidden;
        order: 2;
    }

    .deco-noise {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        pointer-events: none;
    }
    .deco-glow {
        position: absolute;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,210,0,0.1) 0%, transparent 70%);
        bottom: -100px; right: -100px;
        pointer-events: none;
    }
    .deco-glow-2 {
        position: absolute;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(247,151,30,0.08) 0%, transparent 70%);
        top: 60px; left: -50px;
        pointer-events: none;
    }

    .brand-logo {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: flex-end;
    }
    .logo-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .logo-icon {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #FFD200, #F7971E);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
    }
    .logo-text {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        letter-spacing: 3px;
        color: white;
    }

    .deco-hero {
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
        font-size: clamp(52px, 5.5vw, 84px);
        line-height: 0.95;
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
        max-width: 300px;
        margin-bottom: 40px;
    }

    /* perks list */
    .perks {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .perk {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .perk-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: rgba(255,210,0,0.1);
        border: 1px solid rgba(255,210,0,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .perk-text .title { font-size: 13px; font-weight: 700; color: white; }
    .perk-text .sub   { font-size: 11px; color: var(--subtext); margin-top: 1px; }

    .deco-footer {
        position: relative;
        z-index: 2;
        font-size: 11px;
        color: var(--subtext);
        letter-spacing: 1px;
        text-align: right;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .reg-scene { grid-template-columns: 1fr; }
        .reg-deco-panel { display: none; }
        .reg-form-panel { border-right: none; background: var(--ink); min-height: 100vh; }
    }
</style>

<div class="reg-scene">

    {{-- ─── FORM PANEL (kiri) ─── --}}
    <div class="reg-form-panel">
        <div class="panel-noise"></div>
        <div class="form-wrap">

            <div class="form-eyebrow">Join the community</div>
            <h2 class="form-title">Sign Up</h2>
            <p class="form-subtitle">One account. Unlimited drops.</p>

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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Full Name --}}
                <div class="field">
                    <label class="field-label" for="name">Full Name</label>
                    <div class="field-inner">
                        <input id="name" type="text" name="name" class="field-input"
                            placeholder="John Doe" value="{{ old('name') }}"
                            required autofocus autocomplete="name">
                        <i class="fa fa-user field-icon"></i>
                    </div>
                </div>

                {{-- Email --}}
                <div class="field">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-inner">
                        <input id="email" type="email" name="email" class="field-input"
                            placeholder="john@example.com" value="{{ old('email') }}"
                            required autocomplete="email">
                        <i class="fa fa-envelope field-icon"></i>
                    </div>
                </div>

                {{-- Password + Confirm (side by side) --}}
                <div class="field-row">
                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <div class="field-inner">
                            <input id="password" type="password" name="password" class="field-input"
                                placeholder="••••••••" required autocomplete="new-password"
                                oninput="checkStrength(this.value)">
                            <i class="fa fa-lock field-icon"></i>
                            <button type="button" class="toggle-pw" onclick="togglePw('password','eye1')" tabindex="-1">
                                <i class="fa fa-eye" id="eye1"></i>
                            </button>
                        </div>
                        <div class="pw-strength">
                            <div class="pw-bar" id="bar1"></div>
                            <div class="pw-bar" id="bar2"></div>
                            <div class="pw-bar" id="bar3"></div>
                            <div class="pw-bar" id="bar4"></div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="password_confirmation">Confirm</label>
                        <div class="field-inner">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="field-input" placeholder="••••••••" required autocomplete="new-password">
                            <i class="fa fa-shield-halved field-icon"></i>
                            <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','eye2')" tabindex="-1">
                                <i class="fa fa-eye" id="eye2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="terms-row">
                    <input type="checkbox" class="terms-cb" required>
                    <span class="terms-text">
                        I agree to the <a href="#">Terms of Service</a> and
                        <a href="#">Privacy Policy</a> of StreetVibe.
                    </span>
                </div>

                <button type="submit" class="btn-register">Create My Account</button>

                <div class="login-row">
                    Already have an account? <a href="{{ route('login') }}">Sign in →</a>
                </div>
            </form>
        </div>
    </div>

    {{-- ─── DECO PANEL (kanan) ─── --}}
    <div class="reg-deco-panel">
        <div class="deco-noise"></div>
        <div class="deco-glow"></div>
        <div class="deco-glow-2"></div>

        <div class="brand-logo">
            <div class="logo-badge">
                <div class="logo-icon">⚡</div>
                <span class="logo-text">STREETVIBE</span>
            </div>
        </div>

        <div class="deco-hero">
            <div class="hero-tag">Members Only Perks</div>
            <h2 class="hero-headline">
                JOIN<br>THE<br><span>VIBE.</span>
            </h2>
            <p class="hero-desc">
                Daftar sekarang dan dapatkan akses ke exclusive drops,
                early access koleksi baru, dan reward points setiap pembelian.
            </p>

            <div class="perks">
                <div class="perk">
                    <div class="perk-icon">🔥</div>
                    <div class="perk-text">
                        <div class="title">Early Drop Access</div>
                        <div class="sub">Dapatkan koleksi baru sebelum publik</div>
                    </div>
                </div>
                <div class="perk">
                    <div class="perk-icon">⭐</div>
                    <div class="perk-text">
                        <div class="title">Reward Points</div>
                        <div class="sub">Kumpulkan poin di setiap transaksi</div>
                    </div>
                </div>
                <div class="perk">
                    <div class="perk-icon">🚚</div>
                    <div class="perk-text">
                        <div class="title">Free Ongkir Member</div>
                        <div class="sub">Gratis ongkir untuk member aktif</div>
                    </div>
                </div>
                <div class="perk">
                    <div class="perk-icon">🎁</div>
                    <div class="perk-text">
                        <div class="title">Birthday Surprise</div>
                        <div class="sub">Voucher spesial di hari ulang tahunmu</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="deco-footer">© 2025 STREETVIBE — All Rights Reserved</div>
    </div>
</div>

<script>
    function togglePw(inputId, eyeId) {
        const pw  = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        if (pw.type === 'password') {
            pw.type = 'text';
            eye.className = 'fa fa-eye-slash';
        } else {
            pw.type = 'password';
            eye.className = 'fa fa-eye';
        }
    }

    function checkStrength(val) {
        const bars   = [1,2,3,4].map(i => document.getElementById('bar' + i));
        const colors = ['#ff4d4d','#ff9f40','#ffd200','#4cde9a'];
        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))    score++;

        bars.forEach((b, i) => {
            b.style.background = i < score ? colors[score - 1] : 'var(--muted)';
        });
    }
</script>

@endsection
