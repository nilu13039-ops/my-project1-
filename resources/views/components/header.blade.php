{{-- =====================================================
     Header / Navigatsiya komponenti
     Xususiyatlar:
       - Fikslangan yuqori navigatsiya
       - Shaffof → qattiq fon (scroll effekti, Alpine.js)
       - Mobil burger menyu
       - Auth holati: kirgan / kirmagan
       - Savatcha ikona va buyurtma soni
     ===================================================== --}}

<header
    x-data="{
        mobileOpen: false,
        scrolled: false,
        cartCount: 0,
        init() {
            {{-- Scroll bo'lganda fon qorayadi --}}
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
            {{-- Savatcha sonini localStorage'dan olish --}}
            this.updateCartCount();
            window.addEventListener('cart-updated', () => this.updateCartCount());
        },
        updateCartCount() {
            try {
                const cart = JSON.parse(localStorage.getItem('gr_cart') || '[]');
                this.cartCount = cart.reduce((sum, item) => sum + (item.qty || 0), 0);
            } catch { this.cartCount = 0; }
        }
    }"
    :class="scrolled
        ? 'bg-white shadow-md border-b border-gray-200'
        : 'bg-white/80 backdrop-blur-xl border-b border-gray-100/60'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    role="banner"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 lg:h-24">

            {{-- ============================================
                 Logotip
                 ============================================ --}}
            <a href="{{ route('home') }}"
               class="flex-shrink-0 group"
               aria-label="Grand Restoran — Bosh sahifa">
                <span class="text-xl sm:text-2xl font-black tracking-tight leading-none"
                      style="font-family: var(--font-heading); letter-spacing: -1px;">
                    {{-- "GRAND" — oltin rang, yaltirash effekti --}}
                    <span class="logo-shimmer">GRAND</span>
                    {{-- "RESTORAN" — qora rang --}}
                    <span class="text-gray-900">RESTORAN</span>
                </span>
            </a>

            {{-- ============================================
                 Desktop navigatsiya (≥ lg)
                 ============================================ --}}
            <nav class="hidden lg:flex items-center gap-10" aria-label="Asosiy navigatsiya">

                {{-- Bosh sahifa --}}
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }}">
                    Bosh sahifa
                </a>

                {{-- Menyu --}}
                <a href="{{ route('menu') }}"
                   class="{{ request()->routeIs('menu') ? 'nav-link-active' : 'nav-link' }}">
                    Menyu
                </a>

                {{-- Joy bron qilish (faqat avtorizatsiya qilingan) --}}
                @auth
                    <a href="{{ route('reservation.create') }}"
                       class="{{ request()->routeIs('reservation.*') ? 'nav-link-active' : 'nav-link' }}">
                        Bron qilish
                    </a>
                @endauth
            </nav>

            {{-- ============================================
                 O'ng qism — auth tugmalar + savatcha
                 ============================================ --}}
            <div class="flex items-center gap-3">

                {{-- Savatcha ikona (hamma uchun ko'rinadi) --}}
                <button
                    x-on:click="$dispatch('open-modal', 'cart-modal')"
                    class="relative p-2.5 rounded-xl text-gray-600 hover:text-amber-600
                           hover:bg-amber-50 transition duration-200"
                    aria-label="Savatcha"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    {{-- Buyurtma soni badge --}}
                    <span
                        x-show="cartCount > 0"
                        x-text="cartCount > 99 ? '99+' : cartCount"
                        class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1
                               flex items-center justify-center
                               rounded-full bg-amber-500 text-white
                               text-[10px] font-bold leading-none"
                        style="display: none;"
                        aria-live="polite"
                    ></span>
                </button>

                {{-- Auth holati --}}
                @auth
                    {{-- Kirgan foydalanuvchi dropdown --}}
                    <div x-data="{ userMenu: false }" class="relative hidden lg:block">
                        <button
                            x-on:click="userMenu = !userMenu"
                            x-on:click.outside="userMenu = false"
                            class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl
                                   text-sm font-semibold text-gray-700
                                   hover:bg-gray-100 transition duration-200"
                            aria-haspopup="true"
                            :aria-expanded="userMenu"
                        >
                            {{-- Avatar (initials) --}}
                            <span class="w-8 h-8 rounded-full bg-amber-500 text-white
                                         flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                            {{-- Strelka pastga --}}
                            <svg :class="userMenu ? 'rotate-180' : ''"
                                 class="w-4 h-4 text-gray-400 transition-transform duration-200"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown menyu --}}
                        <div
                            x-show="userMenu"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute right-0 top-full mt-2 w-56 bg-white
                                   rounded-2xl shadow-xl border border-gray-100
                                   overflow-hidden py-1"
                            style="display: none;"
                        >
                            {{-- Dashboard --}}
                            <a href="{{ route('dashboard') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm
                                      text-gray-700 hover:bg-amber-50 hover:text-amber-700
                                      transition duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>
                                </svg>
                                Dashboard
                            </a>

                            {{-- Profil --}}
                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm
                                      text-gray-700 hover:bg-amber-50 hover:text-amber-700
                                      transition duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profilim
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            {{-- Chiqish --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-3 w-full px-4 py-3
                                               text-sm text-red-600
                                               hover:bg-red-50 transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Chiqish
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Kirmagan foydalanuvchi — Kirish va Ro'yxatdan tugmalari --}}
                    <div class="hidden lg:flex items-center gap-2">
                        <a href="{{ route('login') }}"
                           class="btn-outline py-2.5">
                            Kirish
                        </a>
                        <a href="{{ route('register') }}"
                           class="btn-primary py-2.5">
                            Ro'yxatdan o'tish
                        </a>
                    </div>
                @endauth

                {{-- ==========================================
                     Mobil burger tugmasi (< lg)
                     ========================================== --}}
                <button
                    x-on:click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2.5 rounded-xl text-gray-600
                           hover:bg-gray-100 transition duration-200"
                    :aria-expanded="mobileOpen"
                    aria-label="Menyuni ochish"
                >
                    {{-- Burger ikona / X ikona --}}
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24"
                         style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================
         Mobil menyu paneli
         ============================================ --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-gray-100 shadow-lg"
        style="display: none;"
    >
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-4 space-y-1">

            {{-- Navigatsiya linklari --}}
            <a href="{{ route('home') }}"
               x-on:click="mobileOpen = false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                      {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-700' : 'text-gray-700 hover:bg-gray-50' }}
                      transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Bosh sahifa
            </a>

            <a href="{{ route('menu') }}"
               x-on:click="mobileOpen = false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                      {{ request()->routeIs('menu') ? 'bg-amber-50 text-amber-700' : 'text-gray-700 hover:bg-gray-50' }}
                      transition duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Menyu
            </a>

            @auth
                <a href="{{ route('reservation.create') }}"
                   x-on:click="mobileOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                          {{ request()->routeIs('reservation.*') ? 'bg-amber-50 text-amber-700' : 'text-gray-700 hover:bg-gray-50' }}
                          transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Bron qilish
                </a>

                <div class="border-t border-gray-100 pt-3 mt-3 space-y-1">
                    <a href="{{ route('dashboard') }}"
                       x-on:click="mobileOpen = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                              text-gray-700 hover:bg-gray-50 transition duration-150">
                        Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       x-on:click="mobileOpen = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                              text-gray-700 hover:bg-gray-50 transition duration-150">
                        Profilim
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-3 rounded-xl
                                       text-sm font-semibold text-red-600 hover:bg-red-50
                                       transition duration-150">
                            Chiqish
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-100 pt-3 mt-3 flex gap-2">
                    <a href="{{ route('login') }}"
                       class="btn-outline flex-1 text-center">
                        Kirish
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn-primary flex-1 text-center">
                        Ro'yxatdan o'tish
                    </a>
                </div>
            @endauth
        </nav>
    </div>
</header>

{{-- Header balandligini qoplash uchun spacer --}}
<div class="h-20 lg:h-24" aria-hidden="true"></div>
