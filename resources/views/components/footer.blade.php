{{-- =====================================================
     Footer komponenti
     Tarkib:
       - Logotip va qisqa tavsif
       - Tezkor havolalar
       - Kontakt ma'lumotlari
       - Ish vaqtlari
       - Ijtimoiy tarmoqlar
       - Mualliflik huquqi
     ===================================================== --}}

<footer class="bg-gray-900 text-gray-300" role="contentinfo">

    {{-- Sharq naqshlari dekoratsiyasi --}}
    <div class="bg-pattern opacity-5 absolute inset-0 pointer-events-none"
         aria-hidden="true"></div>

    {{-- ===================================================
         Yuqori qism — to'rt ustunli grid
         =================================================== --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            {{-- ---- 1. Logotip va tavsif ---- --}}
            <div class="sm:col-span-2 lg:col-span-1">
                {{-- Logotip --}}
                <a href="{{ route('home') }}" class="inline-block mb-5">
                    <span class="text-2xl font-black leading-none"
                          style="font-family: var(--font-heading); letter-spacing: -1px;">
                        <span class="text-amber-400">GRAND</span>
                        <span class="text-white">RESTORAN</span>
                    </span>
                </a>

                {{-- Tavsif --}}
                <p class="text-sm text-gray-400 leading-relaxed mb-6 max-w-xs">
                    Toshkentning markazidagi premium restoran. Qadimiy sharq
                    mazzalari va zamonaviy oshpazlik san'atining uyg'unligi.
                </p>

                {{-- Reyting --}}
                <div class="flex items-center gap-1.5">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                    <span class="text-xs text-gray-400 ml-1">4.9 / 5 (1200+ izoh)</span>
                </div>
            </div>

            {{-- ---- 2. Tezkor havolalar ---- --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5">
                    Havolalar
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}"
                           class="text-sm text-gray-400 hover:text-amber-400
                                  transition duration-200 flex items-center gap-2">
                            <span class="text-amber-500">›</span> Bosh sahifa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menu') }}"
                           class="text-sm text-gray-400 hover:text-amber-400
                                  transition duration-200 flex items-center gap-2">
                            <span class="text-amber-500">›</span> Menyu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reservation.create') }}"
                           class="text-sm text-gray-400 hover:text-amber-400
                                  transition duration-200 flex items-center gap-2">
                            <span class="text-amber-500">›</span> Stol bron qilish
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="text-sm text-gray-400 hover:text-amber-400
                                      transition duration-200 flex items-center gap-2">
                                <span class="text-amber-500">›</span> Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                               class="text-sm text-gray-400 hover:text-amber-400
                                      transition duration-200 flex items-center gap-2">
                                <span class="text-amber-500">›</span> Kirish
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                               class="text-sm text-gray-400 hover:text-amber-400
                                      transition duration-200 flex items-center gap-2">
                                <span class="text-amber-500">›</span> Ro'yxatdan o'tish
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            {{-- ---- 3. Kontakt ma'lumotlari ---- --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5">
                    Aloqa
                </h3>
                <ul class="space-y-4">
                    {{-- Manzil --}}
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 mt-0.5 w-8 h-8 rounded-lg bg-amber-500/10
                                     flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <span class="text-sm text-gray-400 leading-relaxed">
                            Toshkent sh., Amir Temur ko'chasi, 15-uy
                        </span>
                    </li>

                    {{-- Telefon --}}
                    <li class="flex items-center gap-3">
                        <span class="shrink-0 w-8 h-8 rounded-lg bg-amber-500/10
                                     flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <a href="tel:+998901234567"
                           class="text-sm text-gray-400 hover:text-amber-400 transition">
                            +998 (90) 123-45-67
                        </a>
                    </li>

                    {{-- Email --}}
                    <li class="flex items-center gap-3">
                        <span class="shrink-0 w-8 h-8 rounded-lg bg-amber-500/10
                                     flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <a href="mailto:info@grandrestoran.uz"
                           class="text-sm text-gray-400 hover:text-amber-400 transition">
                            info@grandrestoran.uz
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ---- 4. Ish vaqtlari ---- --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5">
                    Ish vaqti
                </h3>

                <ul class="space-y-3">
                    <li class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">Dushanba — Juma</span>
                        <span class="text-amber-400 font-semibold">10:00 – 23:00</span>
                    </li>
                    <li class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">Shanba</span>
                        <span class="text-amber-400 font-semibold">09:00 – 00:00</span>
                    </li>
                    <li class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">Yakshanba</span>
                        <span class="text-amber-400 font-semibold">09:00 – 23:00</span>
                    </li>
                </ul>

                {{-- Hozir ochiq / yopiq indikator --}}
                <div class="mt-5 flex items-center gap-2">
                    @php
                        $hour = (int) now()->format('H');
                        $isOpen = $hour >= 10 && $hour < 23;
                    @endphp
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full rounded-full
                                     {{ $isOpen ? 'bg-green-400' : 'bg-red-400' }}
                                     opacity-75 animate-ping"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full
                                     {{ $isOpen ? 'bg-green-400' : 'bg-red-400' }}">
                        </span>
                    </span>
                    <span class="text-xs font-semibold {{ $isOpen ? 'text-green-400' : 'text-red-400' }}">
                        {{ $isOpen ? 'Hozir ochiq' : 'Yopiq' }}
                    </span>
                </div>

                {{-- Ijtimoiy tarmoqlar --}}
                <div class="mt-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-3">
                        Bizni kuzating
                    </p>
                    <div class="flex items-center gap-2">
                        {{-- Instagram --}}
                        <a href="#" aria-label="Instagram"
                           class="w-9 h-9 rounded-xl bg-white/5 hover:bg-amber-500
                                  flex items-center justify-center
                                  text-gray-400 hover:text-white
                                  transition duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>

                        {{-- Telegram --}}
                        <a href="#" aria-label="Telegram"
                           class="w-9 h-9 rounded-xl bg-white/5 hover:bg-amber-500
                                  flex items-center justify-center
                                  text-gray-400 hover:text-white
                                  transition duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        <a href="#" aria-label="Facebook"
                           class="w-9 h-9 rounded-xl bg-white/5 hover:bg-amber-500
                                  flex items-center justify-center
                                  text-gray-400 hover:text-white
                                  transition duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================================================
         Pastki qism — mualliflik huquqi
         =================================================== --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5
                    flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} Grand Restoran. Barcha huquqlar himoyalangan.
            </p>
            <p class="text-xs text-gray-600">
                Toshkent, O'zbekiston 🇺🇿
            </p>
        </div>
    </div>
</footer>
