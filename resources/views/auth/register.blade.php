<x-guest-layout>
    <!-- Header -->
    <div class="mb-10 text-center">
        <p class="text-amber-600 text-sm font-bold uppercase tracking-widest mb-3">Yangi Akkaunt</p>
        <h1 class="text-4xl font-black text-gray-900 mb-3" style="font-family: 'Playfair Display', serif;">
            Ro'yxatdan O'tish 🎉
        </h1>
        <p class="text-gray-600">Grand Restoran oilasiga qo'shiling</p>
    </div>

    <!-- Errors -->
    @if($errors->any())
    <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
        <p class="text-red-800 font-bold mb-4">⚠️ Xato topildi:</p>
        <ul class="space-y-2 text-red-700 text-sm">
            @foreach($errors->all() as $error)
            <li class="flex items-start gap-2">
                <span class="font-bold">•</span>
                <span>{{ $error }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="block text-sm font-bold text-gray-900 mb-3">
                👤 To'liq Ismingiz
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                placeholder="Ismingizni kiriting"
                class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 focus:border-amber-600 focus:ring-2 focus:ring-amber-500/50 py-4 px-5 text-lg transition hover:border-amber-500 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone" class="block text-sm font-bold text-gray-900 mb-3">
                📱 Telefon Raqami (ixtiyoriy)
            </label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                placeholder="+998 90 000 00 00"
                class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 focus:border-amber-600 focus:ring-2 focus:ring-amber-500/50 py-4 px-5 text-lg transition hover:border-amber-500 @error('phone') border-red-500 @enderror">
            <p class="text-gray-500 text-xs mt-2">Buyurtma va bron uchun foydalanamiz</p>
            @error('phone')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="block text-sm font-bold text-gray-900 mb-3">
                📧 Elektron Pochta
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                placeholder="sizingiz@example.com"
                class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 focus:border-amber-600 focus:ring-2 focus:ring-amber-500/50 py-4 px-5 text-lg transition hover:border-amber-500 @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="block text-sm font-bold text-gray-900 mb-3">
                🔒 Parol
            </label>
            <input id="password" type="password" name="password" required
                placeholder="••••••••"
                class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 focus:border-amber-600 focus:ring-2 focus:ring-amber-500/50 py-4 px-5 text-lg transition hover:border-amber-500 @error('password') border-red-500 @enderror">
            <p class="text-gray-500 text-xs mt-2">Kamida 8 ta belgi</p>
            @error('password')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-3">
                🔐 Parolni Tasdiqlang
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                placeholder="••••••••"
                class="w-full rounded-xl border-2 border-gray-300 bg-white text-gray-900 focus:border-amber-600 focus:ring-2 focus:ring-amber-500/50 py-4 px-5 text-lg transition hover:border-amber-500 @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Register Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-black text-lg py-4 px-6 rounded-xl shadow-xl shadow-amber-600/40 transition-all duration-300 hover:shadow-amber-600/60 hover:scale-105 active:scale-95">
                ✓ Ro'yxatdan O'tish
            </button>
        </div>

        <!-- Login Link -->
        <div class="border-t-2 border-gray-100 pt-6 text-center">
            <p class="text-gray-600 text-sm">
                Allaqachon akkauntingiz bormi?
                <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700 font-bold">Kirish</a>
            </p>
        </div>
    </form>
</x-guest-layout>
