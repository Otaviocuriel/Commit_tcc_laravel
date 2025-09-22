
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login — Blockchain Verde</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak]{display:none!important}
        .page-bg {
            background: radial-gradient(800px 400px at 85% 35%, rgba(200,245,235,0.06), transparent 10%),
                                    linear-gradient(135deg, #0b1220 0%, #1f2937 30%, #14505b 60%, #071029 100%);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card-glass { background-color: rgba(255,255,255,0.04); }
    </style>
</head>
<body class="min-h-screen page-bg flex items-center justify-center">
    <div class="w-full max-w-3xl mx-auto p-6">
        <div class="card-glass backdrop-blur-lg rounded-2xl border border-white/10 shadow-2xl overflow-hidden">
            <div class="grid grid-cols-12">
                <div class="col-span-12 md:col-span-5 bg-gradient-to-b from-slate-900/60 to-teal-900/40 p-8 flex flex-col items-center justify-center">
                    <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-1">Entrar</h2>
                    <p class="text-sm text-white/60">Acesse sua conta para continuar</p>
                </div>
                <div class="col-span-12 md:col-span-7 p-8">
                    @if (session('status'))
                        <div class="mb-4 text-sm text-teal-500">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm text-white/80">Email</label>
                            <input id="email" name="email" type="email" class="mt-1 w-full px-3 py-2 rounded-md bg-slate-800 text-white border border-white/5" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="block text-sm text-white/80">Senha</label>
                            <input id="password" name="password" type="password" class="mt-1 w-full px-3 py-2 rounded-md bg-slate-800 text-white border border-white/5" required autocomplete="current-password">
                            @error('password')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/10 text-teal-500 focus:ring-teal-400" name="remember">
                                <span class="text-slate-300">Lembrar</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-teal-300 hover:text-teal-200 transition">Esqueceu a senha?</a>
                            @endif
                        </div>
                        <div class="flex flex-col md:flex-row gap-3">
                            <button type="submit" class="flex-1 py-3 rounded-md bg-teal-600 hover:bg-cyan-600 text-white font-semibold shadow-md border border-teal-700">Entrar</button>
                            <a href="{{ route('register') }}" class="flex-1 py-3 rounded-md bg-transparent text-white/80 font-semibold text-center border border-white/10 hover:bg-white/5">Criar conta</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
