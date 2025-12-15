<!DOCTYPE html>
@php
    $currentLocale = app()->getLocale() ?: 'ar';
    $isRTL = $currentLocale === 'ar';
@endphp
<html lang="{{ $currentLocale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Evenza - Event Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @if($isRTL)
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if($isRTL)
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @endif
    <style>
        :root {
            --primary: {{ config('theme.colors.primary', '#1e40af') }};
            --primary-dark: {{ config('theme.colors.primary_dark', '#1e3a8a') }};
            --secondary: {{ config('theme.colors.secondary', '#059669') }};
            --dark: {{ config('theme.colors.dark', '#0f172a') }};
            --dark-light: {{ config('theme.colors.dark_light', '#1e293b') }};
            --gradient-primary-from: {{ config('theme.gradients.primary.from', '#1e40af') }};
            --gradient-primary-to: {{ config('theme.gradients.primary.to', '#3b82f6') }};
            --gradient-hero-from: {{ config('theme.gradients.hero.from', '#0f172a') }};
            --gradient-hero-to: {{ config('theme.gradients.hero.to', '#1e293b') }};
        }
        body {
            font-family: {{ $isRTL ? "'Cairo', sans-serif" : "'Inter', sans-serif" }};
        }
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        [dir="rtl"] .navbar-nav {
            margin-right: auto;
            margin-left: 0;
        }
        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }
        [dir="rtl"] .me-1, [dir="rtl"] .me-2, [dir="rtl"] .me-3 {
            margin-right: 0 !important;
            margin-left: 0.25rem !important;
        }
        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
        }
        [dir="rtl"] .me-3 {
            margin-left: 1rem !important;
        }
        [dir="rtl"] .ms-1, [dir="rtl"] .ms-2, [dir="rtl"] .ms-3 {
            margin-left: 0 !important;
            margin-right: 0.25rem !important;
        }
        [dir="rtl"] .ms-2 {
            margin-right: 0.5rem !important;
        }
        [dir="rtl"] .ms-3 {
            margin-right: 1rem !important;
        }
        [dir="rtl"] .text-end {
            text-align: left !important;
        }
        [dir="rtl"] .text-start {
            text-align: right !important;
        }
        [dir="rtl"] .end-0 {
            left: 0 !important;
            right: auto !important;
        }
        [dir="rtl"] .start-0 {
            right: 0 !important;
            left: auto !important;
        }
        [dir="rtl"] .schedule-item {
            border-left: none;
            border-right: 3px solid var(--primary);
            padding-left: 0;
            padding-right: 1.5rem;
        }
        .navbar { background: transparent; transition: all 0.3s; }
        .navbar.scrolled { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .navbar-brand img,
        .navbar-brand-logo {
            max-height: 40px;
            max-width: 150px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }
        .footer-logo {
            max-height: 50px;
            max-width: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .nav-link { font-weight: 500; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-secondary { background: var(--secondary); border-color: var(--secondary); }
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></svg>');
            background-size: 100px 100px;
        }
        .section-title { font-weight: 700; margin-bottom: 1rem; }
        .section-subtitle { color: var(--primary); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem; }
        .card-speaker { border: none; border-radius: 1rem; overflow: hidden; transition: transform 0.3s; }
        .card-speaker:hover { transform: translateY(-10px); }
        .card-speaker img { height: 300px; object-fit: cover; }
        .card-event { border: none; border-radius: 1rem; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .card-event img { height: 200px; object-fit: cover; }
        .pricing-card { border: none; border-radius: 1rem; padding: 2rem; text-align: center; transition: all 0.3s; }
        .pricing-card.featured { background: var(--primary); color: #fff; transform: scale(1.05); }
        .pricing-card:not(.featured) { background: #fff; box-shadow: 0 5px 30px rgba(0,0,0,0.1); }
        .testimonial-card { background: #fff; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .schedule-item { border-left: 3px solid var(--primary); padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .footer { background: var(--dark); color: #fff; padding: 4rem 0 2rem; }
        .footer a { color: rgba(255,255,255,0.7); text-decoration: none; }
        .footer a:hover { color: #fff; }
        .bg-gradient-primary { background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%); }
        .stats-section { background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%); padding: 4rem 0; }
        .stat-item { text-align: center; color: #fff; }
        .stat-item h2 { font-size: 3rem; font-weight: 800; }
        .gallery-item { position: relative; overflow: hidden; border-radius: 0.75rem; }
        .gallery-item img { transition: transform 0.3s; }
        .gallery-item:hover img { transform: scale(1.1); }
        .faq-item { border: none; margin-bottom: 1rem; }
        .faq-item .accordion-button { background: #f8f9fa; font-weight: 600; }
        .faq-item .accordion-button:not(.collapsed) { background: var(--primary); color: #fff; }
        .sponsor-logo { filter: grayscale(100%); opacity: 0.7; transition: all 0.3s; }
        .sponsor-logo:hover { filter: grayscale(0%); opacity: 1; }
        .page-header { background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%); padding: 8rem 0 4rem; color: #fff; }
    </style>
    @stack('styles')
</head>
<body>
    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                navbar.classList.remove('navbar-dark');
                navbar.classList.add('navbar-light');
            } else {
                navbar.classList.remove('scrolled');
                navbar.classList.add('navbar-dark');
                navbar.classList.remove('navbar-light');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
