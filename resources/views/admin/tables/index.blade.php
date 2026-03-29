@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Stollar</h1>
            <p class="text-gray-500 text-sm mt-1">Restoraning stolları</p>
        </div>
        <a href="{{ route('admin.tables.create') }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-medium px-5 py-2.5 rounded-lg transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Yangi Stol
        </a>
    </div>

    <!-- Status Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Bo'sh</p>
                <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['available'] ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5 11a1 1 0 110-2h.01a1 1 0 110 2H5zm4-4a1 1 0 110-2h6a1 1 0 110 2H9zm0 4a1 1 0 110-2h3a1 1 0 110 2H9z"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Band</p>
                <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['reserved'] ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center gap-3">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v1h4a1 1 0 010 2h-1v11a2 2 0 01-2 2H4a2 2 0 01-2-2V5H1a1 1 0 010-2h4V2zM7 8a1 1 0 110 2v4a1 1 0 110-2V8zm4 0a1 1 0 110 2v4a1 1 0 110-2V8z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">To'liq band</p>
                <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['occupied'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nomi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sig'im</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Joylashuv</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Holat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amallar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tables as $table)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $table->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $table->capacity }} kishi</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $table->location ?? '—' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($table->status === 'available')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Bo'sh</span>
                        @elseif($table->status === 'reserved')
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Band</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">To'liq band</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3 flex">
                        <a href="{{ route('admin.tables.edit', $table) }}" class="text-amber-600 hover:text-amber-800 font-medium transition">Tahrirlash</a>
                        <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="inline" onsubmit="return confirm('Stolni o\'chirishni tasdiqlaysizmi?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">O'chirish</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Stol topilmadi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $tables->links() }}
        </div>
    </div>
</div>
@endsection
