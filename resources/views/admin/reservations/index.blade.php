@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Rezervatsiyalar</h1>
            <p class="text-gray-500 text-sm mt-1">Barcha stollarning band qilinishlari</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex gap-4 flex-wrap">
        <form method="GET" action="{{ route('admin.reservations.index') }}" class="flex gap-4 flex-wrap">
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 transition">
                    <option value="">Barcha holatlar</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Kutilmoqda</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Tasdiqlangan</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Bajarilgan</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Bekor</option>
                </select>
            </div>
            <div>
                <input type="date" name="date" value="{{ request('date') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 transition">
            </div>
            <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition font-medium">Filtr</button>
            @if(request('status') || request('date'))
            <a href="{{ route('admin.reservations.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition font-medium">Bekor</a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mijoz</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tel</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sana</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Vaqt</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mehmonlar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Holat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amallar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reservations as $reservation)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $reservation->user->name ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->user->phone ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->table->name ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->reservation_date->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->reservation_time }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->guests_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($reservation->status === 'pending')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Kutilmoqda</span>
                        @elseif($reservation->status === 'confirmed')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Tasdiqlangan</span>
                        @elseif($reservation->status === 'completed')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bajarilgan</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Bekor</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3 flex">
                        <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-amber-600 hover:text-amber-800 font-medium transition">Ko'rish</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Rezervatsiyani o\'chirishni tasdiqlaysizmi?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">O'chirish</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">Rezervatsiya topilmadi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $reservations->links() }}
        </div>
    </div>
</div>
@endsection
