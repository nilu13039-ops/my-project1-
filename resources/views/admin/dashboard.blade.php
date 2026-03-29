@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Xush kelibsiz, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-500 text-sm mt-1">Bugungi statistika va oxirgi faoliyatlar</p>
    </div>

    <!-- Top Stats Row (Today) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 border-l-4 border-l-amber-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Bugungi Daromad</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['today_revenue'], 0, ',', ' ') }}</p>
                    <p class="text-xs text-gray-400 mt-1">so'm</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8.16 5.314l4.897-1.596a2 2 0 001.959 1.531 2 2 0 001.962-1.53L19.84 5.314M7 10a3 3 0 11-6 0 3 3 0 016 0zm8 0a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 border-l-4 border-l-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Bugungi Zakazlar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['today_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 border-l-4 border-l-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Bugungi Rezervatsiyalar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['today_reservations'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 border-l-4 border-l-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Bo'sh Stollar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['available_tables'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 11-2 0 1 1 0 012 0zm-4 2a1 1 0 100-2 1 1 0 000 2zm4 2a1 1 0 11-2 0 1 1 0 012 0zm-4 2a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Row (All Time) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-1">Jami Zakazlar</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-1">Kutilayotgan Zakazlar</p>
            <div class="flex items-center justify-between">
                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_orders'] }}</p>
                @if($stats['pending_orders'] > 0)
                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">⚠️</span>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-1">Jami Rezervatsiyalar</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_reservations'] }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-1">Jami Mijozlar</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
        </div>
    </div>

    <!-- Recent Orders & Reservations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900">So'nggi Zakazlar</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Barchasini ko'rish →</a>
            </div>

            @if($recentOrders->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($recentOrders as $order)
                <div class="px-6 py-4 hover:bg-gray-50 transition flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900">Zakaz #{{ $order->id }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $order->user->name ?? 'Onoq' }} • {{ $order->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-amber-600">{{ number_format($order->total_amount, 0, ',', ' ') }} so'm</p>
                        <div class="mt-1">
                            @if($order->status === 'pending')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                            @elseif($order->status === 'processing')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Jarayonda</span>
                            @elseif($order->status === 'completed')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                            @else
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Bekor</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-8 text-center text-gray-500">
                Zakaz topilmadi
            </div>
            @endif
        </div>

        <!-- Recent Reservations -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900">So'nggi Rezervatsiyalar</h3>
                <a href="{{ route('admin.reservations.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Barchasini ko'rish →</a>
            </div>

            @if($recentReservations->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($recentReservations as $reservation)
                <div class="px-6 py-4 hover:bg-gray-50 transition flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-900">{{ $reservation->table->name ?? '—' }} stoli</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $reservation->user->name }} • {{ $reservation->reservation_date->format('d.m.Y H:i') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-900">{{ $reservation->guests_count }} kishi</p>
                        <div class="mt-1">
                            @if($reservation->status === 'pending')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Tasdiqlangan</span>
                            @elseif($reservation->status === 'completed')
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                            @else
                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Bekor</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-8 text-center text-gray-500">
                Rezervatsiya topilmadi
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
