<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            @keyframes gradient-shift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .gradient-bg {
                background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
                background-size: 400% 400%;
                animation: gradient-shift 15s ease infinite;
            }

            .dark .gradient-bg {
                background: linear-gradient(-45deg, #1e3a8a, #312e81, #4c1d95, #1e40af);
                background-size: 400% 400%;
                animation: gradient-shift 15s ease infinite;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .dark .glass-card {
                background: rgba(31, 41, 55, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(75, 85, 99, 0.3);
            }

            .pattern-dots {
                background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 20px 20px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen gradient-bg pattern-dots flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Floating Shapes -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl" style="animation: float 8s ease-in-out infinite;"></div>

            <!-- Logo & Title -->
            <div class="text-center mb-8 relative z-10">
                <img src="{{ asset('logo.png') }}" alt="JDM Inventory Logo" class="mx-auto mb-4 drop-shadow-2xl" style="width: 112px; height: auto;">
                <h1 class="text-3xl font-bold text-white mb-2 drop-shadow-lg" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5), -1px -1px 2px rgba(0,0,0,0.3);">JDM Inventory System</h1>
                <p class="text-white/90 text-sm font-medium" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">Sistem Manajemen Inventaris Bengkel</p>
            </div>

            <!-- Login Card -->
            <div class="w-full sm:max-w-md relative z-10">
                <div class="glass-card shadow-2xl overflow-hidden sm:rounded-2xl px-8 py-10">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <p class="text-center mt-6 text-white/70 text-xs font-medium">
                    © {{ date('Y') }} JDM Inventory. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
