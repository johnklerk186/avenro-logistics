<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $__env->yieldContent('meta_description', 'Avenro Logistics — international freight, express shipping, warehousing and tracked door-to-door logistics solutions.') }}">
    <meta property="og:title" content="{{ $__env->yieldContent('title', 'Avenro Logistics') }}">
    <meta property="og:description" content="{{ $__env->yieldContent('meta_description', 'Avenro Logistics — international freight, express shipping, warehousing and tracked door-to-door logistics solutions.') }}">
    <meta property="og:type" content="website">
    <title>@yield('title', 'Avenro Logistics — Global Shipping & Logistics')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            950: '#071527',
                            900: '#0B1F3D',
                            800: '#12305C',
                            700: '#1B4470',
                            600: '#25548C',
                        },
                        gold: {
                            300: '#E9D8A6',
                            400: '#DDBE7E',
                            500: '#C6A15B',
                            600: '#A8842F',
                            700: '#8A6A24',
                        },
                        ink: '#101828',
                        mist: '#F4F6F9',
                        line: '#E4E7EC',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -12px rgba(11,31,61,0.18)',
                        'lift': '0 20px 50px -12px rgba(11,31,61,0.25)',
                    },
                }
            }
        }
    </script>

    <style>
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: #101828;
            background-color: #FFFFFF;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Sora', sans-serif;
        }
        .avenro-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: #C6A15B;
            color: #0B1F3D;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 0.9rem 2rem;
            border-radius: 0.5rem;
            transition: all 0.25s ease;
            text-decoration: none;
        }
        .avenro-btn:hover {
            background-color: #A8842F;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(168,132,47,0.5);
        }
        .avenro-btn-navy {
            background-color: #0B1F3D;
            color: #FFFFFF;
        }
        .avenro-btn-navy:hover {
            background-color: #12305C;
            color: #E9D8A6;
        }
        .avenro-btn-outline {
            background-color: transparent;
            color: #0B1F3D;
            border: 2px solid #0B1F3D;
        }
        .avenro-btn-outline:hover {
            background-color: #0B1F3D;
            color: #FFFFFF;
        }
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
        }
    </style>
    @stack('head')
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.header')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="fa2bed41-d460-4839-ae17-b605a758f04a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

    <script>
        // Scroll reveal animations
        document.addEventListener('DOMContentLoaded', function () {
            var els = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window && els.length) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
                    });
                }, { threshold: 0.12 });
                els.forEach(function (el) { io.observe(el); });
            } else {
                els.forEach(function (el) { el.classList.add('visible'); });
            }
        });
    </script>
</body>
</html>
