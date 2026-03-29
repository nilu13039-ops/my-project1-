<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Restaurant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Sidebar -->
    <aside class="bg-gray-900 text-white w-64 flex-shrink-0 flex flex-col" :class="sidebarOpen ? 'flex' : 'hidden md:flex'">
        <div class="h-16 flex items-center px-6 border-b border-gray-800">
            <span class="text-xl font-bold text-amber-500">Restoran Admin</span>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Dashboard</a>
            <a href="{{ route('admin.tables.index') }}" class="{{ request()->routeIs('admin.tables.*') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Stollar</a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Kategoriyalar</a>
            <a href="{{ route('admin.foods.index') }}" class="{{ request()->routeIs('admin.foods.*') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Taomlar</a>
            <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Rezervatsiyalar</a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'block px-4 py-2 rounded bg-amber-600 text-white font-medium' : 'block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition' }}">Zakazlar</a>
        </nav>
        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded transition">
                    Chiqish
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navbar -->
        <header class="h-16 bg-white shadow-sm flex items-center px-6 justify-between">
            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
            <div class="flex items-center">
                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-auto p-6 bg-gray-50">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v4a1 1 0 102 0V5zm-1 8a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

</body>
</html>
