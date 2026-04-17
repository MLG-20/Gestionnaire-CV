<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sama CV — Créez des CV qui font la différence</title>
    <meta name="description" content="Générez des CVs professionnels en PDF en quelques clics. 10 templates premium, color picker, photo auto-recadrée.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Anti-flash : applique le thème avant le rendu -->
    <script>(function(){if(localStorage.getItem('sama-theme')==='light')document.documentElement.classList.add('light');})()</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── Background ── */
        body {
            background: #080b14;
            color: #f0f4ff;
            overflow-x: hidden;
        }

        /* ── Gradient mesh background ── */
        .mesh-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 110%, rgba(168,85,247,.14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 50%, rgba(14,165,233,.07) 0%, transparent 65%);
        }

        /* ── Navbar ── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 50;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(8,11,20,.7);
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        @media (max-width: 768px) {
            .navbar {
                padding: 0.6rem 1rem;
            }
        }
        @media (max-width: 480px) {
            .navbar {
                padding: 0.5rem 0.75rem;
            }
        }
        .logo {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -.02em;
            background: linear-gradient(135deg, #818cf8, #a78bfa, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @media (max-width: 768px) {
            .logo {
                font-size: 1.1rem;
            }
        }
        @media (max-width: 480px) {
            .logo {
                font-size: 1rem;
            }
        }
        .nav-links { display: flex; gap: 1rem; align-items: center; }
        .btn-outline {
            padding: .5rem 1.25rem;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: .5rem;
            font-size: .875rem;
            font-weight: 500;
            color: #cbd5e1;
            transition: all .2s;
            text-decoration: none;
        }
        @media (max-width: 768px) {
            .btn-outline {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
            }
        }
        @media (max-width: 480px) {
            .btn-outline {
                padding: 0.35rem 0.8rem;
                font-size: 0.75rem;
            }
        }
        .btn-outline:hover { border-color: rgba(129,140,248,.5); color: #fff; background: rgba(129,140,248,.1); }
        .btn-primary-sm {
            padding: .5rem 1.25rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: .5rem;
            font-size: .875rem;
            font-weight: 600;
            color: #fff;
            transition: all .2s;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(99,102,241,.3);
        }
        @media (max-width: 768px) {
            .btn-primary-sm {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
            }
        }
        @media (max-width: 480px) {
            .btn-primary-sm {
                padding: 0.35rem 0.8rem;
                font-size: 0.75rem;
            }
        }
        .btn-primary-sm:hover { transform: translateY(-1px); box-shadow: 0 0 30px rgba(99,102,241,.5); }

        /* ── Hero ── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 7rem 1.5rem 4rem;
            position: relative;
            z-index: 1;
        }
        @media (max-width: 768px) {
            .hero {
                padding: 6rem 1rem 3rem;
            }
        }
        @media (max-width: 480px) {
            .hero {
                padding: 5rem 1rem 2.5rem;
                min-height: auto;
            }
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .35rem .85rem;
            border-radius: 99px;
            background: rgba(99,102,241,.12);
            border: 1px solid rgba(99,102,241,.25);
            font-size: .78rem;
            font-weight: 600;
            color: #a5b4fc;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 1.75rem;
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #818cf8;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(1.4); }
        }
        .hero h1 {
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -.03em;
            margin-bottom: 1.5rem;
        }
        @media (max-width: 480px) {
            .hero h1 {
                font-size: clamp(1.8rem, 6vw, 3rem);
                margin-bottom: 1rem;
            }
        }
        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #a78bfa 40%, #38bdf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }
        @media (max-width: 480px) {
            .hero p {
                font-size: 0.9rem;
                margin: 0 auto 1.5rem;
                line-height: 1.6;
            }
        }
        .hero-cta { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        @media (max-width: 480px) {
            .hero-cta {
                flex-direction: column;
                gap: 0.75rem;
            }
            .hero-cta .btn-hero,
            .hero-cta .btn-hero-ghost {
                width: 100%;
            }
        }
        .btn-hero {
            padding: .9rem 2.25rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: .65rem;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 30px rgba(99,102,241,.4), 0 0 0 1px rgba(99,102,241,.3);
            transition: all .25s;
        }
        @media (max-width: 768px) {
            .btn-hero {
                padding: 0.75rem 1.75rem;
                font-size: 0.9rem;
            }
        }
        @media (max-width: 480px) {
            .btn-hero {
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
                width: 100%;
            }
        }
        .btn-hero:hover { transform: translateY(-2px); box-shadow: 0 8px 40px rgba(99,102,241,.55); }
        .btn-hero-ghost {
            padding: .9rem 2.25rem;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: .65rem;
            font-size: 1rem;
            font-weight: 600;
            color: #cbd5e1;
            text-decoration: none;
            transition: all .25s;
            backdrop-filter: blur(4px);
        }
        @media (max-width: 768px) {
            .btn-hero-ghost {
                padding: 0.75rem 1.75rem;
                font-size: 0.9rem;
            }
        }
        @media (max-width: 480px) {
            .btn-hero-ghost {
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
                width: 100%;
            }
        }
        .btn-hero-ghost:hover { border-color: rgba(129,140,248,.4); color: #fff; background: rgba(129,140,248,.08); }

        /* ── Mockup CV (Hero visual) ── */
        .hero-visual {
            margin-top: 4rem;
            position: relative;
            display: inline-block;
        }
        @media (max-width: 768px) {
            .hero-visual {
                margin-top: 2.5rem;
            }
        }
        @media (max-width: 480px) {
            .hero-visual {
                margin-top: 1.5rem;
            }
        }
        .cv-mockup-wrap {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .cv-card {
            background: #fff;
            border-radius: .75rem;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.5), 0 0 0 1px rgba(255,255,255,.07);
            transition: transform .3s;
        }
        .cv-card:hover { transform: translateY(-6px) scale(1.02); }
        .cv-card-main { width: 180px; }
        .cv-card-side { width: 145px; opacity: .7; margin-top: 2rem; }
        .cv-card-side2 { width: 145px; opacity: .55; margin-top: 4rem; }
        @media (max-width: 768px) {
            .cv-card-main { width: 150px; }
            .cv-card-side { width: 120px; margin-top: 1.5rem; }
            .cv-card-side2 { width: 120px; margin-top: 3rem; }
        }
        @media (max-width: 480px) {
            .cv-card-main { width: 140px; }
            .cv-card-side { width: 100px; margin-top: 1rem; }
            .cv-card-side2 { width: 100px; margin-top: 2rem; }
        }
        .cv-header-bar { height: 52px; display: flex; align-items: center; padding: 0 12px; gap: 8px; }
        .cv-avatar { width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,.25); flex-shrink: 0; }
        .cv-header-text { flex: 1; }
        .cv-name-bar { height: 6px; border-radius: 3px; background: rgba(255,255,255,.8); margin-bottom: 4px; width: 80%; }
        .cv-title-bar { height: 4px; border-radius: 2px; background: rgba(255,255,255,.5); width: 55%; }
        .cv-body { padding: 10px 12px; }
        .cv-section-label { height: 4px; border-radius: 2px; background: #e2e8f0; margin-bottom: 5px; width: 40%; }
        .cv-line { height: 3px; border-radius: 2px; background: #f1f5f9; margin-bottom: 3px; }
        .cv-line.w-full { width: 100%; }
        .cv-line.w-3-4 { width: 75%; }
        .cv-line.w-1-2 { width: 50%; }
        .cv-line.w-2-3 { width: 66%; }
        .cv-line.accent { background: #ddd6fe; }
        .cv-spacer { height: 8px; }
        .cv-skill-row { display: flex; gap: 4px; margin-bottom: 5px; }
        .cv-skill-pill { height: 8px; border-radius: 4px; flex: 1; background: #e2e8f0; }
        .cv-skill-fill { background: linear-gradient(90deg, #818cf8, #a78bfa); }

        /* ── Stats ── */
        .stats-section {
            position: relative;
            z-index: 1;
            padding: 3rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.05);
            border-bottom: 1px solid rgba(255,255,255,.05);
        }
        @media (max-width: 768px) {
            .stats-section {
                padding: 2.5rem 1rem;
            }
        }
        @media (max-width: 480px) {
            .stats-section {
                padding: 2rem 1rem;
            }
        }
        .stats-grid {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }
        .stat-value {
            font-size: 2.25rem;
            font-weight: 900;
            letter-spacing: -.03em;
            background: linear-gradient(135deg, #818cf8, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: .35rem;
        }
        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.75rem;
            }
        }
        @media (max-width: 480px) {
            .stat-value {
                font-size: 1.35rem;
            }
        }
        .stat-label { font-size: .8rem; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; }

        /* ── Sections communes ── */
        section { position: relative; z-index: 1; }
        .section-inner { max-width: 1100px; margin: 0 auto; padding: 5rem 1.5rem; }
        @media (max-width: 768px) {
            .section-inner {
                padding: 3.5rem 1rem;
            }
        }
        @media (max-width: 480px) {
            .section-inner {
                padding: 2.5rem 1rem;
            }
        }
        .section-tag {
            display: inline-block;
            padding: .3rem .75rem;
            border-radius: 99px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-bottom: 1rem;
        }
        .tag-indigo { background: rgba(99,102,241,.12); color: #a5b4fc; border: 1px solid rgba(99,102,241,.2); }
        .tag-violet { background: rgba(139,92,246,.12); color: #c4b5fd; border: 1px solid rgba(139,92,246,.2); }
        .tag-sky { background: rgba(14,165,233,.12); color: #7dd3fc; border: 1px solid rgba(14,165,233,.2); }
        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.75rem);
            font-weight: 800;
            letter-spacing: -.025em;
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        @media (max-width: 480px) {
            .section-title {
                font-size: clamp(1.4rem, 4vw, 2rem);
                margin-bottom: 0.75rem;
            }
        }
        .section-subtitle { font-size: 1.05rem; color: #64748b; max-width: 560px; line-height: 1.7; }
        @media (max-width: 768px) {
            .section-subtitle {
                font-size: 0.95rem;
                line-height: 1.6;
            }
        }
        @media (max-width: 480px) {
            .section-subtitle {
                font-size: 0.85rem;
                line-height: 1.5;
            }
        }

        /* ── Features ── */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }
        @media (max-width: 768px) { .features-grid { grid-template-columns: 1fr; } }
        .feature-card {
            padding: 1.75rem;
            border-radius: 1rem;
            background: rgba(255,255,255,.03);
            border: 1px solid rgba(255,255,255,.07);
            transition: all .3s;
        }
        @media (max-width: 768px) {
            .feature-card {
                padding: 1.5rem;
            }
        }
        @media (max-width: 480px) {
            .feature-card {
                padding: 1.25rem;
            }
        }
        .feature-card:hover {
            background: rgba(255,255,255,.055);
            border-color: rgba(129,140,248,.2);
            transform: translateY(-3px);
        }
        .feature-icon {
            width: 44px; height: 44px;
            border-radius: .75rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.1rem;
            font-size: 1.2rem;
        }
        .icon-indigo { background: rgba(99,102,241,.15); color: #818cf8; }
        .icon-violet { background: rgba(139,92,246,.15); color: #a78bfa; }
        .icon-sky { background: rgba(14,165,233,.15); color: #38bdf8; }
        .icon-emerald { background: rgba(16,185,129,.15); color: #34d399; }
        .icon-rose { background: rgba(244,63,94,.15); color: #fb7185; }
        .icon-amber { background: rgba(245,158,11,.15); color: #fbbf24; }
        .feature-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: .5rem; }
        .feature-card p { font-size: .875rem; color: #64748b; line-height: 1.65; }
        @media (max-width: 768px) {
            .feature-card h3 {
                font-size: 0.95rem;
                margin-bottom: 0.4rem;
            }
            .feature-card p {
                font-size: 0.8rem;
                line-height: 1.5;
            }
        }
        @media (max-width: 480px) {
            .feature-card h3 {
                font-size: 0.9rem;
            }
            .feature-card p {
                font-size: 0.75rem;
            }
        }

        /* ── Steps ── */
        .steps-wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3.5rem;
            position: relative;
        }
        @media (max-width: 768px) { .steps-wrap { grid-template-columns: 1fr; } }
        .steps-connector {
            position: absolute;
            top: 28px; left: calc(16.67% + 28px); right: calc(16.67% + 28px);
            height: 1px;
            background: linear-gradient(90deg, rgba(99,102,241,.4), rgba(139,92,246,.4), rgba(56,189,248,.4));
        }
        @media (max-width: 768px) { .steps-connector { display: none; } }
        .step-item { text-align: center; }
        .step-num {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0 auto 1.25rem;
            box-shadow: 0 0 24px rgba(99,102,241,.35);
        }
        @media (max-width: 768px) {
            .step-num {
                width: 48px;
                height: 48px;
                font-size: 1rem;
                margin-bottom: 1rem;
            }
        }
        @media (max-width: 480px) {
            .step-num {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
                margin-bottom: 0.75rem;
            }
        }
        .step-item h3 { font-size: 1rem; font-weight: 700; margin-bottom: .5rem; }
        .step-item p { font-size: .875rem; color: #64748b; line-height: 1.65; }

        /* ── Templates grid ── */
        .tpl-section { background: rgba(255,255,255,.015); }
        .tpl-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-top: 3rem;
        }
        @media (max-width: 768px) { .tpl-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px) { .tpl-grid { grid-template-columns: 1fr; } }
        .tpl-card {
            border-radius: .875rem;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.07);
            transition: all .3s;
            cursor: pointer;
            background: rgba(255,255,255,.025);
        }
        .tpl-card:hover { border-color: rgba(129,140,248,.3); transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,.35); }
        .tpl-preview {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        @media (max-width: 768px) {
            .tpl-preview {
                height: 120px;
            }
        }
        @media (max-width: 480px) {
            .tpl-preview {
                height: 100px;
            }
        }
        .tpl-mini { width: 80px; height: 108px; background: #fff; border-radius: 4px; box-shadow: 0 4px 20px rgba(0,0,0,.3); overflow: hidden; flex-shrink: 0; }
        @media (max-width: 768px) {
            .tpl-mini {
                width: 70px;
                height: 95px;
            }
        }
        @media (max-width: 480px) {
            .tpl-mini {
                width: 60px;
                height: 80px;
            }
        }
        .tpl-mini-header { height: 20px; }
        .tpl-mini-body { padding: 4px 5px; }
        .tpl-mini-line { height: 2px; border-radius: 1px; background: #e2e8f0; margin-bottom: 2px; }
        .tpl-mini-line.full { width: 100%; }
        .tpl-mini-line.half { width: 55%; }
        .tpl-mini-line.third { width: 35%; }
        .tpl-info { padding: .85rem 1rem; }
        .tpl-name { font-size: .9rem; font-weight: 700; margin-bottom: .15rem; }
        .tpl-style { font-size: .75rem; color: #64748b; }
        @media (max-width: 768px) {
            .tpl-name {
                font-size: 0.8rem;
            }
            .tpl-style {
                font-size: 0.65rem;
            }
        }
        @media (max-width: 480px) {
            .tpl-name {
                font-size: 0.7rem;
            }
            .tpl-style {
                font-size: 0.6rem;
            }
        }

        /* Template couleurs uniques */
        .tpl-c1 .tpl-mini-header { background: #4f46e5; }
        .tpl-c2 .tpl-mini-header { background: #0f172a; }
        .tpl-c3 .tpl-mini-header { background: #0369a1; }
        .tpl-c4 .tpl-mini-header { background: #7c3aed; }
        .tpl-c5 .tpl-mini-header { background: #059669; }
        .tpl-c6 .tpl-mini-header { background: #dc2626; }

        /* ── CTA final ── */
        .cta-section {
            padding: 6rem 1.5rem;
            text-align: center;
        }
        @media (max-width: 768px) {
            .cta-section {
                padding: 4rem 1rem;
            }
        }
        @media (max-width: 480px) {
            .cta-section {
                padding: 3rem 1rem;
            }
        }
        .cta-box {
            max-width: 680px;
            margin: 0 auto;
            padding: 3.5rem 2rem;
            border-radius: 1.5rem;
            background: linear-gradient(135deg, rgba(99,102,241,.12) 0%, rgba(139,92,246,.12) 50%, rgba(56,189,248,.08) 100%);
            border: 1px solid rgba(129,140,248,.2);
            box-shadow: 0 0 60px rgba(99,102,241,.1);
        }
        @media (max-width: 768px) {
            .cta-box {
                padding: 2.5rem 1.5rem;
            }
        }
        @media (max-width: 480px) {
            .cta-box {
                padding: 2rem 1.25rem;
            }
        }
        .cta-box h2 { font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 800; margin-bottom: 1rem; letter-spacing: -.025em; }
        .cta-box p { color: #64748b; margin-bottom: 2rem; line-height: 1.7; }
        @media (max-width: 480px) {
            .cta-box h2 {
                font-size: clamp(1.35rem, 4vw, 2rem);
                margin-bottom: 0.75rem;
            }
            .cta-box p {
                margin-bottom: 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* ── Footer ── */
        footer {
            border-top: 1px solid rgba(255,255,255,.05);
            background: rgba(255,255,255,.02);
            padding: 4rem 1.5rem 2rem;
            color: #334155;
        }
        @media (max-width: 768px) {
            footer {
                padding: 3rem 1rem 1.5rem;
            }
        }
        @media (max-width: 480px) {
            footer {
                padding: 2rem 1rem 1rem;
            }
        }
        .footer-content {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
        }
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.75rem;
            }
        }
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
        }
        @media (max-width: 480px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
        .footer-section h4 { font-size: .85rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #cbd5e1; margin-bottom: 1rem; }
        .footer-section a { display: block; font-size: .8rem; color: #64748b; text-decoration: none; margin-bottom: .6rem; transition: color .2s; }
        @media (max-width: 768px) {
            .footer-section h4 {
                font-size: 0.75rem;
                margin-bottom: 0.75rem;
            }
            .footer-section a {
                font-size: 0.75rem;
                margin-bottom: 0.5rem;
            }
        }
        .footer-section a:hover { color: #cbd5e1; }
        .footer-brand {
            grid-column: 1;
        }
        @media (max-width: 768px) {
            .footer-brand {
                grid-column: span 2;
            }
        }
        @media (max-width: 480px) {
            .footer-brand {
                grid-column: 1 / -1;
            }
        }
        .footer-logo { font-size: 1.3rem; font-weight: 800; background: linear-gradient(135deg, #818cf8, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: .8rem; display: inline-block; }
        .footer-brand p { font-size: .85rem; color: #64748b; line-height: 1.6; margin-bottom: 1.2rem; max-width: 250px; }
        @media (max-width: 768px) {
            .footer-logo {
                font-size: 1.1rem;
                margin-bottom: 0.6rem;
            }
            .footer-brand p {
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }
        }
        @media (max-width: 480px) {
            .footer-logo {
                font-size: 1rem;
            }
            .footer-brand p {
                font-size: 0.75rem;
                max-width: 100%;
            }
        }
        .footer-social { display: flex; gap: .8rem; }
        @media (max-width: 480px) {
            .footer-social {
                justify-content: center;
                gap: 0.6rem;
            }
        }
        .footer-social a {
            width: 38px; height: 38px;
            border-radius: .5rem;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            color: #cbd5e1;
            transition: all .2s;
            margin-bottom: 0;
        }
        .footer-social a:hover { background: rgba(129,140,248,.2); border-color: rgba(129,140,248,.4); color: #818cf8; }
        .footer-bottom {
            max-width: 1100px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        @media (max-width: 768px) {
            .footer-bottom {
                padding-top: 1.5rem;
                gap: 0.75rem;
                font-size: 0.85rem;
            }
        }
        @media (max-width: 480px) {
            .footer-bottom {
                flex-direction: column;
                text-align: center;
                padding-top: 1rem;
            }
        }
        .footer-bottom-left, .footer-bottom-right { display: flex; gap: 2rem; flex-wrap: wrap; align-items: center; }
        .footer-bottom a { font-size: .75rem; color: #64748b; text-decoration: none; transition: color .2s; }
        .footer-bottom a:hover { color: #cbd5e1; }
        .footer-copyright { font-size: .75rem; color: #475569; }
        html.light footer { background: rgba(99,102,241,.02); }
        html.light .footer-section h4 { color: #64748b; }
        html.light .footer-section a { color: #94a3b8; }
        html.light .footer-section a:hover { color: #334155; }
        html.light .footer-logo { background: linear-gradient(135deg, #6366f1, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        html.light .footer-brand p { color: #94a3b8; }
        html.light .footer-social a { background: rgba(0,0,0,.04); border-color: rgba(0,0,0,.08); color: #64748b; }
        html.light .footer-social a:hover { background: rgba(99,102,241,.1); border-color: rgba(99,102,241,.3); color: #6366f1; }
        html.light .footer-bottom { border-top-color: rgba(0,0,0,.05); }
        html.light .footer-bottom a { color: #94a3b8; }
        html.light .footer-bottom a:hover { color: #334155; }
        html.light .footer-copyright { color: #cbd5e1; }

        /* ── Transitions douces ── */
        body, .navbar, .feature-card, .tpl-card, .tpl-section, footer, .stats-section, .cta-box, .btn-outline {
            transition: background .3s, background-color .3s, border-color .3s, color .3s, box-shadow .3s;
        }

        /* ── Bouton toggle theme ── */
        .theme-toggle {
            width: 38px; height: 38px;
            border-radius: .5rem;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.05);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s;
            color: #94a3b8;
            flex-shrink: 0;
        }
        .theme-toggle:hover { background: rgba(255,255,255,.1); border-color: rgba(129,140,248,.3); color: #fff; }
        .icon-sun, .icon-moon { transition: opacity .2s, transform .3s; }
        html:not(.light) .icon-sun { display: none; }
        html.light .icon-moon { display: none; }

        /* ── Hamburger mobile ── */
        .nav-hamburger {
            display: none;
            width: 38px; height: 38px;
            border-radius: .5rem;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.05);
            cursor: pointer;
            align-items: center; justify-content: center;
            color: #94a3b8;
            flex-shrink: 0;
            transition: all .2s;
        }
        .nav-hamburger:hover { background: rgba(255,255,255,.1); color: #fff; }
        .nav-mobile-menu {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 100;
        }
        .nav-mobile-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.6);
            backdrop-filter: blur(4px);
        }
        .nav-mobile-panel {
            position: absolute;
            top: 0; right: 0;
            width: 280px; height: 100%;
            background: #0f1525;
            border-left: 1px solid rgba(255,255,255,.08);
            padding: 1.5rem;
            display: flex; flex-direction: column; gap: 1rem;
        }
        html.light .nav-mobile-panel { background: #fff; border-left-color: rgba(0,0,0,.08); }
        .nav-mobile-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: .5rem; }
        .nav-mobile-logo { font-size: 1.2rem; font-weight: 800; background: linear-gradient(135deg, #818cf8, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .nav-mobile-close { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; border-radius: .4rem; border: 1px solid rgba(255,255,255,.1); background: none; transition: all .2s; }
        .nav-mobile-close:hover { color: #fff; background: rgba(255,255,255,.08); }
        html.light .nav-mobile-close { border-color: rgba(0,0,0,.1); color: #64748b; }
        html.light .nav-mobile-close:hover { color: #0f172a; background: rgba(0,0,0,.05); }
        .nav-mobile-link { display: block; padding: .75rem 1rem; border-radius: .5rem; font-size: .95rem; font-weight: 600; color: #cbd5e1; text-decoration: none; border: 1px solid rgba(255,255,255,.07); transition: all .2s; }
        .nav-mobile-link:hover { background: rgba(129,140,248,.1); border-color: rgba(129,140,248,.2); color: #fff; }
        html.light .nav-mobile-link { color: #475569; border-color: rgba(0,0,0,.07); }
        html.light .nav-mobile-link:hover { color: #0f172a; background: rgba(99,102,241,.06); }
        .nav-mobile-primary { background: linear-gradient(135deg,#6366f1,#8b5cf6) !important; border-color: transparent !important; color: #fff !important; }

        @media (max-width: 600px) {
            .nav-hamburger { display: flex; }
            .nav-links-desktop { display: none; }
            .navbar { padding: .75rem 1rem; }
            .hero { padding: 5rem 1rem 3rem; }
            .cv-mockup-wrap { gap: .75rem; }
            .cv-card-side { display: none; }
            .cv-card-side2 { display: none; }
            .section-inner { padding: 3rem 1rem; }
            .stats-grid { grid-template-columns: repeat(2,1fr); gap: 1rem; }
            .features-grid { grid-template-columns: 1fr; }
            .steps-wrap { grid-template-columns: 1fr; }
            .tpl-grid { grid-template-columns: repeat(2,1fr); }
            .cta-box { padding: 2rem 1.25rem; }
        }

        /* ── Mode clair ── */
        html.light body { background: #f1f5f9; color: #0f172a; }
        html.light .mesh-bg {
            background:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 110%, rgba(168,85,247,.06) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 50%, rgba(14,165,233,.04) 0%, transparent 65%);
        }
        html.light .navbar { background: rgba(241,245,249,.88); border-bottom-color: rgba(0,0,0,.07); }
        html.light .btn-outline { border-color: rgba(0,0,0,.15); color: #475569; }
        html.light .btn-outline:hover { border-color: rgba(99,102,241,.35); color: #0f172a; background: rgba(99,102,241,.06); }
        html.light .theme-toggle { border-color: rgba(0,0,0,.12); background: rgba(0,0,0,.04); color: #475569; }
        html.light .theme-toggle:hover { background: rgba(0,0,0,.08); color: #0f172a; }
        html.light .badge { background: rgba(99,102,241,.08); border-color: rgba(99,102,241,.18); }
        html.light .hero h1 { color: #0f172a; }
        html.light .hero p { color: #475569; }
        html.light .btn-hero-ghost { border-color: rgba(0,0,0,.14); color: #475569; }
        html.light .btn-hero-ghost:hover { color: #0f172a; background: rgba(99,102,241,.06); border-color: rgba(99,102,241,.25); }
        html.light .cv-card { box-shadow: 0 8px 30px rgba(0,0,0,.12); }
        html.light .stats-section { border-color: rgba(0,0,0,.06); background: rgba(255,255,255,.5); }
        html.light .section-title { color: #0f172a; }
        html.light .section-subtitle { color: #475569; }
        html.light .feature-card { background: rgba(255,255,255,.7); border-color: rgba(0,0,0,.07); box-shadow: 0 1px 6px rgba(0,0,0,.05); }
        html.light .feature-card:hover { background: #fff; border-color: rgba(99,102,241,.2); box-shadow: 0 4px 20px rgba(99,102,241,.1); }
        html.light .feature-card h3 { color: #0f172a; }
        html.light .feature-card p { color: #64748b; }
        html.light .step-item h3 { color: #0f172a; }
        html.light .step-item p { color: #64748b; }
        html.light .tpl-section { background: rgba(255,255,255,.4); border-color: rgba(0,0,0,.05); }
        html.light .tpl-card { background: #fff; border-color: rgba(0,0,0,.08); }
        html.light .tpl-card:hover { border-color: rgba(99,102,241,.25); box-shadow: 0 8px 30px rgba(0,0,0,.1); }
        html.light .tpl-name { color: #0f172a; }
        html.light .tpl-style { color: #94a3b8; }
        html.light .cta-box { background: linear-gradient(135deg,rgba(99,102,241,.07),rgba(139,92,246,.07),rgba(56,189,248,.04)); border-color: rgba(99,102,241,.15); box-shadow: 0 0 40px rgba(99,102,241,.06); }
        html.light .cta-box h2 { color: #0f172a; }
        html.light .cta-box p { color: #64748b; }
        html.light footer { border-top-color: rgba(0,0,0,.07); color: #94a3b8; background: rgba(255,255,255,.3); }
        html.light .section-tag.tag-indigo { background: rgba(99,102,241,.08); }
        html.light .section-tag.tag-violet { background: rgba(139,92,246,.08); }
        html.light .section-tag.tag-sky { background: rgba(14,165,233,.08); }
    </style>
</head>
<body>

    <!-- Mesh background -->
    <div class="mesh-bg"></div>

    <!-- ─── Navbar ─── -->
    <nav class="navbar">
        <div class="logo">Sama CV</div>

        <!-- Liens desktop -->
        <div class="nav-links nav-links-desktop">
            <button class="theme-toggle" onclick="toggleTheme()" title="Changer le thème" aria-label="Changer le thème">
                <svg class="icon-moon" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/>
                </svg>
                <svg class="icon-sun" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="5"/><path stroke-linecap="round" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </button>
            @guest
                <a href="{{ route('login') }}" class="btn-outline">Se connecter</a>
                <a href="{{ route('register') }}" class="btn-primary-sm">Commencer — c'est gratuit</a>
            @else
                <a href="{{ route('dashboard.index') }}" class="btn-primary-sm">← Retour au dashboard</a>
            @endguest
        </div>

        <!-- Boutons mobile -->
        <div style="display:flex; gap:.5rem; align-items:center;">
            <button class="theme-toggle" onclick="toggleTheme()" title="Changer le thème" aria-label="Changer le thème" style="display:none;" id="theme-toggle-mobile">
                <svg class="icon-moon" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/>
                </svg>
                <svg class="icon-sun" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="5"/><path stroke-linecap="round" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </button>
            <button class="nav-hamburger" onclick="openMobileMenu()" aria-label="Menu" id="hamburger-btn">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- ─── Menu mobile ─── -->
    <div class="nav-mobile-menu" id="mobile-menu">
        <div class="nav-mobile-overlay" onclick="closeMobileMenu()"></div>
        <div class="nav-mobile-panel">
            <div class="nav-mobile-header">
                <span class="nav-mobile-logo">Sama CV</span>
                <button class="nav-mobile-close" onclick="closeMobileMenu()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @guest
                <a href="{{ route('login') }}" class="nav-mobile-link">Se connecter</a>
                <a href="{{ route('register') }}" class="nav-mobile-link nav-mobile-primary">Commencer — c'est gratuit</a>
            @else
                <a href="{{ route('dashboard.index') }}" class="nav-mobile-link nav-mobile-primary">← Retour au dashboard</a>
            @endguest
        </div>
    </div>

    <!-- ─── Hero ─── -->
    <section class="hero">
        <div>
            <div class="badge">
                <span class="badge-dot"></span>
                10 templates professionnels disponibles
            </div>

            <h1>
                Votre CV,<br>
                <span class="gradient-text">à votre image.</span>
            </h1>

            <p>Créez un CV professionnel en quelques minutes. Choisissez un template, personnalisez les couleurs, et téléchargez un PDF prêt à l'emploi.</p>

            <div class="hero-cta">
                @guest
                    <a href="{{ route('register') }}" class="btn-hero">Créer mon CV gratuitement</a>
                    <a href="{{ route('login') }}" class="btn-hero-ghost">Déjà un compte →</a>
                @else
                    <a href="{{ route('dashboard.index') }}" class="btn-hero">Accéder à mon dashboard →</a>
                @endguest
            </div>

            <!-- Mini CV mockups décoratifs -->
            <div class="hero-visual">
                <div class="cv-mockup-wrap">
                    <div class="cv-card cv-card-side">
                        <div class="cv-header-bar" style="background:#7c3aed;">
                            <div class="cv-avatar"></div>
                            <div class="cv-header-text">
                                <div class="cv-name-bar"></div>
                                <div class="cv-title-bar"></div>
                            </div>
                        </div>
                        <div class="cv-body">
                            <div class="cv-section-label"></div>
                            <div class="cv-line w-full"></div>
                            <div class="cv-line w-3-4"></div>
                            <div class="cv-line w-1-2"></div>
                            <div class="cv-spacer"></div>
                            <div class="cv-section-label"></div>
                            <div class="cv-skill-row"><div class="cv-skill-pill cv-skill-fill" style="flex:3"></div><div class="cv-skill-pill"></div></div>
                            <div class="cv-skill-row"><div class="cv-skill-pill cv-skill-fill" style="flex:2"></div><div class="cv-skill-pill" style="flex:2"></div></div>
                        </div>
                    </div>

                    <div class="cv-card cv-card-main">
                        <div class="cv-header-bar" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">
                            <div class="cv-avatar"></div>
                            <div class="cv-header-text">
                                <div class="cv-name-bar"></div>
                                <div class="cv-title-bar"></div>
                            </div>
                        </div>
                        <div class="cv-body">
                            <div class="cv-section-label" style="background:#ddd6fe;"></div>
                            <div class="cv-line w-full"></div>
                            <div class="cv-line w-2-3"></div>
                            <div class="cv-line w-3-4"></div>
                            <div class="cv-spacer"></div>
                            <div class="cv-section-label" style="background:#ddd6fe;"></div>
                            <div class="cv-line w-full accent"></div>
                            <div class="cv-line w-1-2 accent"></div>
                            <div class="cv-spacer"></div>
                            <div class="cv-section-label" style="background:#ddd6fe;"></div>
                            <div class="cv-skill-row">
                                <div class="cv-skill-pill cv-skill-fill" style="flex:4"></div>
                                <div class="cv-skill-pill" style="flex:1"></div>
                            </div>
                            <div class="cv-skill-row">
                                <div class="cv-skill-pill cv-skill-fill" style="flex:3"></div>
                                <div class="cv-skill-pill" style="flex:2"></div>
                            </div>
                            <div class="cv-skill-row">
                                <div class="cv-skill-pill cv-skill-fill" style="flex:5"></div>
                            </div>
                        </div>
                    </div>

                    <div class="cv-card cv-card-side2">
                        <div class="cv-header-bar" style="background:#0369a1;">
                            <div class="cv-avatar"></div>
                            <div class="cv-header-text">
                                <div class="cv-name-bar"></div>
                                <div class="cv-title-bar"></div>
                            </div>
                        </div>
                        <div class="cv-body">
                            <div class="cv-section-label"></div>
                            <div class="cv-line w-full"></div>
                            <div class="cv-line w-3-4"></div>
                            <div class="cv-spacer"></div>
                            <div class="cv-section-label"></div>
                            <div class="cv-line w-2-3"></div>
                            <div class="cv-line w-1-2"></div>
                            <div class="cv-line w-3-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Stats ─── -->
    <div class="stats-section">
        <div class="stats-grid">
            <div>
                <div class="stat-value">10</div>
                <div class="stat-label">Templates premium</div>
            </div>
            <div>
                <div class="stat-value">100%</div>
                <div class="stat-label">Gratuit</div>
            </div>
            <div>
                <div class="stat-value">PDF</div>
                <div class="stat-label">Export haute qualité</div>
            </div>
            <div>
                <div class="stat-value">A4</div>
                <div class="stat-label">Format standard</div>
            </div>
        </div>
    </div>

    <!-- ─── Features ─── -->
    <section>
        <div class="section-inner">
            <div>
                <span class="section-tag tag-indigo">Fonctionnalités</span>
                <h2 class="section-title">Tout ce qu'il vous faut,<br>rien de superflu.</h2>
                <p class="section-subtitle">Un outil pensé pour aller droit au but : un CV impeccable, en quelques minutes.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon icon-indigo">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    </div>
                    <h3>10 Templates Premium</h3>
                    <p>Classiques, modernes, créatifs, minimalistes. Un design pour chaque secteur et chaque personnalité.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-violet">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </div>
                    <h3>Couleurs Personnalisées</h3>
                    <p>Color picker intégré : adaptez les couleurs primaires et secondaires de votre CV en temps réel.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-sky">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3>Export PDF Pro</h3>
                    <p>Téléchargez votre CV en PDF haute qualité, format A4, prêt pour l'impression ou l'envoi par email.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-emerald">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3>Photo Professionnelle</h3>
                    <p>Importez votre photo — elle est automatiquement recadrée en cercle et optimisée pour le PDF.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-rose">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3>Sections Complètes</h3>
                    <p>Expériences, formations, compétences, loisirs, résumé professionnel. Tout y est, bien organisé.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-amber">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3>Aperçu Instantané</h3>
                    <p>Visualisez votre CV dans le navigateur avant de l'exporter. Ce que vous voyez, c'est ce que vous obtenez.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Comment ça marche ─── -->
    <section style="background: rgba(255,255,255,.015); border-top: 1px solid rgba(255,255,255,.05); border-bottom: 1px solid rgba(255,255,255,.05);">
        <div class="section-inner">
            <div style="text-align:center;">
                <span class="section-tag tag-violet">Comment ça marche</span>
                <h2 class="section-title">Votre CV en 3 étapes</h2>
                <p class="section-subtitle" style="margin: 0 auto;">Simple, rapide, efficace. Pas de complexité inutile.</p>
            </div>
            <div class="steps-wrap">
                <div class="steps-connector"></div>
                <div class="step-item">
                    <div class="step-num">1</div>
                    <h3>Remplissez votre profil</h3>
                    <p>Saisissez vos informations : expériences, formations, compétences, photo. Un formulaire guidé, étape par étape.</p>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <h3>Choisissez votre style</h3>
                    <p>Sélectionnez un template parmi 10 designs et personnalisez les couleurs selon vos goûts ou votre secteur.</p>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <h3>Téléchargez en PDF</h3>
                    <p>Un clic sur "Télécharger" et votre CV professionnel au format A4 est prêt à être envoyé aux recruteurs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Templates aperçu ─── -->
    <section class="tpl-section">
        <div class="section-inner">
            <div>
                <span class="section-tag tag-sky">Templates</span>
                <h2 class="section-title">Choisissez votre style</h2>
                <p class="section-subtitle">10 designs soigneusement conçus, chacun avec sa personnalité.</p>
            </div>
            <div class="tpl-grid">
                @foreach(array_slice(App\Models\CvSetting::availableTemplates(), 0, 6) as $i => $template)
                    @php $colors = ['#4f46e5','#0f172a','#0369a1','#7c3aed','#059669','#dc2626']; @endphp
                    <div class="tpl-card tpl-c{{ $i + 1 }}">
                        <div class="tpl-preview" style="background: rgba({{ $i % 2 === 0 ? '99,102,241' : '139,92,246' }},.05);">
                            <div class="tpl-mini">
                                <div class="tpl-mini-header" style="background:{{ $colors[$i] }};"></div>
                                <div class="tpl-mini-body">
                                    <div class="tpl-mini-line full" style="height:3px; background:{{ $colors[$i] }}20; margin-bottom:3px;"></div>
                                    <div class="tpl-mini-line half"></div>
                                    <div class="tpl-mini-line full" style="margin-top:4px;"></div>
                                    <div class="tpl-mini-line full"></div>
                                    <div class="tpl-mini-line third"></div>
                                    <div class="tpl-mini-line full" style="margin-top:4px;"></div>
                                    <div class="tpl-mini-line half"></div>
                                    <div class="tpl-mini-line full" style="margin-top:4px; height:3px; background:{{ $colors[$i] }}30;"></div>
                                    <div class="tpl-mini-line full"></div>
                                    <div class="tpl-mini-line third"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tpl-info">
                            <div class="tpl-name">{{ $template['name'] }}</div>
                            <div class="tpl-style">{{ $template['style'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="text-align:center; margin-top:2.5rem;">
                <a href="{{ route('register') }}" class="btn-hero" style="display:inline-block;">Voir les 10 templates →</a>
            </div>
        </div>
    </section>

    <!-- ─── CTA final ─── -->
    <section class="cta-section">
        <div class="cta-box">
            <h2>Prêt à créer votre CV ?</h2>
            <p>Créez un compte gratuit et commencez à construire un CV qui vous ressemble.</p>
            @guest
                <a href="{{ route('register') }}" class="btn-hero" style="display:inline-block;">Créer mon compte gratuitement</a>
            @else
                <a href="{{ route('dashboard.index') }}" class="btn-hero" style="display:inline-block;">Accéder à mon dashboard →</a>
            @endguest
        </div>
    </section>

    @include('components.footer')


    <script>
        function toggleTheme() {
            var html = document.documentElement;
            if (html.classList.contains('light')) {
                html.classList.remove('light');
                localStorage.setItem('sama-theme', 'dark');
            } else {
                html.classList.add('light');
                localStorage.setItem('sama-theme', 'light');
            }
        }

        function openMobileMenu() {
            var menu = document.getElementById('mobile-menu');
            menu.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMenu() {
            var menu = document.getElementById('mobile-menu');
            menu.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Sur mobile, affiche le bouton theme mobile et cache le desktop
        function syncMobileButtons() {
            var isMobile = window.innerWidth <= 600;
            var mobileToggle = document.getElementById('theme-toggle-mobile');
            var hamburger = document.getElementById('hamburger-btn');
            if (mobileToggle) mobileToggle.style.display = isMobile ? 'flex' : 'none';
            if (hamburger) hamburger.style.display = isMobile ? 'flex' : 'none';
        }
        syncMobileButtons();
        window.addEventListener('resize', syncMobileButtons);
    </script>
</body>
</html>
