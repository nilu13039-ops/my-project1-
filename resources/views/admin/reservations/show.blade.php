@extends('admin.layouts.app')

@section('content')
<div>
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.reservations.index') }}" class="hover:text-gray-700">Rezervatsiyalar</a>
            <span class="mx-2">/</span>
            <span>#{{ $reservation->id }}</span>
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left - Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Rezervatsiya #{{ $reservation->id }}</h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Mijoz</p>
                            <p class="font-medium text-gray-900">{{ $reservation->user->name ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email</p>
                            <p class="font-medium text-gray-900">{{ $reservation->user->email ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tel raqam</p>
                            <p class="font-medium text-gray-900">{{ $reservation->user->phone ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Stol</p>
                            <p class="font-medium text-gray-900">{{ $reservation->table->name ?? '—' }} ({{ $reservation->table->capacity ?? '—' }} kishi)</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Band qilish sanasi</p>
                            <p class="font-medium text-gray-900">{{ $reservation->reservation_date->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Band qilish vaqti</p>
                            <p class="font-medium text-gray-900">{{ $reservation->reservation_time }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Mehmonlar soni</p>
                            <p class="font-medium text-gray-900">{{ $reservation->guests_count }} kishi</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Yaratilgan</p>
                            <p class="font-medium text-gray-900">{{ $reservation->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>

                    @if($reservation->notes)
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-500 mb-2">Izoh</p>
                        <p class="text-gray-900">{{ $reservation->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right - Status Update -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h3 class="font-bold text-gray-900 mb-4">Holat o'zgartirish</h3>

                <div class="mb-4">
                    @if($reservation->status === 'pending')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                    @elseif($reservation->status === 'confirmed')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">Tasdiqlangan</span>
                    @elseif($reservation->status === 'completed')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                    @else
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">Bekor</span>
                    @endif
                </div>

                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Yangi holat</label>
                        <select id="status" name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 transition">
                            <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Kutilmoqda</option>
                            <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Tasdiqlangan</option>
                            <option value="completed" {{ $reservation->status === 'completed' ? 'selected' : '' }}>Bajarilgan</option>
                            <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Bekor</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-2.5 rounded-lg transition">
                        Saqlash
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t">
                    <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Rezervatsiyani o\'chirishni tasdiqlaysizmi?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-medium px-6 py-2.5 rounded-lg transition">
                            Rezervatsiyani o'chirish
                        </button>
                    </form>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="{{ route('admin.reservations.index') }}" class="block text-center text-gray-600 hover:text-gray-900 font-medium transition">
                        ← Orqaga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
