@extends('layouts.app')

@section('title', 'Profilni O\'zgartirish')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl font-black mb-6"
                style="font-family: var(--font-heading);">
                ⚙️ Profilni O'zgartirish
            </h1>
            <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                Shaxsiy ma'lumotlaringizni yangilang va profilingizni
                doimo yangilab turing.
            </p>
        </div>
    </section>

    {{-- Profile Form --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl border-2 border-gray-100 overflow-hidden">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-8 py-6 border-b-2 border-gray-200">
                    <h2 class="text-3xl font-black text-gray-900 text-center">
                        👤 Shaxsiy Ma'lumotlar
                    </h2>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('profile.update') }}" class="p-8 space-y-8">
                    @csrf
                    @method('patch')

                    {{-- Profile Picture Section --}}
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-6xl">👤</span>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Profil rasmini keyinroq qo'shish imkoni mavjud bo'ladi
                        </p>
                    </div>

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-lg font-bold text-gray-900 mb-4">
                            👤 Ism Familiya
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg font-semibold focus:border-amber-500 focus:ring-0 transition-colors"
                               required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-lg font-bold text-gray-900 mb-4">
                            📧 Elektron Pochta
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg font-semibold focus:border-amber-500 focus:ring-0 transition-colors"
                               required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <p class="text-sm text-gray-600 mt-2">
                            Sizning elektron pochtangiz tasdiqlanmagan.
                            <a href="{{ route('verification.send') }}"
                               class="text-amber-600 hover:text-amber-700 font-semibold">
                                Tasdiqlash havolasini qayta yuborish
                            </a>
                        </p>
                        @endif
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-lg font-bold text-gray-900 mb-4">
                            📱 Telefon Raqami
                        </label>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="+998 XX XXX XX XX"
                               class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg font-semibold focus:border-amber-500 focus:ring-0 transition-colors">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- Account Info --}}
                    <div class="bg-gray-50 rounded-2xl p-6">
                        <h3 class="text-xl font-black text-gray-900 mb-4">📊 Akkaunt Ma'lumotlari</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">Ro'yxatdan o'tgan sana</p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ $user->created_at->format('d.m.Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">Akkaunt ID</p>
                                <p class="text-lg font-bold text-gray-900">#{{ $user->id }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center pt-8">
                        <button type="submit"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-12 py-4 rounded-2xl font-bold text-xl transition-all duration-300 hover:shadow-2xl hover:scale-105">
                            💾 Saqlash
                        </button>
                    </div>
                </form>
            </div>

            {{-- Danger Zone --}}
            <div class="mt-12 bg-red-50 border-2 border-red-200 rounded-3xl p-8">
                <h3 class="text-2xl font-black text-red-900 mb-4">⚠️ Xavfli Zona</h3>
                <p class="text-red-700 mb-6">
                    Bu harakatni bekor qilib bo'lmaydi. Bu sizning akkauntingizni butunlay
                    o'chirib tashlaydi va barcha ma'lumotlaringiz yo'qoladi.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}"
                      onsubmit="return confirm('Haqiqatan ham akkauntingizni o\'chirmoqchimisiz? Bu harakat bekor qilib bo\'lmaydi.')"
                      class="inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-2xl font-bold transition-all duration-300 hover:shadow-lg">
                        🗑️ Akkauntni O'chirish
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection