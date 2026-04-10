<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('user/img/fav.png') }}">
    <meta charset="UTF-8">
    <title>StreetVibe — Define Your Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Syne:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═════════════════════════════════ RESET & VARS ═════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:      #0a0a0a;
            --dark-grey:  #1a1a1a;
            --white:      #f5f2ee;
            --cream:      #faf8f5;
            --orange:     #ff6b35;
            --yellow:     #ffd400;
            --accent:     #ff9500;
            --grey:       #8a8680;
            --light:      #f0ede8;
            --card-bg:    #1a1a1a;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.12);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.18);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.25);
            --shadow-xl: 0 40px 100px rgba(0,0,0,0.35);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            cursor: none;
        }

        /* ═════════════════════════════════ CURSOR EFFECT ═════════════════════════════════ */
        .cursor-dot {
            width: 10px; height: 10px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99999;
            transform: translate(-50%, -50%);
            transition: transform 0.08s;
            box-shadow: 0 0 20px rgba(255,107,53,0.6);
        }

        .cursor-ring {
            width: 40px; height: 40px;
            border: 2px solid var(--orange);
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99998;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease, width 0.25s, height 0.25s, border-color 0.3s;
            opacity: 0.8;
            box-shadow: 0 0 15px rgba(255,107,53,0.3);
        }

        body:hover .cursor-ring { opacity: 1; box-shadow: 0 0 25px rgba(255,107,53,0.5); }
        a, button { cursor: none; }

        /* ═════════════════════════════════ NOISE OVERLAY ═════════════════════════════════ */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9990; opacity: 0.3;
        }

        /* ═════════════════════════════════ NAVBAR ═════════════════════════════════ */
        .sv-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 24px 40px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(245,242,238,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(255,107,53,0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }

        .sv-nav.scrolled {
            padding: 14px 40px;
            background: rgba(245,242,238,0.96);
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }

        .sv-logo {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            letter-spacing: 3px;
            font-weight: 800;
            color: var(--black);
            text-decoration: none;
        }

        .sv-logo span {
            color: var(--orange);
        }

        .sv-nav-links { display: flex; gap: 40px; list-style: none; }

        .sv-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: none;
            background: none;
            border: none;
            padding: 8px;
        }

        .sv-hamburger span {
            width: 24px;
            height: 2px;
            background: var(--black);
            transition: all 0.3s;
            display: block;
        }

        .sv-hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .sv-hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .sv-hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        .sv-mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(245,242,238,0.98);
            backdrop-filter: blur(20px);
            padding: 20px;
            z-index: 999;
            flex-direction: column;
            gap: 16px;
            border-bottom: 2px solid rgba(255,107,53,0.15);
        }

        .sv-mobile-menu.active {
            display: flex;
        }

        .sv-mobile-menu a {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--black);
            text-decoration: none;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: color 0.3s;
        }

        .sv-mobile-menu a:hover {
            color: var(--orange);
        }

        @media (max-width: 768px) {
            .sv-nav-links { display: none; }
            .sv-hamburger { display: flex; }
        }

        .sv-nav-links a {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--black);
            text-decoration: none;
            position: relative;
            padding-bottom: 6px;
            transition: color 0.3s;
        }

        .sv-nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2.5px;
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            transition: width 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-radius: 2px;
        }

        .sv-nav-links a:hover {
            color: var(--orange);
        }

        .sv-nav-links a:hover::after { width: 100%; }

        .sv-cart-btn {
            position: relative;
            color: var(--black);
            font-size: 22px;
            text-decoration: none;
            transition: all 0.3s;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        .sv-cart-btn:hover {
            color: var(--orange);
            transform: scale(1.1) rotate(5deg);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
        }

        /* ═════════════════════════════════ HERO ═════════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding-top: 80px;
            overflow: hidden;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,107,53,0.15) 0%, transparent 70%);
            pointer-events: none;
            animation: float-blob 8s ease-in-out infinite;
        }

        @keyframes float-blob {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, -30px); }
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px 60px 80px 80px;
            position: relative;
            z-index: 2;
        }

        .hero-eyebrow {
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--orange);
            font-weight: 700;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInLeft 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes slideInLeft { to { opacity: 1; transform: translateX(0); } }
        .hero-eyebrow { animation-delay: 0.1s; }

        .hero-eyebrow::before {
            content: '';
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            border-radius: 2px;
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(80px, 10vw, 160px);
            line-height: 0.85;
            letter-spacing: -2px;
            color: var(--black);
            margin-bottom: 32px;
            font-weight: 800;
            animation: slideInLeft 0.8s ease forwards;
            opacity: 0;
            animation-delay: 0.2s;
        }

        .hero-title em {
            font-family: 'Instrument Serif', serif;
            color: var(--orange);
            font-size: 0.55em;
            display: block;
            font-style: italic;
            font-weight: 400;
        }

        .hero-desc {
            font-size: 16px;
            color: var(--grey);
            line-height: 1.8;
            max-width: 400px;
            margin-bottom: 44px;
            animation: slideInLeft 0.8s ease forwards;
            opacity: 0;
            animation-delay: 0.3s;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--black), var(--dark-grey));
            color: var(--white) !important;
            padding: 18px 42px;
            border-radius: 0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: var(--shadow-md);
            animation: slideInLeft 0.8s ease forwards;
            opacity: 0;
            animation-delay: 0.4s;
        }

        .hero-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            transform: translateX(-101%);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-cta:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .hero-cta:hover::before { transform: translateX(0); }
        .hero-cta span { position: relative; z-index: 1; }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 28px;
            font-size: 12px;
            color: var(--grey);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .hero-tag::before {
            content: '✦';
            color: var(--orange);
            font-size: 14px;
        }

        .hero-right {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark-grey) 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .hero-right::before {
            content: 'VIBE';
            font-family: 'Syne', sans-serif;
            font-size: 280px;
            font-weight: 800;
            color: rgba(255,107,53,0.08);
            position: absolute;
            bottom: -60px;
            right: -40px;
            line-height: 1;
            pointer-events: none;
            user-select: none;
            letter-spacing: -5px;
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            opacity: 0.88;
            transition: transform 10s cubic-bezier(0.33, 0.66, 0.33, 1);
        }

        .hero-right:hover .hero-img { transform: scale(1.05); }

        .hero-badge {
            position: absolute;
            top: 50px;
            right: 50px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            animation: spin-badge 15s linear infinite;
            box-shadow: 0 20px 60px rgba(255,107,53,0.4);
        }

        .hero-badge-inner {
            font-family: 'Syne', sans-serif;
            font-size: 32px;
            line-height: 1;
            font-weight: 800;
        }

        .hero-badge-sub {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.9;
            font-weight: 700;
        }

        @keyframes spin-badge { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .scroll-hint {
            position: absolute;
            bottom: 40px;
            left: 80px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--grey);
            font-weight: 600;
            animation: fadeIn 1s ease 0.8s forwards;
            opacity: 0;
        }

        @keyframes fadeIn { to { opacity: 1; } }

        .scroll-line {
            width: 45px;
            height: 2px;
            background: var(--grey);
            position: relative;
            overflow: hidden;
            border-radius: 2px;
        }

        .scroll-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            animation: scroll-anim 2s ease infinite;
        }

        @keyframes scroll-anim { to { left: 100%; } }

        /* ═════════════════════════════════ TICKER ═════════════════════════════════ */
        .ticker {
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            padding: 18px 0;
            overflow: hidden;
            border-top: 2px solid rgba(0,0,0,0.1);
            border-bottom: 2px solid rgba(0,0,0,0.1);
            position: relative;
        }

        .ticker::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(0,0,0,0.03) 0%, transparent 70%);
            pointer-events: none;
        }

        .ticker-track {
            display: flex;
            gap: 0;
            animation: ticker-run 24s linear infinite;
            width: max-content;
        }

        .ticker-item {
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 3px;
            padding: 0 50px;
            white-space: nowrap;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        }

        .ticker-sep {
            color: rgba(255,255,255,0.4);
            font-weight: 400;
        }

        @keyframes ticker-run { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ═════════════════════════════════ EDITORIAL ═════════════════════════════════ */
        .editorial {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--black) 0%, var(--dark-grey) 100%);
            position: relative;
            overflow: hidden;
        }

        .editorial::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
            pointer-events: none;
        }

        .editorial-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .editorial-img-wrap {
            position: relative;
            border-radius: 2px;
            overflow: hidden;
            aspect-ratio: 4/5;
            box-shadow: var(--shadow-xl);
        }

        .editorial-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.33, 0.66, 0.33, 1);
        }

        .editorial-img-wrap:hover img { transform: scale(1.06); }

        .editorial-img-accent {
            position: absolute;
            top: -20px;
            left: -20px;
            width: 100px;
            height: 100px;
            border: 3px solid var(--orange);
            border-radius: 2px;
            pointer-events: none;
            box-shadow: 0 0 30px rgba(255,107,53,0.3);
        }

        .editorial-label {
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .editorial-title {
            font-family: 'Instrument Serif', serif;
            font-size: clamp(36px, 4vw, 56px);
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 24px;
            font-style: italic;
            font-weight: 400;
        }

        .editorial-body {
            font-size: 16px;
            color: #999;
            line-height: 1.8;
            margin-bottom: 36px;
        }

        .editorial-stats {
            display: flex;
            gap: 60px;
            margin-top: 48px;
            border-top: 2px solid rgba(255,255,255,0.1);
            padding-top: 36px;
        }

        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 48px;
            color: var(--white);
            line-height: 1;
            font-weight: 800;
        }

        .stat-num span {
            color: var(--orange);
        }

        .stat-label {
            font-size: 11px;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 8px;
            font-weight: 600;
        }

        .editorial-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid var(--orange);
            color: var(--orange) !important;
            padding: 16px 36px;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-weight: 700;
        }

        .editorial-btn:hover {
            background: var(--orange);
            color: #000 !important;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255,107,53,0.3);
        }

        /* ═════════════════════════════════ CATEGORIES ═════════════════════════════════ */
        .categories {
            padding: 120px 0;
            background: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-eyebrow {
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 16px;
            display: block;
            font-weight: 700;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(42px, 6vw, 72px);
            letter-spacing: -1px;
            line-height: 0.95;
            font-weight: 800;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .cat-card {
            position: relative;
            aspect-ratio: 3/4;
            overflow: hidden;
            display: block;
            text-decoration: none !important;
            background: var(--black);
            transition: all 0.4s ease;
        }

        .cat-card:hover {
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            transform: translateY(-10px);
        }

        .cat-card-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.7s cubic-bezier(0.33, 0.66, 0.33, 1), filter 0.5s;
            filter: brightness(0.5) saturate(0.6);
        }

        .cat-card:hover .cat-card-bg {
            transform: scale(1.1);
            filter: brightness(0.3) saturate(0);
        }

        .cat-card-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 32px;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 60%);
        }

        .cat-icon {
            font-size: 36px;
            color: var(--orange);
            margin-bottom: 12px;
            transform: translateY(15px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s;
        }

        .cat-card:hover .cat-icon {
            transform: translateY(0);
            opacity: 1;
        }

        .cat-name {
            font-family: 'Syne', sans-serif;
            font-size: 28px;
            color: #fff;
            letter-spacing: 2px;
            font-weight: 800;
            transform: translateY(8px);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .cat-card:hover .cat-name { transform: translateY(0); }

        .cat-arrow {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--yellow);
            margin-top: 12px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.4s, transform 0.4s;
            font-weight: 700;
        }

        .cat-card:hover .cat-arrow {
            opacity: 1;
            transform: translateY(0);
        }

        .cat-number {
            position: absolute;
            top: 24px;
            right: 24px;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            color: rgba(255,255,255,0.3);
            letter-spacing: 2px;
            font-weight: 800;
        }

        /* ═════════════════════════════════ PRODUCTS ═════════════════════════════════ */
        .products-section {
            padding: 120px 0;
            background: var(--light);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .product-card {
            background: var(--white);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: var(--shadow-sm);
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
        }

        .product-img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 3/4;
            background: #e8e4de;
        }

        .product-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.33, 0.66, 0.33, 1);
        }

        .product-card:hover .product-img-wrap img { transform: scale(1.08); }

        .product-tag {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            color: #000;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            font-weight: 800;
            box-shadow: var(--shadow-md);
        }

        .product-actions {
            position: absolute;
            bottom: -70px;
            left: 0;
            right: 0;
            padding: 16px;
            background: rgba(10,10,10,0.95);
            transition: bottom 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            gap: 10px;
            backdrop-filter: blur(10px);
        }

        .product-card:hover .product-actions { bottom: 0; }

        .product-info {
            padding: 20px;
        }

        .product-brand {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 6px;
            font-weight: 700;
        }

        .product-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 12px;
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-family: 'Syne', sans-serif;
        }

        .product-price {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            color: var(--orange);
            font-weight: 800;
        }

        .btn-cart {
            flex: 1;
            background: var(--orange);
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 800;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: none;
        }

        .btn-cart:hover {
            background: var(--yellow);
            color: #000;
            transform: scale(1.05);
        }

        .btn-wishlist {
            background: rgba(255,107,53,0.1);
            color: var(--orange);
            border: 1px solid rgba(255,107,53,0.3);
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: none;
            font-weight: 700;
        }

        .btn-wishlist:hover {
            background: var(--orange);
            color: #fff;
            transform: scale(1.05);
        }

        /* ═════════════════════════════════ LOOKBOOK ═════════════════════════════════ */
        .lookbook {
            padding: 120px 0;
            background: var(--black);
        }

        .lookbook .section-title {
            color: var(--white);
        }

        .lookbook-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 3px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .look-item {
            position: relative;
            overflow: hidden;
            background: #111;
            min-height: 300px;
        }

        .look-item:first-child {
            grid-row: span 2;
        }

        .look-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.33, 0.66, 0.33, 1), filter 0.4s;
            filter: grayscale(20%) brightness(0.85);
            min-height: 300px;
        }

        .look-item:hover img {
            transform: scale(1.08);
            filter: grayscale(0%) brightness(1);
        }

        .look-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 28px 24px 24px;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        }

        .look-num {
            font-family: 'Syne', sans-serif;
            font-size: 12px;
            letter-spacing: 3px;
            color: var(--orange);
            font-weight: 800;
        }

        .look-title {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            margin-top: 6px;
            font-family: 'Syne', sans-serif;
        }

        /* ═════════════════════════════════ GALLERY ═════════════════════════════════ */
        .gallery-section {
            padding: 120px 0;
            background: var(--white);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .gallery-item {
            aspect-ratio: 1/1;
            position: relative;
            overflow: hidden;
            background: var(--light);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.33, 0.66, 0.33, 1), filter 0.4s;
            filter: brightness(0.95);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
            filter: brightness(0.7);
        }

        .gallery-hover {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,107,53,0.9), rgba(255,212,0,0.8));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s;
            color: #fff;
        }

        .gallery-item:hover .gallery-hover { opacity: 1; }

        .gallery-hover i {
            font-size: 32px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .gallery-hover p {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 800;
        }

        /* ═════════════════════════════════ ALERT ═════════════════════════════════ */
        .sv-alert {
            position: fixed;
            top: 90px;
            right: 24px;
            background: var(--black);
            color: var(--white);
            padding: 18px 28px;
            border-radius: 2px;
            border-left: 4px solid var(--orange);
            font-size: 14px;
            z-index: 9000;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-lg);
            animation: slide-in 0.4s ease forwards;
            font-weight: 600;
        }

        @keyframes slide-in { from { transform: translateX(120%); opacity:0; } to { transform: translateX(0); opacity:1; } }

        /* ═════════════════════════════════ FLOAT CTA ═════════════════════════════════ */
        .btn-outfit-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            color: #000 !important;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            z-index: 9000;
            box-shadow: var(--shadow-xl);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-weight: 800;
        }

        .btn-outfit-float:hover {
            transform: scale(1.15) rotate(-10deg);
            box-shadow: 0 30px 80px rgba(255,107,53,0.4);
        }

        /* ═════════════════════════════════ FOOTER ═════════════════════════════════ */
        .sv-footer {
            background: var(--black);
            padding: 100px 0 40px;
            border-top: 2px solid rgba(255,107,53,0.2);
        }

        .footer-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 60px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
        }

        .footer-logo {
            font-family: 'Syne', sans-serif;
            font-size: 36px;
            letter-spacing: 2px;
            color: var(--white);
            margin-bottom: 20px;
            font-weight: 800;
        }

        .footer-logo span {
            color: var(--orange);
        }

        .footer-desc {
            font-size: 13px;
            color: #666;
            line-height: 1.8;
        }

        .footer-col h6 {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 24px;
            font-weight: 800;
        }

        .footer-col a {
            display: block;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .footer-col a:hover {
            color: var(--orange);
            transform: translateX(4px);
        }

        .footer-bottom {
            max-width: 1300px;
            margin: 60px auto 0;
            padding: 24px 60px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            font-size: 12px;
            color: #555;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .footer-socials {
            display: flex;
            gap: 20px;
        }

        .footer-socials a {
            color: #666;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,107,53,0.2);
            border-radius: 50%;
        }

        .footer-socials a:hover {
            color: var(--orange);
            background: rgba(255,107,53,0.1);
            transform: translateY(-4px);
        }

        /* ═════════════════════════════════ PAGE LOADER ═════════════════════════════════ */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: var(--black);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 24px;
            transition: opacity 0.6s, visibility 0.6s;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            font-family: 'Syne', sans-serif;
            font-size: 52px;
            letter-spacing: 4px;
            color: var(--white);
            font-weight: 800;
        }

        .loader-logo span {
            color: var(--orange);
        }

        .loader-bar-wrap {
            width: 200px;
            height: 3px;
            background: rgba(255,255,255,0.15);
            border-radius: 3px;
            overflow: hidden;
        }

        .loader-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--orange), var(--yellow));
            width: 0%;
            animation: load-progress 1.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes load-progress { to { width: 100%; } }

        /* ═════════════════════════════════ RESPONSIVE ═════════════════════════════════ */
        @media (max-width: 1024px) {
            .hero { grid-template-columns: 1fr; min-height: auto; }
            .hero-left { padding: 100px 40px 60px; }
            .hero-right { height: 50vw; }
            .hero::before { width: 400px; height: 400px; right: -100px; }
            .hero-right::before { font-size: 200px; bottom: -40px; }
            .editorial-inner { grid-template-columns: 1fr; gap: 50px; padding: 0 40px; }
            .editorial-stats { gap: 40px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); padding: 0 30px; gap: 8px; }
            .products-grid { grid-template-columns: repeat(3, 1fr); padding: 0 30px; gap: 20px; }
            .lookbook-grid { grid-template-columns: repeat(2, 1fr); padding: 0 30px; }
            .lookbook-grid .look-item:first-child { grid-row: span 1; }
            .gallery-grid { grid-template-columns: repeat(3, 1fr); padding: 0 30px; }
            .footer-inner { grid-template-columns: 1fr 1fr; padding: 0 40px; gap: 40px; }
            .footer-bottom { padding: 20px 40px 0; }
            .sv-nav { padding: 16px 30px; }
            .sv-nav-links { display: none; }
            .scroll-hint { display: none; }
            .hero-title { font-size: clamp(60px, 8vw, 120px); }
            .hero-left { padding: 80px 40px 50px; }
        }

        @media (max-width: 768px) {
            :root {
                --shadow-md: 0 4px 16px rgba(0,0,0,0.12);
                --shadow-lg: 0 12px 40px rgba(0,0,0,0.15);
            }

            /* Navbar */
            .sv-nav {
                padding: 14px 20px;
                gap: 16px;
            }

            .sv-logo {
                font-size: 22px;
                letter-spacing: 2px;
            }

            .sv-cart-btn { font-size: 20px; }
            .cart-badge { width: 18px; height: 18px; font-size: 10px; }

            /* Hero */
            .hero {
                padding-top: 70px;
                min-height: 95vh;
            }

            .hero-left {
                padding: 60px 24px 40px;
                justify-content: center;
            }

            .hero-right {
                min-height: 50vh;
            }

            .hero::before {
                width: 300px;
                height: 300px;
                right: -150px;
                top: 100px;
            }

            .hero-right::before {
                font-size: 150px;
                bottom: -30px;
                right: -30px;
                opacity: 0.08;
            }

            .hero-eyebrow {
                font-size: 11px;
                margin-bottom: 16px;
                gap: 8px;
            }

            .hero-eyebrow::before {
                width: 30px;
                height: 1.5px;
            }

            .hero-title {
                font-size: clamp(48px, 12vw, 90px);
                line-height: 0.9;
                margin-bottom: 20px;
            }

            .hero-title em { font-size: 0.6em; }

            .hero-desc {
                font-size: 14px;
                max-width: 100%;
                margin-bottom: 28px;
                line-height: 1.7;
            }

            .hero-cta {
                padding: 14px 28px;
                font-size: 11px;
                gap: 8px;
            }

            .hero-tag {
                font-size: 11px;
                margin-top: 20px;
            }

            .scroll-hint {
                display: none !important;
            }

            .hero-badge {
                width: 90px;
                height: 90px;
                top: 30px;
                right: 30px;
            }

            .hero-badge-inner { font-size: 24px; }
            .hero-badge-sub { font-size: 8px; }

            /* Ticker */
            .ticker {
                padding: 12px 0;
            }

            .ticker-item {
                font-size: 14px;
                padding: 0 30px;
                letter-spacing: 2px;
            }

            /* Editorial */
            .editorial {
                padding: 80px 0;
            }

            .editorial-inner {
                padding: 0 24px;
                gap: 30px;
            }

            .editorial-img-wrap {
                aspect-ratio: 3/4;
            }

            .editorial-title {
                font-size: clamp(28px, 6vw, 42px);
                line-height: 1.25;
                margin-bottom: 18px;
            }

            .editorial-body {
                font-size: 14px;
                line-height: 1.7;
                margin-bottom: 24px;
            }

            .editorial-stats {
                gap: 30px;
                margin-top: 32px;
                padding-top: 24px;
                flex-wrap: wrap;
            }

            .stat-num {
                font-size: 36px;
            }

            .stat-label {
                font-size: 10px;
                margin-top: 4px;
            }

            .editorial-btn {
                padding: 12px 24px;
                font-size: 11px;
            }

            /* Categories */
            .categories {
                padding: 80px 0;
            }

            .section-header {
                margin-bottom: 50px;
            }

            .section-eyebrow {
                font-size: 11px;
                margin-bottom: 12px;
            }

            .section-title {
                font-size: clamp(36px, 8vw, 56px);
                letter-spacing: -0.5px;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
                padding: 0 20px;
            }

            .cat-card-content {
                padding: 20px;
            }

            .cat-icon { font-size: 28px; margin-bottom: 8px; }
            .cat-name { font-size: 20px; letter-spacing: 1px; }
            .cat-arrow { font-size: 10px; margin-top: 6px; }
            .cat-number { top: 16px; right: 16px; font-size: 12px; }

            /* Products */
            .products-section {
                padding: 80px 0;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                padding: 0 20px;
            }

            .product-card {
                box-shadow: var(--shadow-sm);
            }

            .product-card:hover {
                transform: translateY(-8px);
                box-shadow: var(--shadow-md);
            }

            .product-img-wrap {
                aspect-ratio: 3/4;
            }

            .product-tag {
                font-size: 8px;
                padding: 4px 8px;
                top: 10px;
                left: 10px;
            }

            .product-actions {
                padding: 10px;
            }

            .product-info {
                padding: 14px;
            }

            .product-brand { font-size: 9px; }
            .product-name { font-size: 13px; }
            .product-price { font-size: 16px; }

            .btn-cart {
                padding: 10px;
                font-size: 10px;
            }

            /* Lookbook */
            .lookbook {
                padding: 80px 0;
            }

            .lookbook-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 0 20px;
                gap: 2px;
            }

            .lookbook-grid .look-item:first-child {
                grid-row: span 2;
            }

            .look-item {
                min-height: 250px;
            }

            .look-label {
                padding: 16px 12px 12px;
            }

            .look-num { font-size: 10px; }
            .look-title { font-size: 13px; margin-top: 4px; }

            /* Gallery */
            .gallery-section {
                padding: 80px 0;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2px;
                padding: 0 20px;
            }

            .gallery-hover i { font-size: 24px; margin-bottom: 8px; }
            .gallery-hover p { font-size: 10px; }

            /* Float Button */
            .btn-outfit-float {
                width: 58px;
                height: 58px;
                bottom: 24px;
                right: 24px;
                font-size: 20px;
            }

            /* Footer */
            .sv-footer {
                padding: 60px 0 30px;
            }

            .footer-inner {
                grid-template-columns: 1fr 1fr;
                padding: 0 20px;
                gap: 30px;
            }

            .footer-logo {
                font-size: 28px;
                margin-bottom: 12px;
            }

            .footer-desc {
                font-size: 12px;
                line-height: 1.6;
            }

            .footer-col h6 {
                font-size: 11px;
                margin-bottom: 16px;
            }

            .footer-col a {
                font-size: 13px;
                margin-bottom: 8px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 16px;
                padding: 16px 20px 0;
                text-align: center;
            }

            .footer-bottom p { font-size: 11px; }
            .footer-socials { gap: 12px; }
            .footer-socials a { font-size: 14px; width: 36px; height: 36px; }
        }

        /* MOBILE - Extra Small Screens */
        @media (max-width: 480px) {
            .sv-nav {
                padding: 12px 16px;
                border-bottom: 1px solid rgba(255,107,53,0.1);
            }

            .sv-logo {
                font-size: 18px;
                letter-spacing: 1px;
            }

            .sv-cart-btn { font-size: 18px; }

            /* Hero */
            .hero {
                padding-top: 60px;
                min-height: 100vh;
                grid-template-columns: 1fr;
            }

            .hero-left {
                padding: 40px 16px 30px;
            }

            .hero-right {
                min-height: 45vh;
            }

            .hero::before {
                width: 200px;
                height: 200px;
                right: -100px;
                top: 80px;
                opacity: 0.5;
            }

            .hero-right::before {
                font-size: 100px;
                opacity: 0.05;
            }

            .hero-eyebrow {
                font-size: 10px;
                margin-bottom: 12px;
            }

            .hero-eyebrow::before {
                width: 25px;
            }

            .hero-title {
                font-size: clamp(42px, 15vw, 70px);
                margin-bottom: 16px;
                line-height: 0.95;
            }

            .hero-desc {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .hero-cta {
                padding: 12px 20px;
                font-size: 10px;
                gap: 6px;
            }

            .hero-cta span i { font-size: 12px; }

            .hero-tag {
                font-size: 10px;
                margin-top: 16px;
            }

            .hero-badge {
                width: 70px;
                height: 70px;
                top: 20px;
                right: 20px;
                box-shadow: 0 10px 30px rgba(255,107,53,0.3);
            }

            .hero-badge-inner { font-size: 18px; }
            .hero-badge-sub { font-size: 7px; }

            /* Ticker */
            .ticker {
                padding: 10px 0;
                border-top: 1px solid rgba(0,0,0,0.08);
                border-bottom: 1px solid rgba(0,0,0,0.08);
            }

            .ticker-item {
                font-size: 12px;
                padding: 0 20px;
                letter-spacing: 1px;
            }

            /* Editorial */
            .editorial {
                padding: 60px 0;
            }

            .editorial-inner {
                padding: 0 16px;
                gap: 20px;
            }

            .editorial-label {
                font-size: 10px;
                margin-bottom: 12px;
            }

            .editorial-title {
                font-size: clamp(24px, 7vw, 36px);
                margin-bottom: 14px;
            }

            .editorial-body {
                font-size: 13px;
                line-height: 1.6;
                color: #888;
                margin-bottom: 20px;
            }

            .editorial-btn {
                padding: 10px 18px;
                font-size: 10px;
            }

            .editorial-stats {
                gap: 20px;
                margin-top: 24px;
                padding-top: 16px;
                flex-direction: row;
            }

            .stat-num { font-size: 28px; }
            .stat-label { font-size: 9px; }

            /* Categories */
            .categories { padding: 60px 0; }
            .section-header { margin-bottom: 40px; }
            .section-title { font-size: clamp(32px, 10vw, 48px); }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 4px;
                padding: 0 12px;
            }

            .cat-card-content { padding: 16px; }
            .cat-icon { font-size: 24px; }
            .cat-name { font-size: 16px; letter-spacing: 0.5px; }
            .cat-arrow { font-size: 9px; }
            .cat-number { font-size: 10px; }

            /* Products */
            .products-section { padding: 60px 0; }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 0 12px;
            }

            .product-img-wrap { aspect-ratio: 3/4; }
            .product-tag { font-size: 7px; padding: 3px 6px; }
            .product-actions { padding: 8px; gap: 6px; }
            .product-info { padding: 12px; }
            .product-name { font-size: 12px; }
            .product-price { font-size: 14px; }
            .btn-cart { font-size: 9px; padding: 8px; }

            /* Lookbook */
            .lookbook { padding: 60px 0; }
            .lookbook-grid { grid-template-columns: repeat(2, 1fr); padding: 0 12px; }
            .look-item { min-height: 200px; }
            .look-label { padding: 12px 8px; }
            .look-num { font-size: 9px; }
            .look-title { font-size: 12px; margin-top: 2px; }

            /* Gallery */
            .gallery-section { padding: 60px 0; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); padding: 0 12px; }
            .gallery-hover i { font-size: 20px; }
            .gallery-hover p { font-size: 9px; }

            /* Float Button */
            .btn-outfit-float {
                width: 54px;
                height: 54px;
                bottom: 20px;
                right: 20px;
                font-size: 18px;
            }

            /* Footer */
            .sv-footer { padding: 50px 0 25px; }
            .footer-inner {
                grid-template-columns: 1fr;
                padding: 0 16px;
                gap: 24px;
            }

            .footer-logo { font-size: 24px; margin-bottom: 10px; }
            .footer-desc { font-size: 11px; }
            .footer-col h6 { font-size: 10px; margin-bottom: 12px; }
            .footer-col a { font-size: 12px; margin-bottom: 6px; }
            .footer-bottom { padding: 12px 16px 0; }
            .footer-bottom p { font-size: 10px; }
            .footer-socials { gap: 10px; }
            .footer-socials a { width: 34px; height: 34px; font-size: 13px; }
        }

        /* Ultra Mobile - Very Small Screens */
        @media (max-width: 360px) {
            .sv-logo { font-size: 16px; }
            .hero-title { font-size: clamp(36px, 12vw, 60px); }
            .hero-desc { font-size: 12px; }
            .hero-cta { padding: 10px 16px; font-size: 9px; }
            .hero-badge { width: 60px; height: 60px; }
            .categories-grid { padding: 0 8px; }
            .products-grid { padding: 0 8px; gap: 10px; }
            .gallery-grid { padding: 0 8px; }
            .lookbook-grid { padding: 0 8px; }
            .footer-inner { padding: 0 12px; gap: 16px; }
        }
    </style>
</head>
<body>

<!-- LOADER -->
<div class="page-loader" id="loader">
    <div class="loader-logo">STREET<span>VIBE.</span></div>
    <div class="loader-bar-wrap"><div class="loader-bar"></div></div>
</div>

<!-- CURSOR -->
<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- ═══════════════════════════════════════ NAVBAR ═══════════════════════════════════════ -->
<nav class="sv-nav" id="svNav">
    <a href="{{ url('/') }}" class="sv-logo">STREET<span>VIBE.</span></a>
    <ul class="sv-nav-links">
        <li><a href="#products-section">Produk</a></li>
        <li><a href="#lookbook">Lookbook</a></li>
        <li><a href="{{ route('user.outfits.index') }}">Outfits</a></li>
        <li><a href="#gallery">Instagram</a></li>
    </ul>

    <!-- Mobile Menu -->
    <div class="sv-mobile-menu" id="mobileMenu">
        <a href="#products-section">Produk</a>
        <a href="#lookbook">Lookbook</a>
        <a href="{{ route('user.outfits.index') }}">Outfits</a>
        <a href="#gallery">Instagram</a>
    </div>

    <!-- Cart + Hamburger -->
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('cart.index') }}" class="sv-cart-btn">
            <span class="lnr lnr-cart"></span>
            @php $cart = session('cart'); @endphp
            @if($cart && count($cart) > 0)
                <span class="cart-badge">{{ count($cart) }}</span>
            @endif
        </a>
        <button class="sv-hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- ALERT -->
@if(session('success'))
<div class="sv-alert" id="svAlert">
    <i class="fa fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<!-- ═══════════════════════════════════════ HERO ═══════════════════════════════════════ -->
<section class="hero">
    <div class="hero-left">
        <div class="hero-eyebrow">Collection 2026</div>
        <h1 class="hero-title">
            STREET<br>
            <em>"Artistry"</em>
            CULTURE
        </h1>
        <p class="hero-desc">Lebih dari sekadar pakaian — ini adalah pernyataan tentang siapa dirimu di tengah keramaian kota.</p>
        <div>
            <a class="hero-cta" href="#products-section">
                <span>Explore Collection</span>
                <span class="lnr lnr-arrow-right"></span>
            </a>
        </div>
        <div class="hero-tag">✦ Free shipping on orders above Rp 500k</div>
        <div class="scroll-hint">
            <div class="scroll-line"></div>
            Scroll to discover
        </div>
    </div>
    <div class="hero-right">
        <img class="hero-img" src="{{ asset('img/convers.png') }}" alt="Hero Image">
        <div class="hero-badge">
            <div class="hero-badge-inner">NEW</div>
            <div class="hero-badge-sub">Drop</div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ TICKER ═══════════════════════════════════════ -->
<div class="ticker">
    <div class="ticker-track">
        @foreach(range(1,2) as $i)
        <span class="ticker-item">STREETWEAR</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">URBAN CULTURE</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">LIMITED DROPS</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">FREE SHIPPING</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">NEW COLLECTION 2026</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">DEFINE YOUR VIBE</span>
        <span class="ticker-item ticker-sep">✦</span>
        @endforeach
    </div>
</div>

<!-- ═══════════════════════════════════════ EDITORIAL ═══════════════════════════════════════ -->
<section class="editorial">
    <div class="editorial-inner">
        <div style="position: relative;">
            <div class="editorial-img-wrap">
                <div class="editorial-img-accent"></div>
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?auto=format&fit=crop&w=900&q=80" alt="Editorial">
            </div>
        </div>
        <div>
            <p class="editorial-label">✦ Trend 2026</p>
            <h2 class="editorial-title">"Style is a way to say who you are without having to speak."</h2>
            <p class="editorial-body">Setiap koleksi kami lahir dari riset mendalam tentang budaya jalanan dunia — dari Tokyo hingga New York, dari Jakarta hingga London. Ini bukan fashion biasa, ini adalah pergerakan.</p>
            <a href="#products-section" class="editorial-btn">
                Lihat Koleksi <span class="lnr lnr-arrow-right"></span>
            </a>
            <div class="editorial-stats">
                <div>
                    <div class="stat-num">200<span>+</span></div>
                    <div class="stat-label">Products</div>
                </div>
                <div>
                    <div class="stat-num">50<span>+</span></div>
                    <div class="stat-label">Brands</div>
                </div>
                <div>
                    <div class="stat-num">10k<span>+</span></div>
                    <div class="stat-label">Customers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ CATEGORIES ═══════════════════════════════════════ -->
<section class="categories" id="products-section">
    <div class="section-header">
        <span class="section-eyebrow">Shop by Category</span>
        <h2 class="section-title">THE ESSENTIALS</h2>
    </div>
    <div class="categories-grid">
        <a href="{{ url('/products?kategori=jacket') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1551537482-f2075a1d41f2?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">01</div>
                <span class="cat-icon fa fa-archive"></span>
                <div class="cat-name">JACKET</div>
                <div class="cat-arrow">SHOP NOW →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=baju') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1562157873-818bc0726f68?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">02</div>
                <span class="cat-icon lnr lnr-shirt"></span>
                <div class="cat-name">UPPERWEAR</div>
                <div class="cat-arrow">SHOP NOW →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=celana') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">03</div>
                <span class="cat-icon lnr lnr-layers"></span>
                <div class="cat-name">BOTTOMWEAR</div>
                <div class="cat-arrow">SHOP NOW →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=sepatu') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">04</div>
                <span class="cat-icon lnr lnr-map"></span>
                <div class="cat-name">FOOTWEAR</div>
                <div class="cat-arrow">SHOP NOW →</div>
            </div>
        </a>
    </div>
</section>

<!-- ═══════════════════════════════════════ PRODUCTS ═══════════════════════════════════════ -->
<section class="products-section">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
        <div class="section-header">
            <span class="section-eyebrow">Fresh Arrivals</span>
            <h2 class="section-title">LATEST DROPS</h2>
        </div>

        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card">
                <div class="product-img-wrap">
                    <span class="product-tag">NEW</span>

                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ Storage::url($product->gambar) }}"
                             alt="{{ $product->nama_produk }}">
                    </a>

                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-cart w-100">
                                <span class="lnr lnr-cart"></span> ADD
                            </button>
                        </form>
                        <a href="{{ route('products.show', $product->id) }}" class="btn-action btn-view">
                            <span class="lnr lnr-eye"></span>
                        </a>
                    </div>
                </div>

                <div class="product-info">
                    <div class="product-brand">STREETVIBE</div>
                    <a href="{{ route('products.show', $product->id) }}" class="product-name">
                        {{ strtoupper($product->nama_produk) }}
                    </a>
                    <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                <p style="color: var(--grey); font-size: 16px;">Belum ada produk yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ LOOKBOOK ═══════════════════════════════════════ -->
<section class="lookbook" id="lookbook">
    <div class="section-header" style="padding: 0 40px; text-align:left; margin-bottom: 48px; max-width: 1400px; margin-left: auto; margin-right: auto;">
        <span class="section-eyebrow">✦ Visual Stories</span>
        <h2 class="section-title" style="color: var(--white);">STREET<br>LOOKBOOK</h2>
    </div>
    <div class="lookbook-grid">
        <div class="look-item">
            <img src="{{ asset('img/2.jpeg') }}" alt="Look 01">
            <div class="look-label"><div class="look-num">VIBE 01</div><div class="look-title">Urban Warrior</div></div>
        </div>
        <div class="look-item">
            <img src="{{ asset('img/3.jpeg') }}" alt="Look 02">
            <div class="look-label"><div class="look-num">VIBE 02</div><div class="look-title">Street Minimal</div></div>
        </div>
        <div class="look-item">
            <img src="{{ asset('img/4.jpeg') }}" alt="Look 03">
            <div class="look-label"><div class="look-num">VIBE 03</div><div class="look-title">City Grunge</div></div>
        </div>
        <div class="look-item">
            <img src="{{ asset('img/8.jpeg') }}" alt="Look 04">
            <div class="look-label"><div class="look-num">VIBE 04</div><div class="look-title">Monochrome Days</div></div>
        </div>
        <div class="look-item">
            <img src="{{ asset('img/6.jpeg') }}" alt="Look 05">
            <div class="look-label"><div class="look-num">VIBE 05</div><div class="look-title">Off-Duty Mode</div></div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ GALLERY ═══════════════════════════════════════ -->
<section class="gallery-section" id="gallery">
    <div class="section-header">
        <span class="section-eyebrow">
            <a href="https://www.instagram.com/jeoujo_/" target="_blank" style="color: var(--orange); text-decoration:none;">@jeoujo_</a>
        </span>
        <h2 class="section-title">FOLLOW<br>THE VIBE</h2>
    </div>
    <div class="gallery-grid">
        @foreach($galleryPhotos as $photo)
        <div class="gallery-item" onclick="window.open('https://instagram.com/{{ str_replace('@', '', $photo->caption) }}', '_blank')">
            <img src="{{ Storage::url($photo->foto) }}" alt="{{ $photo->caption }}">
            <div class="gallery-hover">
                <i class="fab fa-instagram"></i>
                <p>{{ str_starts_with($photo->caption, '@') ? $photo->caption : '@' . $photo->caption }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- FLOAT BTN -->
<a href="{{ route('user.outfits.index') }}" class="btn-outfit-float" title="Build Outfit">
    <span class="lnr lnr-shirt"></span>
</a>

<!-- ═══════════════════════════════════════ FOOTER ═══════════════════════════════════════ -->
<footer class="sv-footer">
    <div class="footer-inner">
        <div>
            <div class="footer-logo">STREET<span>VIBE.</span></div>
            <p class="footer-desc">Streetwear yang lahir dari budaya urban — dibuat untuk mereka yang berani tampil beda di tengah keramaian kota.</p>
        </div>
        <div class="footer-col">
            <h6>Shop</h6>
            <a href="{{ url('/products?kategori=jacket') }}">Jacket</a>
            <a href="{{ url('/products?kategori=baju') }}">Upperwear</a>
            <a href="{{ url('/products?kategori=celana') }}">Bottomwear</a>
            <a href="{{ url('/products?kategori=sepatu') }}">Footwear</a>
        </div>
        <div class="footer-col">
            <h6>Info</h6>
            <a href="#">About Us</a>
            <a href="#">Lookbook</a>
            <a href="#">Size Guide</a>
            <a href="#">FAQ</a>
        </div>
        <div class="footer-col">
            <h6>Contact</h6>
            <a href="#">support@streetvibe.id</a>
            <a href="#">WhatsApp</a>
            <a href="https://www.instagram.com/jeoujo_/" target="_blank">Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 STREETVIBE. ALL RIGHTS RESERVED.</p>
        <div class="footer-socials">
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-tiktok"></i></a>
        </div>
    </div>
</footer>

<script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('user/js/vendor/bootstrap.min.js') }}"></script>
<script>
    // ── Hamburger Menu Toggle ──
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    if (hamburger) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        // Close menu when link clicked
        document.querySelectorAll('.sv-mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });

        // Close menu on scroll
        window.addEventListener('scroll', function() {
            if (hamburger.classList.contains('active')) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
            }
        });
    }

    // ── Loader ──
    window.addEventListener('load', function () {
        setTimeout(function () {
            document.getElementById('loader').classList.add('hidden');
        }, 1600);
    });

    // ── Custom Cursor ──
    const dot  = document.getElementById('cursorDot');
    const ring = document.getElementById('cursorRing');
    document.addEventListener('mousemove', function (e) {
        dot.style.left  = e.clientX + 'px';
        dot.style.top   = e.clientY + 'px';
        setTimeout(function () {
            ring.style.left = e.clientX + 'px';
            ring.style.top  = e.clientY + 'px';
        }, 50);
    });

    document.querySelectorAll('a, button').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            ring.style.width  = '60px';
            ring.style.height = '60px';
            ring.style.borderColor = '#ff6b35';
        });
        el.addEventListener('mouseleave', function () {
            ring.style.width  = '40px';
            ring.style.height = '40px';
            ring.style.borderColor = '#ff6b35';
        });
    });

    // ── Navbar scroll ──
    window.addEventListener('scroll', function () {
        var nav = document.getElementById('svNav');
        if (window.scrollY > 60) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // ── Alert auto-dismiss ──
    var alert = document.getElementById('svAlert');
    if (alert) {
        setTimeout(function () {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(function () { alert.remove(); }, 500);
        }, 4000);
    }

    // ── Smooth anchor ──
    $('a[href^="#"]').on('click', function (e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({ scrollTop: target.offset().top - 80 }, 900);
        }
    });

    // ── Staggered reveal on scroll ──
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, i) {
            if (entry.isIntersecting) {
                entry.target.style.transitionDelay = (i * 0.08) + 's';
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.product-card, .cat-card, .look-item, .gallery-item').forEach(function (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    var style = document.createElement('style');
    style.textContent = '.visible { opacity: 1 !important; transform: translateY(0) !important; }';
    document.head.appendChild(style);
</script>
</body>
</html>
