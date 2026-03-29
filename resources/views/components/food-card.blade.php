{{-- =====================================================
     Food Card komponenti — ta'om kartochkasi
     Props:
       :food    — Food model obyekti (majburiy)
       :compact — kichik versiya (boolean, default: false)
     Foydalanish:
       <x-food-card :food="$food" />
       <x-food-card :food="$food" :compact="true" />
     ===================================================== --}}

@props([
    'food',
    'compact' => false,
])

@php
    // Yangi ta'om: 7 kundan kam
    $isNew  = $food->created_at?->diffInDays(now()) <= 7;
    // Hit: 50+ buyurtma
    $isHit  = $food->orderItems()->count() >= 50;
    // Rasm manzili
    $imgSrc = $food->image
        ? (str_starts_with($food->image, 'http') ? $food->image : asset($food->image))
        : asset('images/food-placeholder.svg');
@endphp

<article
    x-data="{ inCart: false, qty: 1 }"
    class="card group relative flex flex-col {{ $compact ? 'text-sm' : '' }}"
    aria-label="{{ $food->name }}"
>
    {{-- =====================================================
         Rasm qismi
         ===================================================== --}}
    <div class="relative overflow-hidden {{ $compact ? 'h-40' : 'h-52 sm:h-56' }}
                bg-gray-100 rounded-t-2xl">

        {{-- Loading skeleton --}}
        <div class="absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-100 to-gray-200 animate-pulse rounded-t-2xl"></div>

        {{-- Ta'om rasmi --}}
        <img
            src="{{ $imgSrc }}"
            alt="{{ $food->name }}"
            loading="lazy"
            onload="this.previousElementSibling.style.display='none';"
            onerror="this.onerror=null; this.src='{{ asset('images/food-placeholder.svg') }}'; this.previousElementSibling.style.display='none'; this.style.opacity='0.7';"
            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 relative z-10"
            style="min-height: 200px;"
        >

        {{-- Gradient overlay (pastdan yuqoriga) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent
                    opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>

        {{-- Badge qatori (chap yuqori) --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
            @if ($isNew)
                <span class="badge-amber shadow-sm">
                    ✦ Yangi
                </span>
            @endif
            @if ($isHit)
                <span class="badge-red shadow-sm">
                    🔥 Hit
                </span>
            @endif
            @if (!$food->is_available)
                <span class="badge bg-gray-600 text-white shadow-sm">
                    Mavjud emas
                </span>
            @endif
        </div>

        {{-- Kategoriya (o'ng yuqori) --}}
        @if ($food->relationLoaded('category') && $food->category)
            <div class="absolute top-3 right-3">
                <span class="badge bg-white/90 text-gray-700 shadow-sm backdrop-blur-sm">
                    {{ $food->category->name }}
                </span>
            </div>
        @endif

        {{-- Tez ko'rish tugmasi (hover da chiqadi) --}}
        <div class="absolute inset-x-0 bottom-3 flex justify-center
                    opacity-0 group-hover:opacity-100
                    translate-y-2 group-hover:translate-y-0
                    transition-all duration-300">
            <button
                x-on:click.stop="$dispatch('open-modal', 'food-detail-{{ $food->id }}')"
                class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full
                       text-xs font-bold text-gray-800
                       hover:bg-white shadow-md transition duration-150"
            >
                Tezkor ko'rish
            </button>
        </div>
    </div>

    {{-- =====================================================
         Kontent qismi
         ===================================================== --}}
    <div class="flex flex-col flex-1 p-{{ $compact ? '4' : '5' }}">

        {{-- Ta'om nomi --}}
        <h3 class="{{ $compact ? 'text-base' : 'text-lg' }} font-bold text-gray-900 mb-1.5
                   leading-tight line-clamp-1"
            style="font-family: var(--font-heading);">
            {{ $food->name }}
        </h3>

        {{-- Tavsif --}}
        @if ($food->description)
            <p class="text-sm text-gray-500 leading-relaxed mb-4
                       line-clamp-{{ $compact ? '1' : '2' }} flex-1">
                {{ $food->description }}
            </p>
        @else
            <div class="flex-1"></div>
        @endif

        {{-- Narx + Savatga qo'shish --}}
        <div class="flex items-center justify-between gap-3 mt-auto pt-3
                    border-t border-gray-100">

            {{-- Narx --}}
            <div>
                <span class="{{ $compact ? 'text-lg' : 'text-xl' }} font-black text-amber-600"
                      style="font-family: var(--font-heading);">
                    {{ number_format($food->price, 0, ',', ' ') }}
                </span>
                <span class="text-xs text-gray-400 font-medium"> so'm</span>
            </div>

            {{-- Savatga qo'shish tugmasi --}}
            @if ($food->is_available)
                <button
                    x-on:click="
                        inCart = true;
                        const cart = JSON.parse(localStorage.getItem('gr_cart') || '[]');
                        const idx = cart.findIndex(i => i.id === {{ $food->id }});
                        if (idx > -1) {
                            cart[idx].qty += 1;
                        } else {
                            cart.push({
                                id:    {{ $food->id }},
                                name:  '{{ addslashes($food->name) }}',
                                price: {{ $food->price }},
                                qty:   1,
                                image: '{{ $imgSrc }}'
                            });
                        }
                        localStorage.setItem('gr_cart', JSON.stringify(cart));
                        window.dispatchEvent(new CustomEvent('cart-updated'));
                        setTimeout(() => inCart = false, 1500);
                    "
                    :class="inCart
                        ? 'bg-green-500 hover:bg-green-500 scale-95'
                        : 'bg-amber-500 hover:bg-amber-600'"
                    class="flex items-center justify-center gap-1.5
                           {{ $compact ? 'px-3 py-2 text-xs' : 'px-4 py-2.5 text-sm' }}
                           rounded-xl font-semibold text-white
                           active:scale-90 transition-all duration-200
                           focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-1"
                    :aria-label="inCart ? 'Savatga qo\'shildi' : 'Savatga qo\'shish'"
                >
                    {{-- Ikona: tayyor belgisi yoki + --}}
                    <span x-show="!inCart" class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        @if (!$compact)
                            <span>Savat</span>
                        @endif
                    </span>
                    <span x-show="inCart" style="display:none;"
                          class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        @if (!$compact)
                            <span>Qo'shildi</span>
                        @endif
                    </span>
                </button>
            @else
                {{-- Mavjud emas holati --}}
                <span class="px-4 py-2.5 rounded-xl text-xs font-semibold
                              text-gray-400 bg-gray-100 cursor-not-allowed">
                    Mavjud emas
                </span>
            @endif
        </div>
    </div>
</article>

{{-- =====================================================
     Tezkor ko'rish modali (har bir karta uchun)
     ===================================================== --}}
<x-modal name="food-detail-{{ $food->id }}" :title="$food->name" max-width="lg">
    <div class="flex flex-col sm:flex-row gap-5">
        {{-- Rasm --}}
        <div class="sm:w-2/5 shrink-0">
            <img src="{{ $imgSrc }}" alt="{{ $food->name }}"
                 class="w-full h-52 sm:h-full object-cover rounded-xl">
        </div>

        {{-- Ma'lumotlar --}}
        <div class="flex-1 flex flex-col gap-3">
            @if ($food->description)
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $food->description }}
                </p>
            @endif

            <div class="flex items-center gap-2 flex-wrap">
                @if ($isNew)
                    <span class="badge-amber">✦ Yangi</span>
                @endif
                @if ($isHit)
                    <span class="badge-red">🔥 Hit</span>
                @endif
                @if ($food->relationLoaded('category') && $food->category)
                    <span class="badge bg-gray-100 text-gray-600">
                        {{ $food->category->name }}
                    </span>
                @endif
            </div>

            <div class="mt-auto pt-4 border-t border-gray-100
                        flex items-center justify-between">
                <span class="text-2xl font-black text-amber-600"
                      style="font-family: var(--font-heading);">
                    {{ number_format($food->price, 0, ',', ' ') }}
                    <span class="text-sm text-gray-400 font-medium">so'm</span>
                </span>

                @if ($food->is_available)
                    <button
                        x-on:click="
                            const cart = JSON.parse(localStorage.getItem('gr_cart') || '[]');
                            const idx = cart.findIndex(i => i.id === {{ $food->id }});
                            idx > -1 ? cart[idx].qty++ : cart.push({ id: {{ $food->id }}, name: '{{ addslashes($food->name) }}', price: {{ $food->price }}, qty: 1, image: '{{ $imgSrc }}' });
                            localStorage.setItem('gr_cart', JSON.stringify(cart));
                            window.dispatchEvent(new CustomEvent('cart-updated'));
                            $dispatch('close-modal', 'food-detail-{{ $food->id }}');
                        "
                        class="btn-primary"
                    >
                        Savatga qo'shish
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-modal>
