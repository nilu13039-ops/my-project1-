@extends('layouts.app')

@section('title', 'Bosh Sahifa')

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-amber-50 via-white to-amber-50">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-amber-200 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-amber-300 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-amber-100 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Logo --}}
            <div class="mb-8">
                <span class="text-6xl sm:text-8xl font-black leading-none block"
                      style="font-family: var(--font-heading); letter-spacing: -2px;">
                    <span class="logo-shimmer">GRAND</span>
                    <span class="text-gray-900">RESTORAN</span>
                </span>
            </div>

            {{-- Tagline --}}
            <p class="text-xl sm:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                Toshkentning markazidagi premium restoran. Qadimiy sharq mazzalari va
                zamonaviy oshpazlik san'atining uyg'unligi.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                <a href="{{ route('menu') }}"
                   class="group bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                    🍽️ Menyu Ko'rish
                </a>
                <a href="{{ route('reservation.create') }}"
                   class="group bg-white hover:bg-gray-50 text-gray-900 border-2 border-gray-300 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-xl hover:border-amber-500">
                    📅 Joy Band Qilish
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-black text-amber-600 mb-2">150+</div>
                    <div class="text-sm text-gray-600 font-semibold">Taom Turlari</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-black text-amber-600 mb-2">4.9</div>
                    <div class="text-sm text-gray-600 font-semibold">Reyting</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-black text-amber-600 mb-2">1200+</div>
                    <div class="text-sm text-gray-600 font-semibold">Mehmonlar</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-black text-amber-600 mb-2">5</div>
                    <div class="text-sm text-gray-600 font-semibold">Yil Tajriba</div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </div>
    </section>

    {{-- Featured Foods Section --}}
    @if($featuredFoods->count() > 0)
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6"
                    style="font-family: var(--font-heading);">
                    🍽️ Mashhur Taomlar
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mehmonlarimizning eng sevimli taomlarini sinab ko'ring
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredFoods as $food)
                <x-food-card :food="$food" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Categories Section --}}
    @if($categories->count() > 0)
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6"
                    style="font-family: var(--font-heading);">
                    📋 Kategoriyalar
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Har xil ta'm va mazali taomlarni kashf eting
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                <a href="{{ route('menu') }}#category-{{ $category->slug }}"
                   class="group bg-white rounded-3xl p-8 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-gray-100 hover:border-amber-200">
                    <div class="text-center">
                        <div class="text-6xl mb-6 group-hover:scale-125 transition-transform duration-300">
                            @if($category->name == 'Osh')
                                🍚
                            @elseif($category->name == 'Shorpo')
                                🍜
                            @elseif($category->name == 'Gril')
                                🔥
                            @elseif($category->name == 'Salat')
                                🥗
                            @elseif($category->name == 'Ichimlik')
                                🥤
                            @else
                                🍽️
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 group-hover:text-amber-600 mb-4">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-600 font-semibold">
                            {{ $category->foods_count }} ta taom
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('menu') }}"
                   class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                    📖 To'liq Menyuni Ko'rish
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- About Section --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-8"
                        style="font-family: var(--font-heading);">
                        🏛️ Biz Haqimizda
                    </h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Grand Restoran — bu nafaqat taom, balki tajriba. Bizning oshpazlarimiz
                        an'anaviy o'zbek taomlarini zamonaviy usullar bilan tayyorlaydilar.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Har bir taom — bu sifat, mazali va muhabbat bilan tayyorlangan.
                        Biz sizni kutamiz va sizning ta'tilingizni unutilmas qilamiz.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <div class="bg-amber-50 px-6 py-3 rounded-2xl">
                            <div class="text-2xl font-black text-amber-600">4.9</div>
                            <div class="text-sm text-gray-600">Reyting</div>
                        </div>
                        <div class="bg-green-50 px-6 py-3 rounded-2xl">
                            <div class="text-2xl font-black text-green-600">1200+</div>
                            <div class="text-sm text-gray-600">Mehmon</div>
                        </div>
                        <div class="bg-blue-50 px-6 py-3 rounded-2xl">
                            <div class="text-2xl font-black text-blue-600">150+</div>
                            <div class="text-sm text-gray-600">Taom</div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-amber-100 to-amber-200 rounded-3xl p-8 shadow-2xl">
                        <div class="text-center">
                            <div class="text-8xl mb-6">👨‍🍳</div>
                            <h3 class="text-2xl font-black text-gray-900 mb-4">Professional Oshpazlar</h3>
                            <p class="text-gray-700">
                                Bizning jamoamiz — bu tajribali oshpazlar va xizmatchilar
                                jamoasi, ular har bir mehmonni qadrlaydi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl sm:text-5xl font-black mb-8"
                style="font-family: var(--font-heading);">
                🎉 Bizni Ziyorat Qiling!
            </h2>
            <p class="text-xl text-amber-100 mb-12 max-w-2xl mx-auto">
                Eng yaxshi taomlarni tatib ko'rish uchun joy band qiling yoki
                onlayn buyurtma bering
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                @auth
                <a href="{{ route('reservation.create') }}"
                   class="bg-white text-amber-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-2xl">
                    📅 Joy Band Qilish
                </a>
                @else
                <a href="{{ route('login') }}"
                   class="bg-white text-amber-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-2xl">
                    🔐 Kirish
                </a>
                @endauth
                <a href="{{ route('menu') }}"
                   class="border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-amber-600 transition-all duration-300">
                    🍽️ Menyu Ko'rish
                </a>
            </div>
        </div>
    </section>
@endsection