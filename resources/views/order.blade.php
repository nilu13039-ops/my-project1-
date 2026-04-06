@extends('layouts.app')

@section('title', 'Buyurtma Berish')

@section('content')
    @if(session('clear_cart'))
        <script>
            localStorage.removeItem('gr_cart');
            window.dispatchEvent(new CustomEvent('cart-updated'));
        </script>
    @endif

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl font-black mb-6" style="font-family: var(--font-heading);">
                🛒 Buyurtma Berish
            </h1>
            <p class="text-xl text-amber-100 max-w-3xl mx-auto">
                Menudan taomlarni savatga qo'shing, miqdorini sozlang va buyurtmani bir zumda tasdiqlang.
            </p>
        </div>
    </section>

    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto" x-data="orderPage()" x-init="init()">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-2xl border-2 border-gray-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-amber-100">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-3xl font-black text-gray-900" style="font-family: var(--font-heading);">
                                        Savat
                                    </h2>
                                    <p class="text-gray-600 mt-2">Miqdorni o'zgartiring yoki kerakmas taomlarni olib tashlang.</p>
                                </div>
                                <a href="{{ route('menu') }}" class="text-amber-700 font-bold hover:text-amber-800">
                                    Menyuga qaytish →
                                </a>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8">
                            <template x-if="cart.length > 0">
                                <div class="space-y-4">
                                    <template x-for="item in cart" :key="item.id">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 sm:p-5 rounded-2xl border border-gray-200 bg-gray-50">
                                            <img :src="item.image" :alt="item.name" class="w-full sm:w-24 h-40 sm:h-24 rounded-2xl object-cover">

                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-black text-gray-900 truncate" x-text="item.name"></h3>
                                                <p class="text-amber-600 font-bold mt-1" x-text="formatPrice(item.price)"></p>
                                                <p class="text-sm text-gray-500 mt-1" x-text="`Savatdagi miqdor: ${item.qty}`"></p>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center rounded-2xl border border-gray-200 bg-white overflow-hidden">
                                                    <button type="button" @click="decrease(item.id)" class="px-4 py-3 text-gray-600 hover:bg-gray-100 font-bold">−</button>
                                                    <span class="w-12 text-center font-black text-gray-900" x-text="item.qty"></span>
                                                    <button type="button" @click="increase(item.id)" class="px-4 py-3 text-gray-600 hover:bg-gray-100 font-bold">+</button>
                                                </div>

                                                <button type="button"
                                                        @click="remove(item.id)"
                                                        class="px-4 py-3 rounded-2xl bg-red-50 text-red-600 font-bold hover:bg-red-100 transition">
                                                    O'chirish
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="cart.length === 0">
                                <div class="text-center py-20">
                                    <div class="text-7xl mb-6">🛒</div>
                                    <h3 class="text-3xl font-black text-gray-900 mb-4" style="font-family: var(--font-heading);">
                                        Savat Bo'sh
                                    </h3>
                                    <p class="text-lg text-gray-600 max-w-xl mx-auto mb-8">
                                        Hozircha savatda taom yo'q. Menyuga o'ting va yoqtirgan taomlaringizni qo'shing.
                                    </p>
                                    <a href="{{ route('menu') }}"
                                       class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                                        🍽️ Menyuga O'tish
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Checkout --}}
                <div class="space-y-8">
                    <div class="bg-white rounded-3xl shadow-2xl border-2 border-gray-100 p-8">
                        <h2 class="text-3xl font-black text-gray-900 mb-6" style="font-family: var(--font-heading);">
                            Tasdiqlash
                        </h2>

                        <form method="POST" action="{{ route('order.store') }}" @submit="prepareSubmit($event)" class="space-y-6">
                            @csrf

                            <div>
                                <label for="table_id" class="block text-lg font-bold text-gray-900 mb-3">
                                    🪑 Stol (ixtiyoriy)
                                </label>
                                <select id="table_id"
                                        name="table_id"
                                        x-model="tableId"
                                        class="w-full px-5 py-4 border-2 border-gray-300 rounded-2xl text-base font-semibold focus:border-amber-500 focus:ring-0 transition-colors">
                                    <option value="">Takeaway</option>
                                    @foreach($tables as $table)
                                        <option value="{{ $table->id }}">
                                            {{ $table->name }} - {{ $table->capacity }} kishi
                                            @if($table->location)
                                                ({{ $table->location }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="notes" class="block text-lg font-bold text-gray-900 mb-3">
                                    📝 Izohlar
                                </label>
                                <textarea id="notes"
                                          name="notes"
                                          x-model="notes"
                                          rows="4"
                                          placeholder="Masalan: achchiq bo'lmasin, qo'shimcha salfetka kerak..."
                                          class="w-full px-5 py-4 border-2 border-gray-300 rounded-2xl text-base focus:border-amber-500 focus:ring-0 transition-colors resize-none"></textarea>
                            </div>

                            <input type="hidden" name="cart" :value="serializeCart()">

                            <button type="submit"
                                    :disabled="!cart.length"
                                    :class="!cart.length ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-2xl hover:scale-105'"
                                    class="w-full bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300">
                                ✅ Zakazni Tasdiqlash
                            </button>

                            @error('cart')
                                <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                            @error('table_id')
                                <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                            @error('notes')
                                <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>

                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-8 text-white shadow-2xl">
                        <p class="text-sm uppercase tracking-[0.2em] text-amber-300 font-black mb-3">Jami summa</p>
                        <div class="text-5xl font-black mb-3" style="font-family: var(--font-heading);">
                            <span x-text="formatPrice(total())"></span>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Buyurtma yuborilgach, oshxona uni tayyorlashni boshlaydi.
                        </p>

                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div class="bg-white/10 rounded-2xl p-4">
                                <p class="text-gray-300">Taomlar soni</p>
                                <p class="text-2xl font-black mt-1" x-text="cart.length"></p>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-4">
                                <p class="text-gray-300">Porsiyalar</p>
                                <p class="text-2xl font-black mt-1" x-text="itemCount()"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Suggested Foods --}}
            @if($foods->count() > 0)
            <div class="mt-16">
                <div class="flex items-center justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900" style="font-family: var(--font-heading);">
                            Qo'shimcha Taomlar
                        </h2>
                        <p class="text-gray-600 mt-2">Yana biror narsa kerak bo'lsa, shu yerdan savatga qo'shing.</p>
                    </div>
                    <a href="{{ route('menu') }}" class="text-amber-700 font-bold hover:text-amber-800">
                        To'liq menyu →
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">
                    @foreach($foods as $food)
                        <x-food-card :food="$food" :compact="true" />
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function orderPage() {
        return {
            cart: [],
            tableId: @js(old('table_id', '')),
            notes: @js(old('notes', '')),

            init() {
                this.loadCart();
                window.addEventListener('cart-updated', () => this.loadCart());
            },

            loadCart() {
                try {
                    this.cart = JSON.parse(localStorage.getItem('gr_cart') || '[]');
                } catch (error) {
                    this.cart = [];
                }
            },

            syncCart() {
                localStorage.setItem('gr_cart', JSON.stringify(this.cart));
                window.dispatchEvent(new CustomEvent('cart-updated'));
            },

            increase(id) {
                const item = this.cart.find((entry) => entry.id === id);
                if (!item) return;
                item.qty += 1;
                this.syncCart();
            },

            decrease(id) {
                const item = this.cart.find((entry) => entry.id === id);
                if (!item) return;
                if (item.qty > 1) {
                    item.qty -= 1;
                } else {
                    this.cart = this.cart.filter((entry) => entry.id !== id);
                }
                this.syncCart();
            },

            remove(id) {
                this.cart = this.cart.filter((entry) => entry.id !== id);
                this.syncCart();
            },

            total() {
                return this.cart.reduce((sum, item) => {
                    return sum + ((Number(item.price) || 0) * (Number(item.qty) || 0));
                }, 0);
            },

            itemCount() {
                return this.cart.reduce((sum, item) => sum + (Number(item.qty) || 0), 0);
            },

            formatPrice(value) {
                return new Intl.NumberFormat('uz-UZ').format(Math.round(value)) + " so'm";
            },

            serializeCart() {
                return JSON.stringify(this.cart.map((item) => ({
                    id: item.id,
                    qty: item.qty,
                })));
            },

            prepareSubmit(event) {
                if (!this.cart.length) {
                    event.preventDefault();
                }
            },
        }
    }
</script>
@endpush
