{{-- =====================================================
     Universal Modal komponenti
     Foydalanish:
       <x-modal name="food-detail" title="Ta'om haqida">
           ...kontent...
       </x-modal>
       Ochish: $dispatch('open-modal', 'food-detail')
     ===================================================== --}}

@props([
    'name',
    'title'    => '',
    'maxWidth' => 'lg',
    'show'     => false,
])

@php
    $widthClasses = [
        'sm'  => 'max-w-sm',
        'md'  => 'max-w-md',
        'lg'  => 'max-w-lg',
        'xl'  => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$maxWidth] ?? 'max-w-lg';
@endphp

<div
    x-data="{ show: @js($show) }"
    x-init="
        $watch('show', val => {
            document.body.style.overflow = val ? 'hidden' : '';
        });
    "
    x-on:open-modal.window="$event.detail === '{{ $name }}' && (show = true)"
    x-on:close-modal.window="$event.detail === '{{ $name }}' && (show = false)"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    style="display: {{ $show ? 'flex' : 'none' }};"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title-{{ $name }}"
>
    {{-- Fon — qora pardasi (backdrop) --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="show = false"
        class="absolute inset-0 bg-black/60 backdrop-blur-sm"
    ></div>

    {{-- Modal oyna --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full {{ $widthClasses }} bg-white rounded-2xl shadow-2xl
               overflow-hidden"
    >
        {{-- ---- Sarlavha qismi ---- --}}
        @if ($title)
            <div class="flex items-center justify-between px-6 py-5
                        border-b border-gray-100">
                {{-- Dekorativ chiziq --}}
                <div class="flex items-center gap-3">
                    <span class="w-1 h-6 rounded-full bg-amber-500"></span>
                    <h3 id="modal-title-{{ $name }}"
                        class="text-lg font-bold text-gray-900"
                        style="font-family: var(--font-heading);">
                        {{ $title }}
                    </h3>
                </div>

                {{-- Yopish tugmasi --}}
                <button
                    x-on:click="show = false"
                    class="w-8 h-8 flex items-center justify-center rounded-full
                           text-gray-400 hover:text-gray-600 hover:bg-gray-100
                           transition duration-150"
                    aria-label="Yopish"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @else
            {{-- Sarlavhasiz modal uchun faqat yopish tugmasi --}}
            <button
                x-on:click="show = false"
                class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center
                       justify-center rounded-full bg-white/80 shadow
                       text-gray-500 hover:text-gray-800 transition"
                aria-label="Yopish"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif

        {{-- ---- Kontent qismi ---- --}}
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
