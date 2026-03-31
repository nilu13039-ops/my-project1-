<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Grand Restoran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-gray-900">
    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <a href="/" class="text-2xl font-black" style="font-family: 'Playfair Display', serif; letter-spacing: -1px;">
                    <span class="text-amber-600">GRAND</span><span class="text-gray-900">RESTORAN</span>
                </a>
                <div class="hidden lg:flex items-center gap-12">
                    <a href="/" class="text-sm font-semibold text-gray-700 hover:text-amber-600 transition duration-300">BOSH SAHIFA</a>
                    <a href="{{ route('menu') }}" class="text-sm font-semibold text-gray-700 hover:text-amber-600 transition duration-300">MENYU</a>
                    <a href="{{ route('reservation.create') }}" class="text-sm font-semibold text-gray-700 hover:text-amber-600 transition duration-300">JOY BAND QILISH</a>
                </div>
                <div class="flex items-center gap-4">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg transition">
                            <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">
                            <a href="{{ route('profile.edit') }}" class="block px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 font-semibold">✏️ Profilni O'zgartirish</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-4 text-sm text-red-600 hover:bg-red-50 font-semibold">🚪 Chiqish</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER BANNER -->
    <section class="relative pt-24 pb-32 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 -right-20 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 left-20 w-40 h-40 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-amber-100 text-sm font-black uppercase tracking-widest mb-4">Siz Qadriyalisan 👋</p>
                    <h1 class="text-6xl font-black mb-6 leading-tight" style="font-family: 'Playfair Display', serif;">
                        Assalomu Aleykum,<br>{{ Auth::user()->name }}!
                    </h1>
                    <p class="text-2xl text-amber-50">Grand Restoranning qiymatlı mehmonisiz</p>
                </div>
                <div class="bg-amber-700/50 backdrop-blur-sm rounded-3xl p-10 border-2 border-amber-500/50">
                    <p class="text-amber-100 text-sm uppercase tracking-widest font-black mb-4">Akkaunt Raqam</p>
                    <p class="text-6xl font-black text-amber-200 mb-4">#{{ Auth::user()->id }}</p>
                    <p class="text-amber-100 text-base">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="py-32 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 hover:border-blue-500 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-4xl">📧</div>
                        <span class="text-xs font-black text-blue-600 bg-blue-50 px-4 py-2 rounded-full uppercase">Email</span>
                    </div>
                    <p class="text-gray-600 text-sm font-black uppercase tracking-wider mb-2">Elektron Pochta</p>
                    <p class="font-black text-gray-900 text-lg truncate">{{ Auth::user()->email }}</p>
                </div>

                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 hover:border-green-500 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-4xl">📱</div>
                        <span class="text-xs font-black text-green-600 bg-green-50 px-4 py-2 rounded-full uppercase">Tel</span>
                    </div>
                    <p class="text-gray-600 text-sm font-black uppercase tracking-wider mb-2">Telefon Raqami</p>
                    <p class="font-black text-gray-900 text-lg">{{ Auth::user()->phone ?? '—' }}</p>
                </div>

                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 hover:border-purple-500 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center text-4xl">🍽️</div>
                        <span class="text-xs font-black text-purple-600 bg-purple-50 px-4 py-2 rounded-full uppercase">Zakazlar</span>
                    </div>
                    <p class="text-gray-600 text-sm font-black uppercase tracking-wider mb-2">Jami Zakazlar</p>
                    <p class="text-5xl font-black text-purple-600">{{ Auth::user()->orders->count() ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 hover:border-orange-500 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-4xl">🪑</div>
                        <span class="text-xs font-black text-orange-600 bg-orange-50 px-4 py-2 rounded-full uppercase">Bronlar</span>
                    </div>
                    <p class="text-gray-600 text-sm font-black uppercase tracking-wider mb-2">Jami Bronlar</p>
                    <p class="text-5xl font-black text-orange-600">{{ Auth::user()->reservations->count() ?? 0 }}</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-32">
                <a href="{{ route('menu') }}" class="group bg-white rounded-3xl border-2 border-gray-200 p-12 text-center hover:border-amber-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-8xl mb-8 group-hover:scale-125 transition-transform duration-300">🍽️</div>
                    <h3 class="text-3xl font-black text-gray-900 group-hover:text-amber-600 mb-4">Menyu Ko'rish</h3>
                    <p class="text-gray-600 text-lg">Barcha taomlarni ko'ring va buyurtma bering</p>
                </a>

                <a href="{{ route('reservation.create') }}" class="group bg-white rounded-3xl border-2 border-gray-200 p-12 text-center hover:border-amber-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-8xl mb-8 group-hover:scale-125 transition-transform duration-300">📅</div>
                    <h3 class="text-3xl font-black text-gray-900 group-hover:text-amber-600 mb-4">Joy Band Qilish</h3>
                    <p class="text-gray-600 text-lg">Restoranda yangi stol band qiling</p>
                </a>

                <a href="{{ route('profile.edit') }}" class="group bg-white rounded-3xl border-2 border-gray-200 p-12 text-center hover:border-amber-500 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-8xl mb-8 group-hover:scale-125 transition-transform duration-300">⚙️</div>
                    <h3 class="text-3xl font-black text-gray-900 group-hover:text-amber-600 mb-4">Profilni O'zgartirish</h3>
                    <p class="text-gray-600 text-lg">Shaxsiy ma'lumotlaringizni yangilang</p>
                </a>
            </div>

            <!-- Orders & Reservations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Orders -->
                <div class="bg-white rounded-3xl border-2 border-gray-200 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="px-10 py-8 border-b-2 border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-3xl font-black text-gray-900">So'nggi Zakazlar</h2>
                            <a href="{{ route('menu') }}" class="text-amber-600 hover:text-amber-700 font-black text-base">Barchasini ko'rish →</a>
                        </div>
                    </div>

                    @if(Auth::user()->orders->count() > 0)
                    <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                        @foreach(Auth::user()->orders->take(5) as $order)
                        <div class="px-10 py-6 hover:bg-gray-50 transition flex items-center justify-between border-b border-gray-100">
                            <div>
                                <p class="font-black text-gray-900 text-xl">#{{ $order->id }} Zakaz</p>
                                <p class="text-sm text-gray-500 font-semibold mt-2">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black text-amber-600 mb-2">
                                    {{ number_format($order->total_amount, 0, ',', ' ') }}<span class="text-sm text-gray-600 font-bold">so'm</span>
                                </p>
                                <span class="inline-block text-xs font-black px-4 py-2 rounded-full
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @if($order->status === 'pending') ⏳ KUTILMOQDA
                                    @elseif($order->status === 'processing') 👨‍🍳 JARAYONDA
                                    @elseif($order->status === 'completed') ✓ BAJARILDI
                                    @else ✕ BEKOR
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="px-10 py-20 text-center text-gray-500">
                        <p class="text-2xl font-black mb-6">Hali zakaz bermadiniz 😢</p>
                        <a href="{{ route('menu') }}" class="text-amber-600 hover:text-amber-700 font-black text-lg">Menyu ko'rish →</a>
                    </div>
                    @endif
                </div>

                <!-- Reservations -->
                <div class="bg-white rounded-3xl border-2 border-gray-200 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="px-10 py-8 border-b-2 border-gray-200 bg-gradient-to-r from-orange-50 to-orange-100/50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-3xl font-black text-gray-900">So'nggi Bronlar</h2>
                            <a href="{{ route('reservation.create') }}" class="text-amber-600 hover:text-amber-700 font-black text-base">Yangi bron →</a>
                        </div>
                    </div>

                    @if(Auth::user()->reservations->count() > 0)
                    <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                        @foreach(Auth::user()->reservations->take(5) as $reservation)
                        <div class="px-10 py-6 hover:bg-gray-50 transition flex items-center justify-between border-b border-gray-100">
                            <div>
                                <p class="font-black text-gray-900 text-xl">{{ $reservation->table->name ?? 'Stol' }}</p>
                                <p class="text-sm text-gray-500 font-semibold mt-2">{{ $reservation->reservation_date->format('d.m.Y H:i') }} • {{ $reservation->guests_count }} kishi</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block text-xs font-black px-4 py-2 rounded-full
                                    @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($reservation->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($reservation->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @if($reservation->status === 'pending') ⏳ KUTILMOQDA
                                    @elseif($reservation->status === 'confirmed') ✓ TASDIQLANDI
                                    @elseif($reservation->status === 'completed') ✓ BAJARILDI
                                    @else ✕ BEKOR
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="px-10 py-20 text-center text-gray-500">
                        <p class="text-2xl font-black mb-6">Hali stol band qilmadiniz 😢</p>
                        <a href="{{ route('reservation.create') }}" class="text-amber-600 hover:text-amber-700 font-black text-lg">Joy band qiling →</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-20 px-4 sm:px-6 lg:px-8 border-t-2 border-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-16 pb-16 border-b border-gray-800">
                <div>
                    <h3 class="text-2xl font-black mb-6" style="font-family: 'Playfair Display', serif;">
                        <span class="text-amber-500">GRAND</span><span class="text-white">RESTORAN</span>
                    </h3>
                    <p class="text-gray-400 leading-relaxed text-sm">Toshkentning eng yaxshi restoraniMashhur taomlar va samimi xizmat.</p>
                </div>
                <div>
                    <h4 class="text-lg font-black mb-8 uppercase tracking-wider">Bog'lanish</h4>
                    <div class="space-y-5 text-gray-400 text-sm">
                        <p class="flex items-center gap-4"><span class="text-2xl">📞</span> +998 (97) 123-45-67</p>
                        <p class="flex items-center gap-4"><span class="text-2xl">📧</span> info@grandrestoran.uz</p>
                        <p class="flex items-center gap-4"><span class="text-2xl">📍</span> Toshkent, Mirobod ko'chasi 123</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-black mb-8 uppercase tracking-wider">Ish Vaqti</h4>
                    <div class="space-y-3 text-gray-400 text-sm">
                        <p>🕐 Dushanba - Paxshanba: 11:00 - 23:00</p>
                        <p>🕐 Juma - Shanba: 11:00 - 01:00</p>
                        <p>🕐 Yakshanba: 12:00 - 23:00</p>
                    </div>
                </div>
            </div>
            <div class="text-center text-gray-500 text-sm">
                <p>&copy; 2026 Grand Restoran. Barcha huquqlar saqlanib qoldi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
