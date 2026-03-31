<x-guest-layout>
    <!-- Session Status -->
    @if(session('status'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg">
        <p class="font-bold">✓ {{ session('status') }}</p>
    </div>
    @endif

    <!-- Header -->
    <div class="mb-10 text-center">
        <p class="text-amber-600 text-sm font-bold uppercase tracking-widest mb-3">Akkauntingizga Kirish</p>
        <h1 class="text-4xl font-black text-gray-900 mb-3" style="font-family: 'Playfair Display', serif;">
            Assalomu Aleykum 👋
        </h1>
        <p class="text-gray-600">Grand Restoranga qaytib kelgani uchun raxmat</p>
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

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="block text-sm font-bold text-gray-900 mb-3">
                📧 Elektron Pochta
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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
            @error('password')
            <p class="text-red-600 text-sm mt-3 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" value="true"
                class="w-5 h-5 rounded border-gray-300 text-amber-600 focus:ring-amber-500 cursor-pointer">
            <label for="remember_me" class="ms-3 text-sm text-gray-700 cursor-pointer">
                Meni yod tuting
            </label>
        </div>

        <!-- Sign In Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-black text-lg py-4 px-6 rounded-xl shadow-xl shadow-amber-600/40 transition-all duration-300 hover:shadow-amber-600/60 hover:scale-105 active:scale-95">
                🚀 Kirish
            </button>
        </div>

        <!-- Forgot Password & Register Links -->
        <div class="border-t-2 border-gray-100 pt-6 space-y-4">
            @if(Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-amber-600 hover:text-amber-700 font-bold text-sm transition">
                    Parolni unutdingizmi?
                </a>
            </div>
            @endif

            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Akkauntingiz yo'qmi?
                    <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-700 font-bold">Ro'yxatdan o'tish</a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>
