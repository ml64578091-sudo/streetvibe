<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('user/img/fav.png') }}">
    <meta charset="UTF-8">
    <title>StreetVibe — Define Your Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ─────────────────────────────── RESET & BASE ─────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --black:   #0a0a0a;
            --white:   #f5f2ee;
            --orange:  #ff5c00;
            --grey:    #8a8680;
            --light:   #f0ede8;
            --card-bg: #1a1a1a;
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            cursor: none;
        }

        /* ─────────────────────────────── CURSOR ─────────────────────────────── */
        .cursor-dot {
            width: 8px; height: 8px;
            background: var(--orange);
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s;
        }
        .cursor-ring {
            width: 36px; height: 36px;
            border: 1.5px solid var(--orange);
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99998;
            transform: translate(-50%, -50%);
            transition: transform 0.18s ease, width 0.3s, height 0.3s, border-color 0.3s;
            opacity: 0.7;
        }
        body:hover .cursor-ring { opacity: 1; }
        a, button { cursor: none; }

        /* ─────────────────────────────── NOISE OVERLAY ─────────────────────────────── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9990; opacity: 0.35;
        }

        /* ─────────────────────────────── NAVBAR ─────────────────────────────── */
        .sv-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 22px 40px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(245,242,238,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            transition: padding 0.4s, background 0.4s;
        }
        .sv-nav.scrolled { padding: 14px 40px; }
        .sv-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; letter-spacing: 2px;
            color: var(--black); text-decoration: none;
        }
        .sv-logo span { color: var(--orange); }
        .sv-nav-links { display: flex; gap: 32px; list-style: none; }
        .sv-nav-links a {
            font-size: 13px; font-weight: 500; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--black);
            text-decoration: none; position: relative; padding-bottom: 3px;
        }
        .sv-nav-links a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 1.5px; background: var(--orange);
            transition: width 0.3s ease;
        }
        .sv-nav-links a:hover::after { width: 100%; }
        .sv-cart-btn {
            position: relative; color: var(--black);
            font-size: 20px; text-decoration: none;
            transition: color 0.3s;
        }
        .sv-cart-btn:hover { color: var(--orange); }
        .cart-badge {
            position: absolute; top: -8px; right: -10px;
            background: var(--orange); color: #fff;
            border-radius: 50%; width: 18px; height: 18px;
            font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
        }

        /* ─────────────────────────────── HERO ─────────────────────────────── */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding-top: 80px;
            overflow: hidden;
        }
        .hero-left {
            display: flex; flex-direction: column;
            justify-content: center;
            padding: 80px 60px 80px 80px;
            position: relative;
        }
        .hero-eyebrow {
            font-size: 11px; letter-spacing: 4px; text-transform: uppercase;
            color: var(--orange); font-weight: 600; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .hero-eyebrow::before {
            content: ''; width: 30px; height: 1.5px; background: var(--orange);
        }
        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(80px, 10vw, 140px);
            line-height: 0.88;
            letter-spacing: -1px;
            color: var(--black);
            margin-bottom: 30px;
        }
        .hero-title em {
            font-family: 'Playfair Display', serif;
            color: var(--orange);
            font-size: 0.65em;
            display: block;
        }
        .hero-desc {
            font-size: 16px; color: var(--grey);
            line-height: 1.7; max-width: 380px; margin-bottom: 40px;
        }
        .hero-cta {
            display: inline-flex; align-items: center; gap: 12px;
            background: var(--black); color: var(--white) !important;
            padding: 16px 36px;
            border-radius: 0; font-size: 12px;
            font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none;
            position: relative; overflow: hidden;
            transition: color 0.4s;
        }
        .hero-cta::before {
            content: ''; position: absolute; inset: 0;
            background: var(--orange);
            transform: translateX(-101%);
            transition: transform 0.4s cubic-bezier(0.77,0,0.18,1);
        }
        .hero-cta:hover::before { transform: translateX(0); }
        .hero-cta span { position: relative; z-index: 1; }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 24px; font-size: 11px; color: var(--grey);
            letter-spacing: 1px; text-transform: uppercase;
        }
        .hero-tag::before { content: '✦'; color: var(--orange); }

        .hero-right {
            background: var(--black);
            position: relative; overflow: hidden;
            display: flex; align-items: flex-end;
        }
        /* .hero-right::before {
            content: 'VIBE';
            font-family: 'Bebas Neue', sans-serif;
            font-size: 300px; color: rgba(255,255,255,0.03);
            position: absolute; bottom: -40px; right: -20px;
            line-height: 1; pointer-events: none; user-select: none; */
        }
        .hero-img {
            width: 100%; height: 100%;
            object-fit: cover; object-position: center top;
            opacity: 0.85;
            transition: transform 8s ease;
        }
        .hero-right:hover .hero-img { transform: scale(1.04); }
        .hero-badge {
            position: absolute; top: 40px; right: 40px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: var(--orange);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: #fff; text-align: center;
            animation: spin-badge 12s linear infinite;
        }
        .hero-badge-inner {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; line-height: 1;
        }
        .hero-badge-sub { font-size: 9px; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; }
        @keyframes spin-badge { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* Scroll indicator */
        .scroll-hint {
            position: absolute; bottom: 30px; left: 80px;
            display: flex; align-items: center; gap: 10px;
            font-size: 11px; letter-spacing: 2px; text-transform: uppercase;
            color: var(--grey);
        }
        .scroll-line {
            width: 40px; height: 1px; background: var(--grey);
            position: relative; overflow: hidden;
        }
        .scroll-line::after {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%; background: var(--orange);
            animation: scroll-anim 2s ease infinite;
        }
        @keyframes scroll-anim { to { left: 100%; } }

        /* ─────────────────────────────── MARQUEE TICKER ─────────────────────────────── */
        .ticker {
            background: var(--orange);
            padding: 14px 0; overflow: hidden;
            border-top: 1px solid rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        .ticker-track {
            display: flex; gap: 0;
            animation: ticker-run 22s linear infinite;
            width: max-content;
        }
        .ticker-item {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px; color: #fff;
            letter-spacing: 3px;
            padding: 0 40px; white-space: nowrap;
        }
        .ticker-sep { color: rgba(255,255,255,0.4); }
        @keyframes ticker-run { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ─────────────────────────────── EDITORIAL STRIP ─────────────────────────────── */
        .editorial {
            padding: 100px 0;
            background: var(--black);
            position: relative; overflow: hidden;
        }
        .editorial-inner {
            max-width: 1400px; margin: 0 auto;
            padding: 0 60px;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 80px; align-items: center;
        }
        .editorial-img-wrap {
            position: relative;
            border-radius: 2px; overflow: hidden;
            aspect-ratio: 4/5;
        }
        .editorial-img-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.8s ease;
        }
        .editorial-img-wrap:hover img { transform: scale(1.05); }
        .editorial-img-accent {
            position: absolute; top: -20px; left: -20px;
            width: 100px; height: 100px;
            border: 2px solid var(--orange);
            border-radius: 2px;
            pointer-events: none;
        }
        .editorial-label {
            font-size: 11px; letter-spacing: 5px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 20px;
        }
        .editorial-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 4vw, 56px);
            color: var(--white); line-height: 1.15;
            margin-bottom: 24px; font-style: italic;
        }
        .editorial-body {
            font-size: 16px; color: #888;
            line-height: 1.8; margin-bottom: 36px;
        }
        .editorial-stats {
            display: flex; gap: 40px; margin-top: 48px;
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 36px;
        }
        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px; color: var(--white); line-height: 1;
        }
        .stat-num span { color: var(--orange); }
        .stat-label { font-size: 11px; color: #666; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }
        .editorial-btn {
            display: inline-flex; align-items: center; gap: 10px;
            border: 1px solid var(--orange); color: var(--orange) !important;
            padding: 14px 32px; font-size: 11px;
            letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none; transition: 0.3s;
            font-weight: 600;
        }
        .editorial-btn:hover { background: var(--orange); color: #fff !important; }

        /* ─────────────────────────────── CATEGORIES ─────────────────────────────── */
        .categories { padding: 100px 0; background: var(--white); }
        .section-header { text-align: center; margin-bottom: 60px; }
        .section-eyebrow {
            font-size: 11px; letter-spacing: 5px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 12px; display: block;
        }
        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(42px, 6vw, 72px);
            letter-spacing: 2px; line-height: 0.9;
        }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
            max-width: 1200px; margin: 0 auto;
            padding: 0 40px;
        }
        .cat-card {
            position: relative; aspect-ratio: 3/4;
            overflow: hidden; display: block;
            text-decoration: none !important;
            background: var(--black);
        }
        .cat-card-bg {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            transition: transform 0.7s ease, filter 0.5s;
            filter: brightness(0.4) saturate(0.5);
        }
        .cat-card:hover .cat-card-bg {
            transform: scale(1.08);
            filter: brightness(0.25) saturate(0);
        }
        .cat-card-content {
            position: absolute; inset: 0;
            display: flex; flex-direction: column;
            justify-content: flex-end; padding: 28px;
        }
        .cat-icon {
            font-size: 32px; color: var(--orange);
            margin-bottom: 12px;
            transform: translateY(10px); opacity: 0.7;
            transition: transform 0.4s, opacity 0.4s;
        }
        .cat-card:hover .cat-icon { transform: translateY(0); opacity: 1; }
        .cat-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px; color: #fff;
            letter-spacing: 3px;
            transform: translateY(5px);
            transition: transform 0.4s;
        }
        .cat-card:hover .cat-name { transform: translateY(0); }
        .cat-arrow {
            font-size: 11px; letter-spacing: 2px; text-transform: uppercase;
            color: var(--orange); margin-top: 8px;
            opacity: 0; transform: translateY(10px);
            transition: opacity 0.4s, transform 0.4s;
        }
        .cat-card:hover .cat-arrow { opacity: 1; transform: translateY(0); }
        .cat-number {
            position: absolute; top: 20px; right: 20px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px; color: rgba(255,255,255,0.3);
            letter-spacing: 2px;
        }

        /* ─────────────────────────────── PRODUCTS ─────────────────────────────── */
        .products-section { padding: 100px 0; background: var(--light); }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            max-width: 1300px; margin: 0 auto;
            padding: 0 40px;
        }
        .product-card {
            background: var(--white);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
            transition: transform 0.4s ease, box-shadow 0.4s;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 48px rgba(0,0,0,0.12);
        }
        .product-img-wrap {
            position: relative; overflow: hidden;
            aspect-ratio: 3/4;
            background: #e8e4de;
        }
        .product-img-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.7s ease;
        }
        .product-card:hover .product-img-wrap img { transform: scale(1.06); }
        .product-tag {
            position: absolute; top: 14px; left: 14px;
            background: var(--orange); color: #fff;
            font-size: 9px; letter-spacing: 2px; text-transform: uppercase;
            padding: 4px 10px; font-weight: 700;
        }
        .product-actions {
            position: absolute; bottom: -60px; left: 0; right: 0;
            padding: 14px;
            background: rgba(10,10,10,0.95);
            transition: bottom 0.35s cubic-bezier(0.77,0,0.18,1);
            display: flex; gap: 8px;
        }
        .product-card:hover .product-actions { bottom: 0; }
        .product-info { padding: 18px 18px 20px; }
        .product-brand {
            font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 4px;
        }
        .product-name {
            font-size: 14px; font-weight: 700; color: var(--black);
            margin-bottom: 10px; letter-spacing: 0.5px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .product-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; color: var(--black);
        }
        .btn-cart {
            flex: 1; background: var(--orange); color: #fff;
            border: none; padding: 10px; font-size: 12px;
            letter-spacing: 1px; text-transform: uppercase;
            font-weight: 700; transition: background 0.3s;
        }
        .btn-cart:hover { background: #e05000; }
        .btn-wishlist {
            background: rgba(255,255,255,0.1); color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 14px; font-size: 14px;
            transition: background 0.3s;
        }
        .btn-wishlist:hover { background: rgba(255,255,255,0.2); }

        /* ─────────────────────────────── LOOKBOOK / MASONRY ─────────────────────────────── */
        .lookbook { padding: 100px 0; background: var(--black); }
        .lookbook .section-title { color: var(--white); }
        .lookbook-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 3px;
            max-width: 1300px; margin: 0 auto;
            padding: 0 40px;
        }
        .look-item {
            position: relative; overflow: hidden;
            background: #111;
        }
        .look-item:first-child { grid-row: span 2; }
        .look-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s ease, filter 0.4s;
            filter: grayscale(30%);
            min-height: 280px;
        }
        .look-item:hover img { transform: scale(1.06); filter: grayscale(0%); }
        .look-label {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 24px 20px 20px;
            background: linear-gradient(transparent, rgba(0,0,0,0.85));
        }
        .look-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 11px; letter-spacing: 3px; color: var(--orange);
        }
        .look-title { font-size: 14px; font-weight: 600; color: #fff; margin-top: 2px; }

        /* ─────────────────────────────── GALLERY / INSTAGRAM ─────────────────────────────── */
        .gallery-section { padding: 100px 0; background: var(--white); }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3px;
            max-width: 1300px; margin: 0 auto;
            padding: 0 40px;
        }
        .gallery-item {
            aspect-ratio: 1/1; position: relative; overflow: hidden;
            background: var(--light);
        }
        .gallery-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s ease;
        }
        .gallery-item:hover img { transform: scale(1.08); }
        .gallery-hover {
            position: absolute; inset: 0;
            background: rgba(255,92,0,0.85);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.4s;
            color: #fff;
        }
        .gallery-item:hover .gallery-hover { opacity: 1; }
        .gallery-hover i { font-size: 28px; margin-bottom: 8px; }
        .gallery-hover p { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; font-weight: 700; }

        /* ─────────────────────────────── ALERT ─────────────────────────────── */
        .sv-alert {
            position: fixed; top: 90px; right: 24px;
            background: var(--black); color: var(--white);
            padding: 16px 24px; border-radius: 2px;
            border-left: 3px solid var(--orange);
            font-size: 14px; z-index: 9000;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            animation: slide-in 0.4s ease forwards;
        }
        @keyframes slide-in { from { transform: translateX(120%); opacity:0; } to { transform: translateX(0); opacity:1; } }

        /* ─────────────────────────────── FLOAT CTA ─────────────────────────────── */
        .btn-outfit-float {
            position: fixed; bottom: 30px; right: 30px;
            background: var(--black); color: #fff !important;
            width: 58px; height: 58px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; z-index: 9000;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            text-decoration: none;
            transition: background 0.3s, transform 0.3s;
        }
        .btn-outfit-float:hover {
            background: var(--orange);
            transform: scale(1.1) rotate(15deg);
        }

        /* ─────────────────────────────── FOOTER ─────────────────────────────── */
        .sv-footer {
            background: var(--black);
            padding: 80px 0 40px;
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 0 60px;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
        }
        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px; letter-spacing: 2px;
            color: var(--white); margin-bottom: 16px;
        }
        .footer-logo span { color: var(--orange); }
        .footer-desc { font-size: 13px; color: #666; line-height: 1.8; }
        .footer-col h6 {
            font-size: 11px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 20px; font-weight: 700;
        }
        .footer-col a {
            display: block; color: #666; text-decoration: none;
            font-size: 14px; margin-bottom: 10px;
            transition: color 0.3s;
        }
        .footer-col a:hover { color: var(--white); }
        .footer-bottom {
            max-width: 1200px; margin: 60px auto 0;
            padding: 20px 60px 0;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex; justify-content: space-between; align-items: center;
        }
        .footer-bottom p { font-size: 12px; color: #444; letter-spacing: 1px; }
        .footer-socials { display: flex; gap: 16px; }
        .footer-socials a { color: #444; font-size: 15px; transition: color 0.3s; }
        .footer-socials a:hover { color: var(--orange); }

        /* ─────────────────────────────── PAGE LOAD ANIMATION ─────────────────────────────── */
        .page-loader {
            position: fixed; inset: 0; z-index: 99999;
            background: var(--black);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column; gap: 16px;
            transition: opacity 0.6s, visibility 0.6s;
        }
        .page-loader.hidden { opacity: 0; visibility: hidden; }
        .loader-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 52px; letter-spacing: 4px; color: var(--white);
        }
        .loader-logo span { color: var(--orange); }
        .loader-bar-wrap {
            width: 200px; height: 2px;
            background: rgba(255,255,255,0.1);
        }
        .loader-bar {
            height: 100%; background: var(--orange);
            width: 0%; animation: load-progress 1.2s ease forwards;
        }
        @keyframes load-progress { to { width: 100%; } }

        /* ─────────────────────────────── RESPONSIVE ─────────────────────────────── */
        @media (max-width: 991px) {
            .hero { grid-template-columns: 1fr; min-height: auto; }
            .hero-left { padding: 120px 30px 60px; }
            .hero-right { height: 60vw; }
            .editorial-inner { grid-template-columns: 1fr; gap: 40px; padding: 0 30px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
            .products-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
            .lookbook-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
            .lookbook-grid .look-item:first-child { grid-row: span 1; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
            .footer-inner { grid-template-columns: 1fr 1fr; padding: 0 30px; }
            .sv-nav { padding: 18px 24px; }
            .sv-nav-links { display: none; }
            .scroll-hint { display: none; }
        }
        @media (max-width: 575px) {
            .categories-grid, .products-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-inner { grid-template-columns: 1fr; }
            .hero-title { font-size: 70px; }
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
    <a href="{{ route('cart.index') }}" class="sv-cart-btn">
        <span class="lnr lnr-cart"></span>
        @php $cart = session('cart'); @endphp
        @if($cart && count($cart) > 0)
            <span class="cart-badge">{{ count($cart) }}</span>
        @endif
    </a>
</nav>

<!-- ALERT -->
@if(session('success'))
<div class="sv-alert" id="svAlert">
    <i class="fa fa-check-circle" style="color: var(--orange);"></i>
    {{ session('success') }}
</div>
@endif

<!-- ═══════════════════════════════════════ HERO ═══════════════════════════════════════ -->
<section class="hero">
    <div class="hero-content">


        <h1 class="hero-title">
            STREET <br>
            <em>"Artistry"</em> <br>
            CULTURE
        </h1>

        <p class="hero-desc">
            Lebih dari sekadar pakaian — ini adalah pernyataan tentang siapa dirimu di tengah keramaian kota.
        </p>

        <a class="hero-cta" href="#products-section">
            <span>Explore Collection</span>
            <span class="lnr lnr-arrow-right"></span>
        </a>



        <div class="scroll-hint">
            <div class="scroll-line"></div>
            Scroll to discover
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
            <p class="editorial-body">Setiap koleksi kami lahir dari riset mendalam tentang budaya jalanan dunia — dari Tokyo hingga New York, dari Jakarta hingga London. Ini bukan fashion biasa.</p>
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
                <div class="cat-arrow">Shop Now →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=baju') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1562157873-818bc0726f68?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">02</div>
                <span class="cat-icon lnr lnr-shirt"></span>
                <div class="cat-name">UPPERWEAR</div>
                <div class="cat-arrow">Shop Now →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=celana') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">03</div>
                <span class="cat-icon lnr lnr-layers"></span>
                <div class="cat-name">BOTTOMWEAR</div>
                <div class="cat-arrow">Shop Now →</div>
            </div>
        </a>
        <a href="{{ url('/products?kategori=sepatu') }}" class="cat-card">
            <div class="cat-card-bg" style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80');"></div>
            <div class="cat-card-content">
                <div class="cat-number">04</div>
                <span class="cat-icon lnr lnr-map"></span>
                <div class="cat-name">FOOTWEAR</div>
                <div class="cat-arrow">Shop Now →</div>
            </div>
        </a>
    </div>
</section>








<!-- ═══════════════════════════════════════ PRODUCTS ═══════════════════════════════════════ -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

<style>
.hero {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 40px 20px;
    background: radial-gradient(circle at top, #565555, #040404);
    color: #fff;
}

.hero-content {
    max-width: 900px;
    width: 100%;
}

.hero-eyebrow {
    font-size: 14px;
    letter-spacing: 3px;
    color: #ff6a00;
    margin-bottom: 15px;
    text-transform: uppercase;
}

.hero-title {
    font-size: 64px;
    line-height: 1.1;
    font-weight: 900;
    margin-bottom: 20px;
}

.hero-title em {
    font-style: normal;
    color: #ff6a00;
}

.hero-desc {
    font-size: 18px;
    color: #bbb;
    max-width: 600px;
    margin: 0 auto 30px;
}

.hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 30px;
    background: #ff6a00;
    color: #fff;
    text-decoration: none;
    border-radius: 40px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(255, 106, 0, 0.3);
}

.hero-cta:hover {
    background: #ff8533;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 106, 0, 0.5);
}

.hero-tag {
    margin-top: 20px;
    font-size: 14px;
    color: #888;
}

.scroll-hint {
    margin-top: 40px;
    font-size: 13px;
    color: #666;
}

.scroll-line {
    width: 2px;
    height: 40px;
    background: #ff6a00;
    margin: 0 auto 10px;
}





    :root {
        --primary-black: #111111;
        --accent-red: #ff3e3e;
        --soft-grey: #f8f8f8;
        --border-color: #eeeeee;
        --text-muted: #888888;
        --transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .products-section {
        padding: 100px 0;
        background: #ffffff;
        font-family: 'Inter', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Section Header */
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-eyebrow {
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 11px;
        color: var(--accent-red);
        font-weight: 700;
        display: block;
        margin-bottom: 12px;
    }

    .section-title {
        font-size: 42px;
        font-weight: 900;
        letter-spacing: -1.5px;
        color: var(--primary-black);
        margin: 0;
        text-transform: uppercase;
    }

    .header-line {
        width: 50px;
        height: 4px;
        background: var(--primary-black);
        margin: 20px auto 0;
    }

    /* Grid System */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    /* Product Card */
    .product-card {
        background: #fff;
        position: relative;
        transition: var(--transition);
    }

    .product-img-container {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        background: var(--soft-grey);
        border-radius: 4px;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .product-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--primary-black);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 6px 14px;
        z-index: 10;
        letter-spacing: 1px;
        border-radius: 2px;
    }

    /* Hover State */
    .product-card:hover .product-image {
        transform: scale(1.08);
    }

    .img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        opacity: 0;
        transition: var(--transition);
        z-index: 5;
    }

    .product-card:hover .img-overlay {
        opacity: 1;
    }

    /* Floating Actions */
    .product-actions {
        position: absolute;
        bottom: -70px; /* Sembunyi di bawah */
        left: 0;
        width: 100%;
        display: flex;
        padding: 20px;
        gap: 10px;
        z-index: 15;
        transition: var(--transition);
    }

    .product-card:hover .product-actions {
        bottom: 0;
    }

    .btn-action {
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        border-radius: 4px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-main-cart {
        flex: 1;
        background: #ffffff;
        color: var(--primary-black);
        font-size: 12px;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-main-cart:hover {
        background: var(--primary-black);
        color: #ffffff;
    }

    .btn-view {
        width: 48px;
        background: rgba(255,255,255,0.95);
        color: var(--primary-black);
        font-size: 18px;
    }

    .btn-view:hover {
        background: var(--accent-red);
        color: #fff;
    }

    /* Product Details */
    .product-details {
        padding: 20px 0;
    }

    .brand-name {
        font-size: 10px;
        color: var(--text-muted);
        letter-spacing: 2px;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .product-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-black);
        margin: 0 0 8px 0;
        transition: var(--transition);
        text-decoration: none;
        display: block;
    }

    .product-title:hover {
        color: var(--accent-red);
    }

    .price-tag {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 100px 0;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
    }

    .empty-state p {
        color: var(--text-muted);
        font-size: 16px;
    }
</style>

<section class="products-section">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Fresh Arrivals</span>
            <h2 class="section-title">LATEST DROPS</h2>
            <div class="header-line"></div>
        </div>

        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card">
                <div class="product-img-container">
                    <div class="product-badge">NEW</div>

                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ Storage::url($product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="product-image">
                        <div class="img-overlay"></div>
                    </a>

                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-action btn-main-cart w-100">
                                <span class="lnr lnr-cart"></span> ADD TO CART
                            </button>
                        </form>
                        <a href="{{ route('products.show', $product->id) }}" class="btn-action btn-view">
                            <span class="lnr lnr-eye"></span>
                        </a>
                    </div>
                </div>

                <div class="product-details">
                    <div class="brand-name">STREETVIBE</div>
                    <a href="{{ route('products.show', $product->id) }}" class="product-title">
                        {{ strtoupper($product->nama_produk) }}
                    </a>
                    <div class="price-tag">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <p>Belum ada produk yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ LOOKBOOK ═══════════════════════════════════════ -->
<section class="lookbook" id="lookbook">
    <div class="section-header" style="padding: 0 40px; text-align:left; margin-bottom: 48px; max-width: 1300px; margin-left: auto; margin-right: auto;">
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
       <div class="gallery-item" onclick="window.open('https://instagram.com/{{ str_replace('@', '', $photo->caption) }}', '_blank')" style="cursor: pointer;">
    <img src="{{ Storage::url($photo->foto) }}" alt="{{ $photo->caption }}">

    <div class="gallery-hover">
        <i class="fab fa-instagram" style="font-size: 24px; color: white;"></i>
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
    // ── Loader ──
    window.addEventListener('load', function () {
        setTimeout(function () {
            document.getElementById('loader').classList.add('hidden');
        }, 1400);
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
        }, 60);
    });
    document.querySelectorAll('a, button').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            ring.style.width  = '56px';
            ring.style.height = '56px';
            ring.style.borderColor = '#ff5c00';
        });
        el.addEventListener('mouseleave', function () {
            ring.style.width  = '36px';
            ring.style.height = '36px';
            ring.style.borderColor = '#ff5c00';
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

    // Add visible class via CSS injection
    var style = document.createElement('style');
    style.textContent = '.visible { opacity: 1 !important; transform: translateY(0) !important; }';
    document.head.appendChild(style);
</script>
</body>
</html>
