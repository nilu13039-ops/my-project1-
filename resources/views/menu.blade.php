@extends('layouts.app')

@section('title', 'Menyu')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl font-black mb-6"
                style="font-family: var(--font-heading);">
                🍽️ Bizning Menyu
            </h1>
            <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                Har xil ta'm va mazali taomlarni kashf eting. Barcha taomlarimiz
                yangi ingredientlardan tayyorlanadi.
            </p>
        </div>
    </section>

    {{-- Menu Content --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            {{-- Categories Navigation --}}
            @if($categories->count() > 0)
            <div class="mb-12">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#all"
                       class="category-tab active bg-amber-600 text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300">
                        📋 Barcha Kategoriyalar
                    </a>
                    @foreach($categories as $category)
                    <a href="#category-{{ $category->slug }}"
                       class="category-tab bg-gray-100 hover:bg-amber-100 text-gray-700 hover:text-amber-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Menu Items --}}
            <div class="space-y-16">
                @foreach($categories as $category)
                <div id="category-{{ $category->slug }}" class="category-section">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-black text-gray-900 mb-4"
                            style="font-family: var(--font-heading);">
                            {{ $category->name }}
                        </h2>
                        <div class="w-24 h-1 bg-amber-500 mx-auto rounded-full"></div>
                    </div>

                    @if($category->foods->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($category->foods as $food)
                        <x-food-card :food="$food" />
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-16">
                        <div class="text-6xl mb-6">🍽️</div>
                        <p class="text-xl text-gray-500 font-semibold">
                            Bu kategoriyada hali taomlar yo'q
                        </p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- No foods message --}}
            @if($categories->isEmpty() || $categories->every(fn($cat) => $cat->foods->isEmpty()))
            <div class="text-center py-24">
                <div class="text-8xl mb-8">🍽️</div>
                <h2 class="text-4xl font-black text-gray-900 mb-6"
                    style="font-family: var(--font-heading);">
                    Menyu Tayyorlanmoqda
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Bizning oshpazlarimiz siz uchun eng mazali taomlarni tayyorlamoqdalar.
                    Tez orada menyu to'liq bo'ladi!
                </p>
            </div>
            @endif
        </div>
    </section>

    {{-- Reservation CTA --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-black text-gray-900 mb-6"
                style="font-family: var(--font-heading);">
                🎯 Tayyor Buyurtma Berishga?
            </h2>
            <p class="text-xl text-gray-600 mb-8">
                Eng yaxshi tajribani olish uchun oldindan joy band qiling
            </p>
            @auth
            <a href="{{ route('reservation.create') }}"
               class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                📅 Joy Band Qilish
            </a>
            @else
            <a href="{{ route('login') }}"
               class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                🔐 Kirish va Band Qilish
            </a>
            @endauth
        </div>
    </section>

    @push('scripts')
    <script>
        // Category tabs functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.category-tab');
            const sections = document.querySelectorAll('.category-section');

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active', 'bg-amber-600', 'text-white'));
                    tabs.forEach(t => t.classList.add('bg-gray-100', 'text-gray-700'));

                    // Add active class to clicked tab
                    this.classList.add('active', 'bg-amber-600', 'text-white');
                    this.classList.remove('bg-gray-100', 'text-gray-700');

                    // Scroll to section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            // Highlight active section on scroll
            const observerOptions = {
                root: null,
                rootMargin: '-50% 0px -50% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.id;
                        tabs.forEach(tab => {
                            tab.classList.remove('active', 'bg-amber-600', 'text-white');
                            tab.classList.add('bg-gray-100', 'text-gray-700');
                        });

                        const activeTab = document.querySelector(`a[href="#${id}"]`);
                        if (activeTab) {
                            activeTab.classList.add('active', 'bg-amber-600', 'text-white');
                            activeTab.classList.remove('bg-gray-100', 'text-gray-700');
                        }
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));
        });
    </script>
    @endpush
@endsection