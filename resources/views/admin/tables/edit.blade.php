@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.tables.index') }}" class="hover:text-gray-700">Stollar</a>
            <span class="mx-2">/</span>
            <span>Tahrirlash</span>
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Stolni Tahrirlash</h2>

        <form action="{{ route('admin.tables.update', $table) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Stol nomi</label>
                <input type="text" id="name" name="name" value="{{ old('name', $table->name) }}" placeholder="Masa 1, VIP 3" required
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('name') border-red-500 @enderror">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Capacity Field -->
            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Sig'im (odam soni)</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $table->capacity) }}" min="1" max="50" required
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('capacity') border-red-500 @enderror">
                @error('capacity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location Field -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Joylashuv</label>
                <input type="text" id="location" name="location" value="{{ old('location', $table->location) }}" placeholder="Ichki zal, Teras"
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('location') border-red-500 @enderror">
                @error('location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Select -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Holat</label>
                <select id="status" name="status" required
                        class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('status') border-red-500 @enderror">
                    <option value="">Holatni tanlang</option>
                    <option value="available" {{ old('status', $table->status) === 'available' ? 'selected' : '' }}>Bo'sh</option>
                    <option value="reserved" {{ old('status', $table->status) === 'reserved' ? 'selected' : '' }}>Band</option>
                    <option value="occupied" {{ old('status', $table->status) === 'occupied' ? 'selected' : '' }}>To'liq band</option>
                </select>
                @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.tables.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">Bekor qilish</a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-2.5 rounded-lg transition">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
