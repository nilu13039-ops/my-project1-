<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Grand Restoran' }} - Premium Restoran Toshkentda</title>
    <meta name="description" content="Toshkentning markazidagi premium restoran. Qadimiy sharq mazzalari va zamonaviy oshpazlik san'atining uyg'unligi.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
        }

        .bg-auth {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .bg-auth-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-auth bg-auth-pattern min-h-screen flex items-center justify-center px-4 py-12" style="font-family: var(--font-body);">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-white mb-2 logo-shimmer" style="font-family: var(--font-heading);">
                Grand Restoran
            </h2>
            <p class="text-amber-100 text-sm">Premium Restoran Toshkentda</p>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            {{ $slot }}
        </div>
    </div>

    {{-- Alpine.js init --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom scripts --}}
    @stack('scripts')
</body>
</html>