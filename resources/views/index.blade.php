<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenu: false, activeSection: 'beranda' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SAPA-Sketsu — Sistem Aspirasi & Pengaduan Alumni/Siswa SMKN 1. Suarakan aspirasimu dengan aman, transparan, dan terpercaya.">
    <title>SAPA-Sketsu | Sistem Aspirasi & Pengaduan Siswa</title>

    {{-- ===== CDN Dependencies ===== --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Tailwind custom config
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 20s linear infinite',
                        'counter': 'counter 2s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-16px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* ===== Global & Typography ===== */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0a0e1a;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* ===== Glassmorphism ===== */
        .glass {
            background: rgba(15, 20, 40, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.15);
        }
        .glass-light {
            background: rgba(99, 102, 241, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(99, 102, 241, 0.12);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(79, 70, 229, 0.2);
        }

        /* ===== Gradient Text ===== */
        .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 40%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-text-gold {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fde68a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== Background Mesh ===== */
        .mesh-bg {
            background:
                radial-gradient(ellipse 80% 60% at 20% 0%, rgba(79,70,229,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 20%, rgba(99,102,241,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(67,56,202,0.10) 0%, transparent 60%),
                #0a0e1a;
        }

        /* ===== Animated Grid ===== */
        .grid-overlay {
            background-image:
                linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ===== Glow Effects ===== */
        .glow-indigo {
            box-shadow: 0 0 30px rgba(99,102,241,0.3), 0 0 60px rgba(99,102,241,0.15);
        }
        .glow-btn {
            box-shadow: 0 4px 24px rgba(79,70,229,0.5);
        }
        .glow-btn:hover {
            box-shadow: 0 8px 40px rgba(79,70,229,0.7);
        }

        /* ===== Navbar Active ===== */
        .nav-link {
            position: relative;
            transition: color 0.2s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 2px;
            background: linear-gradient(90deg, #6366f1, #818cf8);
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover { color: #a5b4fc; }

        /* ===== Step connector line ===== */
        .step-connector {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, rgba(99,102,241,0.6), rgba(99,102,241,0.1));
        }

        /* ===== Stat Counter Animation ===== */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-value {
            animation: countUp 0.8s ease forwards;
        }

        /* ===== Badge ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* ===== Scroll Progress ===== */
        #scroll-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #818cf8, #c7d2fe);
            z-index: 9999;
            transition: width 0.1s linear;
        }

        /* ===== AOS Customization ===== */
        [data-aos] { transition-duration: 700ms !important; }

        /* ===== Mobile responsiveness ===== */
        @media (max-width: 640px) {
            .hero-title { font-size: 2.2rem; line-height: 1.2; }
        }

        /* ===== FAQ Accordion ===== */
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.3s ease;
        }
        .faq-answer.open {
            max-height: 300px;
        }

        /* ===== Floating Particles ===== */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: floatParticle linear infinite;
            opacity: 0.15;
        }
        @keyframes floatParticle {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.15; }
            90% { opacity: 0.15; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }

        /* ===== Shine Effect on Cards ===== */
        .shine-card {
            position: relative;
            overflow: hidden;
        }
        .shine-card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.04), transparent);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
        }
        .shine-card:hover::before { left: 150%; }
    </style>
</head>

<body class="mesh-bg" x-init="
    AOS.init({ once: true, offset: 80, easing: 'ease-out-cubic' });
    window.addEventListener('scroll', () => {
        const el = document.getElementById('scroll-progress');
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (el) el.style.width = (scrollTop / docHeight * 100) + '%';
    });
">

    {{-- ===== Scroll Progress Bar ===== --}}
    <div id="scroll-progress"></div>

    {{-- ===== Floating Particles ===== --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="particle w-2 h-2 bg-indigo-400" style="left:10%; animation-duration:15s; animation-delay:0s;"></div>
        <div class="particle w-1 h-1 bg-indigo-300" style="left:25%; animation-duration:20s; animation-delay:3s;"></div>
        <div class="particle w-3 h-3 bg-brand-400" style="left:60%; animation-duration:18s; animation-delay:6s;"></div>
        <div class="particle w-1 h-1 bg-indigo-200" style="left:80%; animation-duration:12s; animation-delay:2s;"></div>
        <div class="particle w-2 h-2 bg-brand-300" style="left:45%; animation-duration:22s; animation-delay:8s;"></div>
    </div>

    {{-- ============================================================
         SECTION 1: NAVBAR
         ============================================================ --}}
    <nav id="navbar" class="glass fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">

                {{-- Logo --}}
                <a href="#" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center glow-indigo group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                            <path d="M8 12h8M12 8v8"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <span class="font-display font-bold text-white text-lg leading-none">SAPA</span>
                        <span class="text-indigo-400 font-bold text-lg leading-none">-Sketsu</span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="#" class="nav-link text-slate-300 font-medium text-sm">Beranda</a>
                    <a href="#alur" class="nav-link text-slate-300 font-medium text-sm">Alur</a>
                    <a href="#statistik" class="nav-link text-slate-300 font-medium text-sm">Statistik</a>
                    <a href="#faq" class="nav-link text-slate-300 font-medium text-sm">FAQ</a>
                </div>

                {{-- CTA Button --}}
                <div class="flex items-center gap-3">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-semibold rounded-xl glow-btn hover:from-indigo-500 hover:to-indigo-400 transition-all duration-300">
                                <i class="fa-solid fa-gauge-high text-xs"></i>
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-semibold rounded-xl glow-btn hover:from-indigo-500 hover:to-indigo-400 transition-all duration-300">
                                <i class="fa-solid fa-gauge-high text-xs"></i>
                                Dashboard Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-semibold rounded-xl glow-btn hover:from-indigo-500 hover:to-indigo-400 transition-all duration-300">
                            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                            Masuk ke Dashboard
                        </a>
                    @endauth

                    {{-- Mobile Hamburger --}}
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-lg glass-light text-slate-300 hover:text-white transition-colors" aria-label="Toggle menu">
                        <i class="fa-solid text-lg" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden glass border-t border-indigo-900/30">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}#beranda" @click="mobileMenu=false" class="block px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-indigo-600/20 font-medium transition-colors">
                    <i class="fa-solid fa-house mr-3 text-indigo-400"></i>Beranda
                </a>
                <a href="{{ route('home') }}#alur" @click="mobileMenu=false" class="block px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-indigo-600/20 font-medium transition-colors">
                    <i class="fa-solid fa-route mr-3 text-indigo-400"></i>Alur
                </a>
                <a href="{{ route('home') }}#statistik" @click="mobileMenu=false" class="block px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-indigo-600/20 font-medium transition-colors">
                    <i class="fa-solid fa-chart-bar mr-3 text-indigo-400"></i>Statistik
                </a>
                <a href="{{ route('home') }}#faq" @click="mobileMenu=false" class="block px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-indigo-600/20 font-medium transition-colors">
                    <i class="fa-solid fa-circle-question mr-3 text-indigo-400"></i>FAQ
                </a>
                <div class="pt-2 border-t border-indigo-900/30">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-semibold rounded-xl transition-all">
                                <i class="fa-solid fa-gauge-high"></i>
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-semibold rounded-xl transition-all">
                                <i class="fa-solid fa-gauge-high"></i>
                                Dashboard Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-semibold rounded-xl transition-all">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Masuk ke Dashboard
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    {{-- ============================================================
         SECTION 2: HERO SECTION
         ============================================================ --}}
    <section id="beranda" class="relative min-h-screen flex items-center pt-20 pb-16 grid-overlay overflow-hidden">

        {{-- Background decorative blobs --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-indigo-500/8 rounded-full blur-3xl pointer-events-none animate-pulse-slow" style="animation-delay:2s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left Content --}}
                <div class="text-center lg:text-left">

                    {{-- Trust Badge --}}
                    <div data-aos="fade-down" data-aos-delay="100" class="inline-flex mb-6">
                        <span class="badge glass-light text-indigo-300 border border-indigo-500/30">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Sistem Aman & Terpercaya SMKN 1 Sketsu
                        </span>
                    </div>

                    {{-- Headline --}}
                    <h1 data-aos="fade-up" data-aos-delay="150" class="font-display font-bold text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-4 hero-title">
                        Suarakan<br>
                        <span class="gradient-text">Aspirasimu</span><br>
                        dengan Aman
                    </h1>

                    {{-- Sub-headline --}}
                    <p data-aos="fade-up" data-aos-delay="250" class="text-slate-400 text-lg sm:text-xl leading-relaxed mb-3 max-w-xl mx-auto lg:mx-0">
                        Platform pengaduan &amp; aspirasi resmi SMKN 1 Sketsu. Identitasmu
                        <span class="text-indigo-300 font-semibold">100% terlindungi</span>,
                        laporan ditindaklanjuti secara transparan dan nyata.
                    </p>

                    {{-- Security note --}}
                    <div data-aos="fade-up" data-aos-delay="320" class="flex flex-wrap items-center gap-4 mb-8 justify-center lg:justify-start">
                        <div class="flex items-center gap-2 text-sm text-slate-400">
                            <i class="fa-solid fa-shield-halved text-green-400"></i>
                            <span>Data Terenkripsi</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-400">
                            <i class="fa-solid fa-eye-slash text-indigo-400"></i>
                            <span>Opsi Anonim</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-400">
                            <i class="fa-solid fa-clock-rotate-left text-amber-400"></i>
                            <span>Respon &lt; 3 Hari</span>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div data-aos="fade-up" data-aos-delay="400" class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @auth
                            <a href="{{ route('user.reports') }}" class="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold text-base rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                                <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform duration-200"></i>
                                Buat Laporan Sekarang
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold text-base rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                                <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform duration-200"></i>
                                Buat Laporan Sekarang
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        @endauth
                        <a href="{{ route('home') }}#alur" class="inline-flex items-center justify-center gap-2.5 px-7 py-4 glass-light text-indigo-300 font-semibold text-base rounded-2xl hover:bg-indigo-600/15 transition-all duration-300 border border-indigo-500/20">
                            <i class="fa-solid fa-circle-play"></i>
                            Lihat Cara Kerja
                        </a>
                    </div>
                </div>

                {{-- Right SVG Illustration --}}
                <div data-aos="fade-left" data-aos-delay="300" class="hidden lg:flex items-center justify-center relative">

                    {{-- Outer rotating ring --}}
                    <div class="absolute w-80 h-80 border border-indigo-500/10 rounded-full animate-spin-slow"></div>
                    <div class="absolute w-64 h-64 border border-indigo-400/8 rounded-full" style="animation: spin 30s linear infinite reverse;"></div>

                    {{-- Main Illustration Card --}}
                    <div class="relative w-72 h-72 glass-card rounded-3xl p-6 flex flex-col items-center justify-center glow-indigo">

                        {{-- Shield SVG Icon --}}
                        <svg class="w-24 h-24 mb-4 animate-float" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="shieldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#6366f1"/>
                                    <stop offset="100%" style="stop-color:#4338ca"/>
                                </linearGradient>
                            </defs>
                            <path d="M50 8 L80 20 L80 50 C80 68 65 82 50 88 C35 82 20 68 20 50 L20 20 Z" fill="url(#shieldGrad)" opacity="0.9"/>
                            <path d="M50 15 L73 25 L73 50 C73 64 61 76 50 81 C39 76 27 64 27 50 L27 25 Z" fill="none" stroke="rgba(165,180,252,0.4)" stroke-width="1.5"/>
                            <path d="M38 50 L46 58 L62 42" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <p class="text-white font-display font-bold text-xl text-center">Identitas Aman</p>
                        <p class="text-indigo-300 text-sm text-center mt-1">Anonimitas dijamin sistem</p>

                        {{-- Floating mini cards --}}
                        <div class="absolute -top-4 -right-4 glass-light rounded-xl px-3 py-2 text-xs font-semibold text-green-300 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Live Monitoring
                        </div>
                        <div class="absolute -bottom-4 -left-4 glass-light rounded-xl px-3 py-2 text-xs font-semibold text-amber-300 flex items-center gap-2">
                            <i class="fa-solid fa-bolt text-amber-400"></i>
                            Respon Cepat
                        </div>
                    </div>
                </div>

            </div>

            {{-- Scroll indicator --}}
            <div class="flex justify-center mt-16 lg:mt-20">
                <a href="{{ route('home') }}#statistik" class="flex flex-col items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors group">
                    <span class="text-xs font-medium tracking-widest uppercase">Scroll</span>
                    <div class="w-6 h-10 rounded-full border border-slate-600 group-hover:border-indigo-500 flex items-start justify-center p-1.5 transition-colors">
                        <div class="w-1.5 h-3 bg-indigo-500 rounded-full animate-bounce"></div>
                    </div>
                </a>
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 3: STATISTIK
         ============================================================ --}}
    <section id="statistik" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="badge glass-light text-indigo-300 mb-4">
                    <i class="fa-solid fa-chart-simple"></i>
                    Data Real-Time
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white">
                    Transparansi <span class="gradient-text">Terukur</span>
                </h2>
                <p class="text-slate-400 mt-3 max-w-lg mx-auto">Setiap laporan terpantau dan ditindaklanjuti. Ini adalah bukti komitmen kami.</p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Card 1: Total Laporan --}}
                <div class="glass-card shine-card rounded-2xl p-7 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-indigo-600/20 rounded-2xl flex items-center justify-center mx-auto mb-5 border border-indigo-500/20">
                        <i class="fa-solid fa-file-lines text-2xl text-indigo-400"></i>
                    </div>
                    <div class="stat-value font-display font-bold text-4xl sm:text-5xl text-white mb-2">
                        {{ $totalLaporan ?? '247' }}
                    </div>
                    <div class="text-indigo-300 font-semibold text-sm uppercase tracking-wider mb-1">Total Laporan</div>
                    <div class="text-slate-500 text-xs">Sejak sistem diluncurkan</div>
                    <div class="mt-4 h-1 w-full bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full w-full bg-gradient-to-r from-indigo-600 to-indigo-400 rounded-full"></div>
                    </div>
                </div>

                {{-- Card 2: Laporan Diproses --}}
                <div class="glass-card shine-card rounded-2xl p-7 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-amber-500/15 rounded-2xl flex items-center justify-center mx-auto mb-5 border border-amber-500/20">
                        <i class="fa-solid fa-spinner text-2xl text-amber-400 fa-spin-pulse"></i>
                    </div>
                    <div class="stat-value font-display font-bold text-4xl sm:text-5xl text-white mb-2">
                        {{ $diproses ?? '38' }}
                    </div>
                    <div class="text-amber-300 font-semibold text-sm uppercase tracking-wider mb-1">Sedang Diproses</div>
                    <div class="text-slate-500 text-xs">Dalam penanganan aktif</div>
                    <div class="mt-4 h-1 w-full bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-600 to-amber-400 rounded-full" style="width: {{ isset($diproses) && isset($totalLaporan) && $totalLaporan > 0 ? ($diproses/$totalLaporan*100) : 15 }}%"></div>
                    </div>
                </div>

                {{-- Card 3: Laporan Selesai --}}
                <div class="glass-card shine-card rounded-2xl p-7 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-emerald-500/15 rounded-2xl flex items-center justify-center mx-auto mb-5 border border-emerald-500/20">
                        <i class="fa-solid fa-circle-check text-2xl text-emerald-400"></i>
                    </div>
                    <div class="stat-value font-display font-bold text-4xl sm:text-5xl text-white mb-2">
                        {{ $selesai ?? '189' }}
                    </div>
                    <div class="text-emerald-300 font-semibold text-sm uppercase tracking-wider mb-1">Laporan Selesai</div>
                    <div class="text-slate-500 text-xs">Berhasil ditindaklanjuti</div>
                    <div class="mt-4 h-1 w-full bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full" style="width: {{ isset($selesai) && isset($totalLaporan) && $totalLaporan > 0 ? ($selesai/$totalLaporan*100) : 76 }}%"></div>
                    </div>
                </div>

            </div>

            {{-- Trust Line --}}
            <p class="text-center text-slate-500 text-sm mt-8" data-aos="fade-up" data-aos-delay="400">
                <i class="fa-solid fa-lock-open text-indigo-500 mr-2"></i>
                Data diperbarui secara otomatis setiap hari. Terakhir update: <span class="text-slate-400">{{ now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</span>
            </p>

        </div>
    </section>


    {{-- ============================================================
         SECTION 4: ALUR STEP-BY-STEP
         ============================================================ --}}
    <section id="alur" class="py-20 relative">

        {{-- Decorative background --}}
        <div class="absolute inset-0 grid-overlay opacity-30 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Section Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="badge glass-light text-indigo-300 mb-4">
                    <i class="fa-solid fa-route"></i>
                    Alur Pengaduan
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white">
                    Mudah &amp; <span class="gradient-text">Transparan</span>
                </h2>
                <p class="text-slate-400 mt-3 max-w-lg mx-auto">4 langkah sederhana dari pengaduan hingga penyelesaian masalah.</p>
            </div>

            {{-- Desktop Step: Horizontal --}}
            <div class="hidden md:flex items-start gap-0 relative">
                @php
                    $steps = [
                        ['num'=>'01', 'icon'=>'fa-pen-to-square', 'color'=>'indigo', 'title'=>'Tulis Laporan', 'desc'=>'Sampaikan aspirasimu dengan jelas. Kamu bisa memilih untuk tetap anonim.'],
                        ['num'=>'02', 'icon'=>'fa-shield-check', 'color'=>'blue', 'title'=>'Verifikasi', 'desc'=>'Tim kami memverifikasi laporan untuk memastikan kelengkapan data dalam 1×24 jam.'],
                        ['num'=>'03', 'icon'=>'fa-users-gear', 'color'=>'violet', 'title'=>'Tindak Lanjut', 'desc'=>'Guru atau pihak berwenang menangani dan merespons laporan secara langsung.'],
                        ['num'=>'04', 'icon'=>'fa-circle-check', 'color'=>'emerald', 'title'=>'Selesai', 'desc'=>'Laporan ditandai selesai. Kamu mendapat notifikasi dan bisa memberikan feedback.'],
                    ];
                @endphp

                @foreach($steps as $i => $step)
                    <div class="flex-1 flex flex-col items-center text-center relative" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 120) }}">

                        {{-- Connector line --}}
                        @if($i < count($steps)-1)
                        <div class="absolute top-8 left-1/2 w-full h-px bg-gradient-to-r from-indigo-500/40 to-transparent z-0" style="left: 50%; width: 100%;"></div>
                        @endif

                        {{-- Step Circle --}}
                        <div class="relative z-10 w-16 h-16 rounded-2xl flex items-center justify-center mb-5 border border-{{ $step['color'] }}-500/30 bg-{{ $step['color'] }}-600/15">
                            <i class="fa-solid {{ $step['icon'] }} text-xl text-{{ $step['color'] }}-400"></i>
                            <span class="absolute -top-2 -right-2 w-6 h-6 bg-indigo-600 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $step['num'] }}</span>
                        </div>

                        <h3 class="font-display font-bold text-white text-lg mb-2">{{ $step['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed px-3">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Mobile Step: Vertical --}}
            <div class="md:hidden space-y-4">
                @foreach($steps as $i => $step)
                <div class="flex items-start gap-4" data-aos="fade-right" data-aos-delay="{{ 100 + ($i * 100) }}">
                    {{-- Vertical connector --}}
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 border border-{{ $step['color'] }}-500/30 bg-{{ $step['color'] }}-600/15 relative">
                            <i class="fa-solid {{ $step['icon'] }} text-{{ $step['color'] }}-400"></i>
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-indigo-600 text-white text-xs font-bold rounded-full flex items-center justify-center leading-none">{{ $i+1 }}</span>
                        </div>
                        @if($i < count($steps)-1)
                        <div class="w-px h-8 bg-gradient-to-b from-indigo-500/40 to-transparent mt-2"></div>
                        @endif
                    </div>
                    <div class="pb-4">
                        <h3 class="font-display font-bold text-white text-base mb-1">{{ $step['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- CTA after alur --}}
            <div class="text-center mt-14" data-aos="fade-up">
                @auth
                    <a href="{{ route('user.reports') }}" class="inline-flex items-center gap-2.5 px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                        <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform"></i>
                        Mulai Buat Laporan
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                        <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform"></i>
                        Mulai Buat Laporan
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @endauth
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 5: FITUR / KEUNGGULAN
         ============================================================ --}}
    <section id="fitur" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="badge glass-light text-indigo-300 mb-4">
                    <i class="fa-solid fa-star"></i>
                    Keunggulan Platform
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white">
                    Mengapa <span class="gradient-text">SAPA-Sketsu</span>?
                </h2>
                <p class="text-slate-400 mt-3 max-w-lg mx-auto">Dirancang khusus untuk kebutuhan siswa dan alumni SMKN 1 Sketsu.</p>
            </div>

            {{-- Feature Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Feature 1: Identitas Terlindungi --}}
                <div class="glass-card shine-card rounded-2xl p-7 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-indigo-600/15 rounded-2xl flex items-center justify-center mb-6 border border-indigo-500/20 group-hover:bg-indigo-600/25 transition-colors">
                        <svg class="w-7 h-7 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 2L3 7v5c0 5.25 3.75 10.15 9 11.25C17.25 22.15 21 17.25 21 12V7L12 2z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-white text-xl mb-3">Identitas Terlindungi</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Sistem mendukung pelaporan anonim sepenuhnya. Data pribadimu tidak pernah dibagikan kepada pihak lain tanpa persetujuanmu.</p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Enkripsi end-to-end
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Mode anonim tersedia
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Data tidak dijual / dibagikan
                        </li>
                    </ul>
                </div>

                {{-- Feature 2: Respon Cepat Guru --}}
                <div class="glass-card shine-card rounded-2xl p-7 group relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    {{-- Popular badge --}}
                    <div class="absolute top-4 right-4">
                        <span class="badge bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 text-xs">
                            <i class="fa-solid fa-fire text-amber-400"></i>
                            Populer
                        </span>
                    </div>
                    <div class="w-14 h-14 bg-amber-500/15 rounded-2xl flex items-center justify-center mb-6 border border-amber-500/20 group-hover:bg-amber-500/25 transition-colors">
                        <svg class="w-7 h-7 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 22c5.5 0 10-4.5 10-10S17.5 2 12 2 2 6.5 2 12s4.5 10 10 10z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-white text-xl mb-3">Respon Cepat Guru</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Guru dan staf sekolah menerima notifikasi real-time. Setiap laporan dijamin mendapat respons dalam waktu 1–3 hari kerja.</p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Notifikasi otomatis ke guru
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            SLA respon 1–3 hari kerja
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Eskalasi otomatis jika terlambat
                        </li>
                    </ul>
                </div>

                {{-- Feature 3: Pantau Real-time --}}
                <div class="glass-card shine-card rounded-2xl p-7 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-emerald-500/15 rounded-2xl flex items-center justify-center mb-6 border border-emerald-500/20 group-hover:bg-emerald-500/25 transition-colors">
                        <svg class="w-7 h-7 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M2 12h3m14 0h3M12 2v3m0 14v3"/>
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M5.6 5.6l2.1 2.1m8.6 8.6l2.1 2.1M5.6 18.4l2.1-2.1m8.6-8.6l2.1-2.1"/>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-white text-xl mb-3">Pantau Real-time</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Lacak status laporanmu secara langsung dari dashboard. Tidak ada lagi laporan yang "hilang" atau tidak diketahui progresnya.</p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Dashboard status real-time
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Riwayat lengkap laporan
                        </li>
                        <li class="flex items-center gap-2 text-xs text-slate-400">
                            <i class="fa-solid fa-check text-emerald-400 flex-shrink-0"></i>
                            Notifikasi update status
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 6: FAQ
         ============================================================ --}}
    <section id="faq" class="py-20 relative" x-data="{ open: null }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="badge glass-light text-indigo-300 mb-4">
                    <i class="fa-solid fa-circle-question"></i>
                    FAQ
                </span>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-white">
                    Pertanyaan <span class="gradient-text">Umum</span>
                </h2>
                <p class="text-slate-400 mt-3">Jawaban atas hal-hal yang paling sering ditanyakan.</p>
            </div>

            {{-- FAQ Items --}}
            @php
                $faqs = [
                    ['q'=>'Apakah identitasku benar-benar aman?', 'a'=>'Ya, 100%. Sistem kami menggunakan enkripsi tingkat tinggi. Jika kamu memilih mode anonim, bahkan admin pun tidak bisa mengetahui identitasmu. Data tidak pernah dibagikan ke pihak ketiga.'],
                    ['q'=>'Siapa yang bisa menggunakan SAPA-Sketsu?', 'a'=>'Seluruh siswa aktif dan alumni SMKN 1 Sketsu. Kamu cukup mendaftar menggunakan email sekolah atau NIS untuk mengakses semua fitur.'],
                    ['q'=>'Berapa lama laporan saya akan ditanggapi?', 'a'=>'Kami berkomitmen memberikan respons pertama dalam 1×24 jam di hari kerja. Proses penyelesaian penuh umumnya membutuhkan 3–7 hari kerja, tergantung kompleksitas laporan.'],
                    ['q'=>'Jenis laporan apa saja yang bisa saya buat?', 'a'=>'Kamu bisa melaporkan: aspirasi dan saran pengembangan sekolah, pengaduan fasilitas, keluhan akademik, laporan kekerasan atau perundungan (bullying), dan berbagai isu sekolah lainnya.'],
                    ['q'=>'Bagaimana cara saya memantau status laporan?', 'a'=>'Setelah membuat laporan, kamu akan mendapat kode unik tracking. Login ke dashboard dan masukkan kode tersebut untuk melihat status terkini secara real-time.'],
                ];
            @endphp

            <div class="space-y-3">
                @foreach($faqs as $i => $faq)
                <div class="glass-card rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 80) }}">
                    <button
                        @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                        class="w-full flex items-center justify-between gap-4 p-5 text-left hover:bg-indigo-600/5 transition-colors cursor-pointer"
                    >
                        <span class="font-semibold text-white text-sm sm:text-base">{{ $faq['q'] }}</span>
                        <i class="fa-solid fa-chevron-down text-indigo-400 flex-shrink-0 transition-transform duration-300" :class="open === {{ $i }} ? 'rotate-180' : ''"></i>
                    </button>
                    <div
                        x-show="open === {{ $i }}"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="px-5 pb-5"
                    >
                        <div class="h-px bg-indigo-900/40 mb-4"></div>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 7: CTA BANNER
         ============================================================ --}}
    <section class="py-16 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-3xl p-8 sm:p-12 text-center relative overflow-hidden" data-aos="zoom-in">

                {{-- Background glow --}}
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent pointer-events-none"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="inline-flex mb-4">
                        <span class="badge glass-light text-indigo-300">
                            <i class="fa-solid fa-megaphone"></i>
                            Suaramu Penting
                        </span>
                    </div>
                    <h2 class="font-display font-bold text-3xl sm:text-4xl text-white mb-4">
                        Siap Menyuarakan <span class="gradient-text">Aspirasimu</span>?
                    </h2>
                    <p class="text-slate-400 text-lg mb-8 max-w-xl mx-auto">
                        Bergabunglah dengan ratusan siswa yang sudah mempercayai SAPA-Sketsu. Perubahan dimulai dari satu langkah.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('user.reports') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                                <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform"></i>
                                Buat Laporan Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold rounded-2xl glow-btn hover:from-indigo-500 hover:to-brand-400 transition-all duration-300 group">
                                <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform"></i>
                                Buat Laporan Sekarang
                            </a>
                        @endauth
                        @auth
                            @if(Auth::user()->role === 'user')
                                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 glass-light text-indigo-300 font-semibold rounded-2xl hover:bg-indigo-600/15 transition-all border border-indigo-500/20">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    Cek Status Laporan
                                </a>
                            @elseif(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 glass-light text-indigo-300 font-semibold rounded-2xl hover:bg-indigo-600/15 transition-all border border-indigo-500/20">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    Dashboard Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 glass-light text-indigo-300 font-semibold rounded-2xl hover:bg-indigo-600/15 transition-all border border-indigo-500/20">
                                <i class="fa-solid fa-user-check"></i>
                                Cek Status Laporan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 8: FOOTER
         ============================================================ --}}
    <footer class="border-t border-indigo-900/30 py-12 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">

                {{-- Brand Info --}}
                <div class="col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                <path d="M8 12h8M12 8v8"/>
                            </svg>
                        </div>
                        <span class="font-display font-bold text-white text-xl">SAPA<span class="text-indigo-400">-Sketsu</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-5">
                        Sistem Aspirasi &amp; Pengaduan Alumni/Siswa SMKN 1 Sketsu. Platform resmi untuk menyampaikan aspirasi dan pengaduan secara aman dan transparan.
                    </p>

                    {{-- Social Media --}}
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-9 h-9 glass-light rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600/30 transition-all cursor-pointer" aria-label="Instagram">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 glass-light rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-sky-600/30 transition-all cursor-pointer" aria-label="Twitter">
                            <i class="fa-brands fa-x-twitter text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 glass-light rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600/30 transition-all cursor-pointer" aria-label="Facebook">
                            <i class="fa-brands fa-facebook text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 glass-light rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-green-600/30 transition-all cursor-pointer" aria-label="YouTube">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-sm uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}#beranda" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Beranda</a></li>
                        <li><a href="{{ route('home') }}#alur" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Alur Pengaduan</a></li>
                        <li><a href="{{ route('home') }}#statistik" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Statistik</a></li>
                        <li><a href="{{ route('home') }}#faq" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>FAQ</a></li>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Dashboard Admin</a></li>
                            @else
                                <li><a href="{{ route('user.dashboard') }}" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Dashboard Saya</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-indigo-300 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-xs text-indigo-600"></i>Masuk ke Dashboard</a></li>
                        @endauth
                    </ul>
                </div>

                {{-- Contact / Address --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-sm uppercase tracking-wider">Kontak Sekolah</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-sm text-slate-400">
                            <i class="fa-solid fa-location-dot text-indigo-400 mt-0.5 flex-shrink-0"></i>
                            <span>Jl. Raya Sketsu No. 1, Bangil,<br>Pasuruan, Jawa Timur 67153</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-400">
                            <i class="fa-solid fa-phone text-indigo-400 flex-shrink-0"></i>
                            <a href="tel:+6234123456" class="hover:text-indigo-300 transition-colors">(0343) 123-456</a>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-400">
                            <i class="fa-solid fa-envelope text-indigo-400 flex-shrink-0"></i>
                            <a href="mailto:info@smkn1sketsu.sch.id" class="hover:text-indigo-300 transition-colors">info@smkn1sketsu.sch.id</a>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-400">
                            <i class="fa-solid fa-globe text-indigo-400 flex-shrink-0"></i>
                            <a href="https://smkn1sketsu.sch.id" target="_blank" class="hover:text-indigo-300 transition-colors">smkn1sketsu.sch.id</a>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Bottom bar --}}
            <div class="border-t border-indigo-900/30 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-slate-500 text-xs text-center sm:text-left">
                    &copy; {{ date('Y') }} <span class="text-slate-400 font-medium">SMKN 1 Sketsu</span> — SAPA-Sketsu. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-4 text-xs text-slate-500">
                    <a href="#" class="hover:text-indigo-400 transition-colors">Kebijakan Privasi</a>
                    <span class="text-slate-700">•</span>
                    <a href="#" class="hover:text-indigo-400 transition-colors">Syarat Penggunaan</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ===== Back to Top Button ===== --}}
    <button
        x-data="{ show: false }"
        x-init="window.addEventListener('scroll', () => show = window.scrollY > 400)"
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-6 right-6 z-50 w-11 h-11 glass rounded-xl flex items-center justify-center text-indigo-400 hover:text-white hover:bg-indigo-600/40 transition-all glow-indigo cursor-pointer border border-indigo-500/20"
        aria-label="Kembali ke atas"
    >
        <i class="fa-solid fa-chevron-up text-sm"></i>
    </button>

    {{-- ===== Scripts ===== --}}
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    const offset = 80; // navbar height
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top, behavior: 'smooth' });
                }
            });
        });

        // Active nav link on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => {
                if (window.scrollY >= s.offsetTop - 120) current = s.getAttribute('id');
            });
            navLinks.forEach(link => {
                if(link.getAttribute('href')) {
                    link.classList.toggle('active', link.getAttribute('href') === '#' + current);
                }
            });
        });
    </script>

</body>
</html>