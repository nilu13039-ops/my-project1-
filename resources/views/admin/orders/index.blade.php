@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Zakazlar</h1>
            <p class="text-gray-500 text-sm mt-1">Barcha zakazlar ro'yxati</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-medium px-5 py-2.5 rounded-lg transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Yangi Zakaz
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mijoz</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jami</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">To'lov</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Holat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sana</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amallar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->table->name ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($order->total_amount, 0, ',', ' ') }} so'm</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($order->payment_status === 'unpaid')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">To'lanmagan</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">To'langan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($order->status === 'pending')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                        @elseif($order->status === 'processing')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Jarayonda</span>
                        @elseif($order->status === 'completed')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Bekor</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3 flex">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-amber-600 hover:text-amber-800 font-medium transition">Ko'rish</a>
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Zakazni o\'chirishni tasdiqlaysizmi?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">O'chirish</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">Zakaz topilmadi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
