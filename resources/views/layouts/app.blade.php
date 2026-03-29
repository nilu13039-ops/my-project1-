<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Grand Restoran' }} - Premium Restoran Toshkentda</title>
    <meta name="description" content="Toshkentning markazidagi premium restoran. Qadimiy sharq mazzalari va zamonaviy oshpazlik san'atining uyg'unligi.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preload" as="image" href="{{ asset('images/food-placeholder.svg') }}">
    @if(request()->routeIs('home'))
        <link rel="preload" as="image" href="{{ asset('images/palov.jpg') }}">
        <link rel="preload" as="image" href="{{ asset('images/shashlik.jpg') }}">
    @endif

    <style>
        :root {
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
        }

        .logo-shimmer {
            background: linear-gradient(45deg, #f59e0b, #d97706, #f59e0b);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-white text-gray-900 font-body" style="font-family: var(--font-body);">

    {{-- Header --}}
    <x-header />

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 left-1/2 -translate-x-1/2 z-50 max-w-lg w-full px-4">
            <div class="bg-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="font-semibold">{{ session('success') }}</span>
                <button @click="show = false" class="ml-auto text-white/80 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 left-1/2 -translate-x-1/2 z-50 max-w-lg w-full px-4">
            <div class="bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold">{{ session('error') }}</span>
                <button @click="show = false" class="ml-auto text-white/80 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main role="main">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Alpine.js init --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom scripts --}}
    @stack('scripts')
</body>
</html>