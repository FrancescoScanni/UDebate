<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UDebate — Il social media del confronto</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:400,500,600,700,800&family=dm-sans:300,400,500&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg:        #0a0a0f;
            --surface:   #111118;
            --border:    #1e1e2e;
            --accent:    #e8ff47;
            --accent-dim:#b5c936;
            --text:      #f0f0f5;
            --muted:     #6b6b80;
            --red:       #ff4757;
            --blue:      #3d8bff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            overflow-x: hidden;
        }

        h1, h2, h3, .brand { font-family: 'Syne', sans-serif; }

        /* ── Noise overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            opacity: .03;
            pointer-events: none;
            z-index: 0;
        }

        /* ── Glow blobs ── */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }
        .blob-1 { width: 600px; height: 600px; background: rgba(232,255,71,.07); top: -180px; left: -100px; }
        .blob-2 { width: 500px; height: 500px; background: rgba(61,139,255,.06); top: 200px; right: -150px; }

        /* ── Navbar ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 2.5rem;
            background: rgba(10,10,15,.75);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -.03em;
            color: var(--text);
        }
        .brand span { color: var(--accent); }

        .nav-actions { display: flex; align-items: center; gap: .75rem; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1.2rem;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
            border: 1px solid transparent;
        }
        .btn-ghost {
            color: var(--muted);
            border-color: var(--border);
            background: transparent;
        }
        .btn-ghost:hover { color: var(--text); border-color: #3a3a50; background: #111118; }

        .btn-primary {
            background: var(--accent);
            color: #0a0a0f;
            border-color: var(--accent);
        }
        .btn-primary:hover { background: var(--accent-dim); border-color: var(--accent-dim); transform: translateY(-1px); }

        /* ── Hero ── */
        .hero {
            position: relative;
            min-height: 92svh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 7rem 2rem 4rem;
            overflow: hidden;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .3rem .85rem;
            border-radius: 100px;
            border: 1px solid rgba(232,255,71,.2);
            background: rgba(232,255,71,.05);
            color: var(--accent);
            font-size: .75rem;
            font-weight: 500;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: 1.75rem;
            animation: fadeUp .6s ease both;
        }
        .hero-eyebrow .dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .5; transform: scale(.7); }
        }

        .hero h1 {
            font-size: clamp(2.4rem, 5.5vw, 4.5rem);
            font-weight: 700;
            line-height: 1.08;
            letter-spacing: -.03em;
            margin-bottom: 1.4rem;
            animation: fadeUp .6s .1s ease both;
        }

        .hero h1 em {
            font-style: normal;
            color: var(--accent);
            position: relative;
        }

        .hero-sub {
            max-width: 520px;
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--muted);
            margin-bottom: 2.5rem;
            animation: fadeUp .6s .2s ease both;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .6s .3s ease both;
        }

        .btn-hero {
            padding: .75rem 2rem;
            font-size: 1rem;
            border-radius: 10px;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 4rem;
            animation: fadeUp .6s .4s ease both;
        }
        .stat-item { text-align: center; }
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text);
        }
        .stat-label { font-size: .78rem; color: var(--muted); margin-top: .2rem; }

        /* ── Divider ── */
        .section-divider {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            margin: 0 auto;
        }

        /* ── Feed Mockup ── */
        .mockup-section {
            position: relative;
            padding: 6rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-label {
            font-family: 'Syne', sans-serif;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 700;
            letter-spacing: -.025em;
            line-height: 1.15;
            margin-bottom: 3rem;
            max-width: 500px;
        }

        .section-title span { color: var(--muted); font-weight: 400; }

        .feed-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 900px) {
            .feed-grid { grid-template-columns: 1fr; }
            .feed-sidebar { display: none; }
        }

        /* ── Debate Card ── */
        .debate-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.4rem 1.6rem;
            margin-bottom: 1rem;
            transition: border-color .2s, transform .2s;
            position: relative;
            overflow: hidden;
        }
        .debate-card:hover { border-color: #2e2e44; transform: translateY(-2px); }

        .debate-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, var(--accent), transparent);
            opacity: 0;
            transition: opacity .2s;
        }
        .debate-card:hover::before { opacity: 1; }

        .card-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }

        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: .8rem;
            flex-shrink: 0;
        }

        .card-meta { flex: 1; }
        .card-author { font-weight: 600; font-size: .88rem; color: var(--text); }
        .card-time { font-size: .75rem; color: var(--muted); }

        .card-tag {
            padding: .25rem .65rem;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 600;
            border: 1px solid;
        }

        .card-body {
            font-size: .93rem;
            line-height: 1.65;
            color: #b0b0c8;
            margin-bottom: 1.2rem;
        }
        .card-body strong { color: var(--text); font-weight: 500; }

        /* ── Vote bar ── */
        .vote-bar {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.1rem;
        }

        .vote-btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .4rem .9rem;
            border-radius: 8px;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid;
            transition: all .15s;
            font-family: 'DM Sans', sans-serif;
        }

        .vote-agree {
            background: rgba(232,255,71,.08);
            border-color: rgba(232,255,71,.2);
            color: var(--accent);
        }
        .vote-agree:hover { background: rgba(232,255,71,.15); }

        .vote-disagree {
            background: rgba(255,71,87,.08);
            border-color: rgba(255,71,87,.2);
            color: var(--red);
        }
        .vote-disagree:hover { background: rgba(255,71,87,.15); }

        .vote-progress {
            flex: 1;
            height: 5px;
            background: var(--border);
            border-radius: 100px;
            overflow: hidden;
        }
        .vote-fill {
            height: 100%;
            border-radius: 100px;
            background: linear-gradient(90deg, var(--accent), var(--red));
            opacity: .7;
        }

        .card-footer {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            color: var(--muted);
            font-size: .8rem;
        }
        .card-footer-item {
            display: flex;
            align-items: center;
            gap: .35rem;
            cursor: pointer;
            transition: color .15s;
        }
        .card-footer-item:hover { color: var(--text); }

        /* ── Sidebar ── */
        .sidebar-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.2rem 1.4rem;
            margin-bottom: 1rem;
        }

        .sidebar-title {
            font-family: 'Syne', sans-serif;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 1rem;
        }

        .trending-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6rem 0;
            border-bottom: 1px solid var(--border);
        }
        .trending-item:last-child { border-bottom: none; padding-bottom: 0; }

        .trending-num {
            font-family: 'Syne', sans-serif;
            font-size: .72rem;
            font-weight: 800;
            color: var(--accent);
            width: 18px;
            flex-shrink: 0;
        }
        .trending-text { font-size: .85rem; color: var(--text); flex: 1; line-height: 1.3; }
        .trending-count { font-size: .75rem; color: var(--muted); }

        /* ── Features ── */
        .features-section {
            padding: 6rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.8rem;
            transition: border-color .2s, transform .2s;
        }
        .feature-card:hover { border-color: #2e2e44; transform: translateY(-3px); }

        .feature-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
            font-size: 1.3rem;
        }

        .feature-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .6rem;
        }

        .feature-desc {
            font-size: .88rem;
            line-height: 1.65;
            color: var(--muted);
        }

        /* ── CTA Banner ── */
        .cta-section {
            padding: 5rem 2rem 7rem;
            text-align: center;
        }

        .cta-inner {
            max-width: 640px;
            margin: 0 auto;
        }

        .cta-inner h2 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 700;
            letter-spacing: -.025em;
            margin-bottom: 1rem;
        }

        .cta-inner p {
            color: var(--muted);
            font-size: 1rem;
            margin-bottom: 2.2rem;
        }

        /* ── Footer ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 1.8rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            color: var(--muted);
            font-size: .9rem;
        }
        .footer-brand span { color: var(--accent); }

        .footer-copy { font-size: .8rem; color: var(--muted); }

        /* ── Contact ── */
        .contact-section {
            padding: 6rem 2rem 7rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .contact-inner {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 5rem;
            align-items: start;
        }

        @media (max-width: 760px) {
            .contact-inner { grid-template-columns: 1fr; gap: 2.5rem; }
        }

        .contact-info { display: flex; flex-direction: column; gap: .75rem; }

        .contact-info-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-size: .88rem;
            color: var(--muted);
        }

        .contact-info-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
        }

        .contact-form-wrap {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-form-field {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .contact-form-field label {
            font-size: .78rem;
            font-weight: 600;
            color: var(--muted);
            letter-spacing: .04em;
            text-transform: uppercase;
            font-family: 'Syne', sans-serif;
        }

        .contact-form-field input,
        .contact-form-field textarea {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: .7rem 1rem;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            outline: none;
            resize: none;
            transition: border-color .2s;
        }

        .contact-form-field input::placeholder,
        .contact-form-field textarea::placeholder { color: var(--muted); }

        .contact-form-field input:focus,
        .contact-form-field textarea:focus {
            border-color: rgba(232,255,71,.35);
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .fade-up.visible { opacity: 1; transform: none; }
    </style>
</head>
<body class="antialiased">

    {{-- ── Navbar ── --}}
    <nav>
        <a href="/" class="brand">U<span>Debate</span></a>

        @if (Route::has('login'))
            <div class="nav-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Accedi</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrati</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- ── Hero ── --}}
    <section class="hero">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>

        <div class="hero-eyebrow">
            <span class="dot"></span>
            Il social media del confronto
        </div>

        <h1>Dibatti.<br>Argomenta.<br><em>Convinci.</em></h1>

        <p class="hero-sub">
            UDebate è il posto dove le opinioni si confrontano davvero. Pubblica la tua posizione,
            rispondi agli altri e lascia che la community giudichi.
        </p>

        <div class="hero-cta">
            @if (Route::has('register'))
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-hero">
                        Inizia a dibattere
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-hero">Ho già un account</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-hero">
                        Vai alla Dashboard
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </a>
                @endguest
            @endif
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num">12K+</div>
                <div class="stat-label">Dibattiti aperti</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">84K</div>
                <div class="stat-label">Utenti attivi</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">2.1M</div>
                <div class="stat-label">Voti espressi</div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ── Features ── --}}
    <section class="features-section">
        <div class="section-label">Come funziona</div>
        <h2 class="section-title">Come funziona <span>UDebate</span></h2>

        <div class="features-grid">
            <div class="feature-card fade-up">
                <div class="feature-icon" style="background:rgba(232,255,71,.1);">🎯</div>
                <div class="feature-title">Pubblica la tua tesi</div>
                <p class="feature-desc">Esprimi la tua posizione in modo chiaro e diretto. Argomenta il tuo punto di vista e sfida la community a contrastarti.</p>
            </div>
            <div class="feature-card fade-up" style="transition-delay:.1s">
                <div class="feature-icon" style="background:rgba(61,139,255,.1);">⚖️</div>
                <div class="feature-title">Confrontati in tempo reale</div>
                <p class="feature-desc">Rispondi alle argomentazioni degli altri, costruisci catene di ragionamento e porta prove a supporto della tua posizione.</p>
            </div>
            <div class="feature-card fade-up" style="transition-delay:.2s">
                <div class="feature-icon" style="background:rgba(255,71,87,.1);">🗳️</div>
                <div class="feature-title">Vota e decidi</div>
                <p class="feature-desc">La community vota la posizione più convincente. I voti pesano sulla reputazione: chi argomenta meglio sale in classifica.</p>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>
    
    {{-- ── Footer ── --}}
    <footer>
        <span class="footer-brand">U<span>Debate</span></span>
        <span class="footer-copy">© {{ date('Y') }} UDebate. Tutti i diritti riservati.</span>
    </footer>

    <script>
        // Scroll-triggered fade-up
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>
</body>
</html>