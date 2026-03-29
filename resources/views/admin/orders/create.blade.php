@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-gray-700">Zakazlar</a>
            <span class="mx-2">/</span>
            <span>Yangi</span>
        </p>
    </div>

    <div x-data="orderForm()" class="space-y-6">
        <!-- Order Info Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Yangi Zakaz</h2>

            <form @submit.prevent="submitForm()" class="space-y-6">
                <!-- Table Select -->
                <div>
                    <label for="table_id" class="block text-sm font-medium text-gray-700 mb-2">Stol (ixtiyoriy)</label>
                    <select id="table_id" name="table_id" x-model="tableId" class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition">
                        <option value="">Stol yo'q (takeaway)</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }} ({{ $table->location }}) - {{ $table->capacity }} kishi</option>
                        @endforeach
                    </select>
                </div>

                <!-- Payment Status -->
                <div>
                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">To'lov holati</label>
                    <select id="payment_status" name="payment_status" x-model="paymentStatus" class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition">
                        <option value="unpaid">To'lanmagan</option>
                        <option value="paid">To'langan</option>
                    </select>
                </div>

                <!-- Items Section -->
                <div class="border-t pt-6">
                    <h3 class="font-bold text-gray-900 mb-4">Taomlar</h3>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex gap-4 items-end mb-4 bg-gray-50 p-4 rounded-lg">
                            <!-- Food Select -->
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Taom</label>
                                <select :name="`items[${index}][food_id]`" x-model="item.food_id" @change="updatePrice(item)" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500 transition">
                                    <option value="">Tanlang</option>
                                    @foreach($foods as $food)
                                        <option value="{{ $food->id }}" @if($loop->first) x-text="`{{ $food->name }} - {{ number_format($food->price,0,',',' ') }} so'm`" @endif>{{ $food->name }} - {{ number_format($food->price, 0, ',', ' ') }} so'm</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="w-24">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Miqdor</label>
                                <input type="number" :name="`items[${index}][quantity]`" x-model.number="item.quantity" @input="updateTotal()" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500 transition">
                            </div>

                            <!-- Price -->
                            <div class="w-32">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Jami</label>
                                <p class="px-3 py-2 text-sm font-medium text-amber-600">
                                    <span x-text="formatPrice(item.price * item.quantity)"></span>
                                </p>
                            </div>

                            <!-- Remove Button -->
                            <button type="button" @click="removeItem(index)" class="text-red-500 hover:text-red-700 font-medium px-3 py-2 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                O'chirish
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="addItem()" class="text-amber-600 hover:text-amber-700 font-medium px-4 py-2 bg-amber-50 hover:bg-amber-100 rounded-lg transition">
                        + Taom qo'shish
                    </button>
                </div>

                <!-- Total -->
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 flex justify-between items-center">
                    <span class="font-bold text-gray-900">Jami:</span>
                    <span class="text-2xl font-bold text-amber-600">
                        <span x-text="formatPrice(total)"></span>
                    </span>
                </div>

                <!-- Hidden Inputs for Form Submit -->
                <input type="hidden" name="table_id" :value="tableId">
                <input type="hidden" name="payment_status" :value="paymentStatus">

                <!-- Submit Button -->
                <div class="flex gap-4 pt-4 border-t">
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">Bekor qilish</a>
                    <button type="submit" class="ml-auto bg-amber-600 hover:bg-amber-700 text-white font-medium px-8 py-2.5 rounded-lg transition">
                        Zakaz Yaratish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function orderForm() {
    return {
        items: [{ food_id: '', quantity: 1, price: 0 }],
        total: 0,
        tableId: '',
        paymentStatus: 'unpaid',
        foods: @json($foods->keyBy('id')),

        addItem() {
            this.items.push({ food_id: '', quantity: 1, price: 0 });
        },

        removeItem(index) {
            this.items.splice(index, 1);
            this.updateTotal();
        },

        updatePrice(item) {
            if (item.food_id && this.foods[item.food_id]) {
                item.price = this.foods[item.food_id].price;
            } else {
                item.price = 0;
            }
            this.updateTotal();
        },

        updateTotal() {
            this.total = this.items.reduce((sum, item) => {
                return sum + (item.price * item.quantity);
            }, 0);
        },

        formatPrice(value) {
            return new Intl.NumberFormat('uz-UZ').format(Math.round(value)) + " so'm";
        },

        submitForm() {
            // This will submit the form normally
            document.querySelector('form').submit();
        }
    };
}
</script>
@endsection
