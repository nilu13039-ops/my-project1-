@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.categories.index') }}" class="hover:text-gray-700">Kategoriyalar</a>
            <span class="mx-2">/</span>
            <span>Yangi</span>
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Yangi Kategoriya</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Kategoriya nomi</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('name') border-red-500 @enderror">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">Bekor qilish</a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-2.5 rounded-lg transition">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
