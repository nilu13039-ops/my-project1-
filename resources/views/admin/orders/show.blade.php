@extends('admin.layouts.app')

@section('content')
<div>
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-gray-700">Zakazlar</a>
            <span class="mx-2">/</span>
            <span>#{{ $order->id }}</span>
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left - Items -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Items Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Zakaz #{{ $order->id }} tafsilotlari</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Taom</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Narx</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Miqdor</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Jami</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->orderItems as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->food->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-sm text-right text-gray-500">{{ number_format($item->price, 0, ',', ' ') }} so'm</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-900">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} so'm</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Summary -->
                <div class="mt-6 pt-6 border-t flex justify-end">
                    <div class="text-right">
                        <p class="text-sm text-gray-500 mb-1">Jami:</p>
                        <p class="text-3xl font-bold text-amber-600">{{ number_format($order->total_amount, 0, ',', ' ') }} so'm</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right - Status & Info -->
        <div class="space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h3 class="font-bold text-gray-900 mb-4">Ma'lumot</h3>

                @if($order->user)
                <div class="mb-4 pb-4 border-b">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Mijoz</p>
                    <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                    <p class="text-sm text-gray-500">{{ $order->user->phone ?? '—' }}</p>
                </div>
                @endif

                @if($order->table)
                <div class="mb-4 pb-4 border-b">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Stol</p>
                    <p class="font-medium text-gray-900">{{ $order->table->name }}</p>
                    <p class="text-sm text-gray-500">Sig'im: {{ $order->table->capacity }} kishi</p>
                </div>
                @else
                <div class="mb-4 pb-4 border-b">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Stol</p>
                    <p class="text-sm text-gray-500">Takeaway</p>
                </div>
                @endif

                <div class="mb-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Yaratilgan</p>
                    <p class="font-medium text-gray-900">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h3 class="font-bold text-gray-900 mb-4">Holat o'zgartirish</h3>

                <div class="mb-4 space-y-2">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Zakaz holati</p>
                        <div>
                            @if($order->status === 'pending')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                            @elseif($order->status === 'processing')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Jarayonda</span>
                            @elseif($order->status === 'completed')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Bekor</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">To'lov holati</p>
                        <div>
                            @if($order->payment_status === 'unpaid')
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">To'lanmagan</span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">To'langan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Zakaz holati</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 transition">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Kutilmoqda</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Jarayonda</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Bajarilgan</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Bekor</option>
                        </select>
                    </div>

                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">To'lov holati</label>
                        <select id="payment_status" name="payment_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 transition">
                            <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>To'lanmagan</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>To'langan</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-2.5 rounded-lg transition">
                        Saqlash
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t">
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Zakazni o\'chirishni tasdiqlaysizmi?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-medium px-6 py-2.5 rounded-lg transition">
                            Zakazni o'chirish
                        </button>
                    </form>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('admin.orders.index') }}" class="block text-center text-gray-600 hover:text-gray-900 font-medium transition">
                        ← Orqaga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
