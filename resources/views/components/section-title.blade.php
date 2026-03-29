{{-- =====================================================
     Section Title komponenti — bo'lim sarlavhasi
     Props:
       label      — yuqori kichik belgi matni (ixtiyoriy)
       title      — asosiy sarlavha (majburiy)
       subtitle   — pastki tavsif matni (ixtiyoriy)
       align      — tekislash: left | center | right (default: center)
       dark       — qoramtir fon uchun oq ranglar (boolean)
       decoration — dekorativ chiziq ko'rsatish (default: true)
     Foydalanish:
       <x-section-title
           label="Bizning taklif"
           title="Eng mashhur taomlar"
           subtitle="Oshpazlarimiz tomonidan tavsiya etilgan 150+ ta'om turi"
       />
     ===================================================== --}}

@props([
    'label'      => null,
    'title'      => '',
    'subtitle'   => null,
    'align'      => 'center',
    'dark'       => false,
    'decoration' => true,
])

@php
    $alignClass = match($align) {
        'left'  => 'items-start text-left',
        'right' => 'items-end text-right',
        default => 'items-center text-center',
    };

    $titleColor    = $dark ? 'text-white'     : 'text-gray-900';
    $subtitleColor = $dark ? 'text-gray-400'  : 'text-gray-500';
    $labelColor    = $dark ? 'text-amber-400' : 'text-amber-600';
    $lineColor     = $dark ? 'bg-amber-400'   : 'bg-amber-500';
@endphp

<div class="flex flex-col {{ $alignClass }} gap-3 mb-12 sm:mb-16">

    {{-- Yuqori belgisi (label) —  kichik belgi matni --}}
    @if ($label)
        <div class="flex items-center gap-2 {{ $align === 'center' ? 'justify-center' : '' }}">
            {{-- Dekorativ uchburchaklar --}}
            <span class="{{ $labelColor }} text-xs select-none" aria-hidden="true">◆</span>
            <span class="text-xs font-black uppercase tracking-[0.2em] {{ $labelColor }}">
                {{ $label }}
            </span>
            <span class="{{ $labelColor }} text-xs select-none" aria-hidden="true">◆</span>
        </div>
    @endif

    {{-- Asosiy sarlavha --}}
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight {{ $titleColor }}"
        style="font-family: var(--font-heading); letter-spacing: -1px;">
        {{-- Sarlavha ichida highlight qilish uchun __matn__ sintaksisi --}}
        {!! preg_replace('/__(.*?)__/', '<span class="text-gradient">$1</span>', e($title)) !!}
    </h2>

    {{-- Dekorativ chiziq --}}
    @if ($decoration)
        <div class="flex items-center gap-2 {{ $align === 'center' ? 'justify-center' : '' }}">
            <span class="h-0.5 w-10 rounded-full {{ $lineColor }}"></span>
            <span class="h-1.5 w-1.5 rounded-full {{ $lineColor }}"></span>
            <span class="h-0.5 w-20 rounded-full {{ $lineColor }}"></span>
            <span class="h-1.5 w-1.5 rounded-full {{ $lineColor }}"></span>
            <span class="h-0.5 w-10 rounded-full {{ $lineColor }}"></span>
        </div>
    @endif

    {{-- Tavsif matni (subtitle) --}}
    @if ($subtitle)
        <p class="text-base sm:text-lg {{ $subtitleColor }} leading-relaxed
                   max-w-2xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif

    {{-- Qo'shimcha kontent (slot) --}}
    @if (!$slot->isEmpty())
        <div class="{{ $subtitleColor }}">
            {{ $slot }}
        </div>
    @endif
</div>
