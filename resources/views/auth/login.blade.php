<x-guest-layout>
    <x-slot:title>Entrar na Plataforma</x-slot:title>
    <x-slot:subtitle>Acesse sua conta para continuar</x-slot:subtitle>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="space-y-1">
            <x-input-label for="email" value="Email" class="text-slate-200" />
            <x-text-input id="email" class="block w-full bg-slate-800 border border-white/5 text-white placeholder-slate-400 focus:border-teal-400 focus:ring-teal-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Senha" class="text-slate-200" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-teal-300 hover:text-teal-200 transition">Esqueceu a senha?</a>
                @endif
            </div>
            <x-text-input id="password" class="block w-full bg-slate-800 border border-white/5 text-white placeholder-slate-400 focus:border-teal-400 focus:ring-teal-400" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/10 text-teal-500 focus:ring-teal-400" name="remember">
                <span class="text-slate-300">Lembrar</span>
            </label>
            <a href="{{ route('register') }}" class="text-teal-300 hover:text-teal-200 transition">Criar conta</a>
        </div>

        <div>
            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-6 py-3 rounded-md bg-teal-600 text-white font-semibold border border-teal-700 shadow-lg hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-0 transition">
                <span>Entrar</span>
            </button>
        </div>
    </form>
</x-guest-layout>
