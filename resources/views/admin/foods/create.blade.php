@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <p class="text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.foods.index') }}" class="hover:text-gray-700">Taomlar</a>
            <span class="mx-2">/</span>
            <span>Yangi</span>
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Yangi Taom Qo'shish</h2>

        <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Category Select -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategoriya</label>
                <select id="category_id" name="category_id" required
                        class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('category_id') border-red-500 @enderror">
                    <option value="">Kategoriyani tanlang</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Taom nomi</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('name') border-red-500 @enderror">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Tavsif</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Field -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Narx (so'm)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 focus:ring-amber-500 transition @error('price') border-red-500 @enderror">
                @error('price')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Rasm (ixtiyoriy)</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm border focus:border-amber-500 transition @error('image') border-red-500 @enderror">
                @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability Checkbox -->
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                    <span class="text-sm font-medium text-gray-700">Mavjud</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.foods.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">Bekor qilish</a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-2.5 rounded-lg transition">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
