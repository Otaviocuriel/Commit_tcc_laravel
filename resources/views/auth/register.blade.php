<x-guest-layout>
    <x-slot:title>Criar Conta</x-slot:title>
    <x-slot:subtitle>Preencha os dados para começar</x-slot:subtitle>

    <form method="POST" action="{{ route('register') }}" x-data="{ role: '{{ old('role','user') }}' }" class="space-y-6">
        @csrf

        <div class="space-y-1">
            <x-input-label for="name" value="Nome" class="text-slate-200" />
            <x-text-input id="name" class="block w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-emerald-400 focus:ring-emerald-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="space-y-1">
            <x-input-label for="role" value="Tipo de Conta" class="text-slate-200" />
            <select id="role" name="role" x-model="role" class="block w-full bg-white/10 border-white/20 text-white rounded-md focus:border-emerald-400 focus:ring-emerald-400">
                <option class="text-gray-900" value="user">Usuário Comprador</option>
                <option class="text-gray-900" value="company">Empresa Fornecedora</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        <div class="space-y-1">
            <x-input-label for="email" value="Email" class="text-slate-200" />
            <x-text-input id="email" class="block w-full bg-white/10 border-white/20 text-white placeholder-slate-400 focus:border-emerald-400 focus:ring-emerald-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Pessoa Física -->
        <div class="grid gap-6" x-show="role === 'user'" x-cloak>
            <div class="space-y-1">
                <x-input-label for="cpf" value="CPF" class="text-slate-200" />
                <x-text-input id="cpf" type="text" name="cpf" :value="old('cpf')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" maxlength="14" data-mask="cpf" />
                <x-input-error :messages="$errors->get('cpf')" class="mt-1" />
            </div>
            <div class="space-y-1">
                <x-input-label for="data_nascimento" value="Data de Nascimento" class="text-slate-200" />
                <x-text-input id="data_nascimento" type="date" name="data_nascimento" :value="old('data_nascimento')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" />
                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-1" />
            </div>
        </div>

        <!-- Empresa -->
        <div class="grid gap-6" x-show="role === 'company'" x-cloak>
            <div class="space-y-1">
                <x-input-label for="cnpj" value="CNPJ" class="text-slate-200" />
                <x-text-input id="cnpj" type="text" name="cnpj" :value="old('cnpj')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" maxlength="18" data-mask="cnpj" />
                <x-input-error :messages="$errors->get('cnpj')" class="mt-1" />
            </div>
            <div class="space-y-1">
                <x-input-label for="cargo" value="Cargo" class="text-slate-200" />
                <x-text-input id="cargo" type="text" name="cargo" :value="old('cargo')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" />
                <x-input-error :messages="$errors->get('cargo')" class="mt-1" />
            </div>
        </div>

        <!-- Comuns -->
        <div class="space-y-1">
            <x-input-label for="telefone" value="Telefone" class="text-slate-200" />
            <x-text-input id="telefone" type="text" name="telefone" :value="old('telefone')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" data-mask="telefone" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-1" />
        </div>
        <div class="space-y-1">
            <x-input-label for="cep" value="CEP" class="text-slate-200" />
            <x-text-input id="cep" type="text" name="cep" :value="old('cep')" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" maxlength="10" data-mask="cep" />
            <x-input-error :messages="$errors->get('cep')" class="mt-1" />
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <x-input-label for="password" value="Senha" class="text-slate-200" />
                <x-text-input id="password" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <div class="space-y-1">
                <x-input-label for="password_confirmation" value="Confirmar Senha" class="text-slate-200" />
                <x-text-input id="password_confirmation" class="block w-full bg-white/10 border-white/20 text-white focus:border-emerald-400 focus:ring-emerald-400" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <div class="flex items-center justify-between text-xs">
            <a href="{{ route('login') }}" class="text-emerald-300 hover:text-emerald-200 transition">Já registrado?</a>
            <button type="submit" class="inline-flex justify-center items-center gap-2 px-6 py-3 rounded-md bg-gradient-to-r from-emerald-500 to-indigo-600 text-white font-semibold shadow-lg shadow-emerald-600/30 hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-0 transition">
                <span>Criar Conta</span>
            </button>
        </div>
    </form>
</x-guest-layout>
