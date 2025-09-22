@extends('layouts.app')

@section('content')
<section class="bg-white dark:bg-gray-900 py-12 border-b border-gray-200 dark:border-gray-800">
  <div class="max-w-4xl mx-auto px-6">
    <h1 class="text-3xl md:text-4xl font-bold text-green-700 dark:text-green-400 mb-6 text-center">Bem-vindo ao nosso portal de Energia Renovável com Blockchain!</h1>
    <p class="text-lg text-gray-700 dark:text-gray-200 mb-6 text-center">Este site foi desenvolvido para conectar empresas fornecedoras de energia renovável com usuários interessados na compra direta dessa energia, promovendo um ambiente seguro, transparente e sustentável.</p>
    <div class="bg-green-50 dark:bg-green-900/30 rounded-xl p-6 mb-6 shadow">
      <h2 class="text-2xl font-semibold text-green-800 dark:text-green-300 mb-4">Como funciona</h2>
      <ul class="space-y-3 text-base text-gray-800 dark:text-gray-100">
        <li>Visualizar todas as ofertas disponíveis e filtrar por preço, quantidade ou tipo de energia.</li>
        <li>Consultar informações detalhadas das empresas fornecedoras, incluindo histórico e avaliações.</li>
        <li>Enviar pedidos de compra diretamente pela plataforma.</li>
        <li>Deixar comentários ou mensagens nas ofertas para tirar dúvidas ou negociar condições.</li>
        <li>Registrar vendas na blockchain para garantir rastreabilidade e segurança.</li>
      </ul>
    </div>
    <div class="grid md:grid-cols-4 gap-8 mt-8">
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-emerald-100 to-white dark:from-emerald-900 dark:to-gray-900 flex flex-col items-center text-center">
        <div class="text-5xl mb-3">👤</div>
        <h3 class="font-bold text-lg mb-2 text-emerald-700 dark:text-emerald-300">Usuário Comprador</h3>
        <p class="mb-2 text-gray-700 dark:text-gray-200">Compre energia renovável direto das empresas, com segurança e rastreabilidade.</p>
        <ul class="list-none text-sm text-gray-800 dark:text-gray-100 space-y-1">
          <li>• Ofertas filtráveis</li>
          <li>• Histórico e avaliações</li>
          <li>• Comentários e negociação</li>
        </ul>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-yellow-100 to-white dark:from-yellow-900 dark:to-gray-900 flex flex-col items-center text-center">
        <div class="text-5xl mb-3">🏭</div>
        <h3 class="font-bold text-lg mb-2 text-yellow-700 dark:text-yellow-300">Empresa Fornecedora</h3>
        <p class="mb-2 text-gray-700 dark:text-gray-200">Venda energia renovável, publique ofertas e conquiste confiança no mercado.</p>
        <ul class="list-none text-sm text-gray-800 dark:text-gray-100 space-y-1">
          <li>• Gestão de ofertas</li>
          <li>• Resposta a pedidos</li>
          <li>• Registro na blockchain</li>
        </ul>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-indigo-100 to-white dark:from-indigo-900 dark:to-gray-900 flex flex-col items-center text-center">
        <div class="text-5xl mb-3">💹</div>
        <h3 class="font-bold text-lg mb-2 text-indigo-700 dark:text-indigo-300">Investidor</h3>
        <p class="mb-2 text-gray-700 dark:text-gray-200">Invista em projetos de energia renovável e acompanhe indicadores ESG.</p>
        <ul class="list-none text-sm text-gray-800 dark:text-gray-100 space-y-1">
          <li>• Portfólio sustentável</li>
          <li>• Indicadores verdes</li>
        </ul>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-pink-100 to-white dark:from-pink-900 dark:to-gray-900 flex flex-col items-center text-center">
        <div class="text-5xl mb-3">🔬</div>
        <h3 class="font-bold text-lg mb-2 text-pink-700 dark:text-pink-300">Pesquisador</h3>
        <p class="mb-2 text-gray-700 dark:text-gray-200">Acesse dados, estudos e relatórios sobre energia e blockchain.</p>
        <ul class="list-none text-sm text-gray-800 dark:text-gray-100 space-y-1">
          <li>• Métricas abertas</li>
          <li>• Relatórios técnicos</li>
        </ul>
      </div>
    </div>
  </div>
</section>
{{-- HERO SECTION --}}
<section class="relative overflow-hidden">
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-[1px]"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 -left-10 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl"></div>
  </div>
  <div class="relative max-w-7xl mx-auto px-6 pt-28 pb-32 flex flex-col lg:flex-row items-center gap-14">
    <div class="flex-1 text-white">
      <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs tracking-wide mb-5 border border-white/20">Sustentabilidade • Transparência • Inovação</div>
      <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
        Energia renovável com<br>
        <span class="text-emerald-400">confiança em Blockchain</span>
      </h1>
      <p class="text-base md:text-lg text-slate-200 leading-relaxed mb-8 max-w-xl">Conectamos empresas fornecedoras e consumidores para transações energéticas rastreáveis, seguras e com impacto ambiental positivo comprovado.</p>
      <div class="flex flex-wrap gap-4">
        @guest
          <a href="{{ route('register') }}" class="px-8 py-3 rounded-md bg-emerald-500 hover:bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-600/20 transition">Quero Participar</a>
          <a href="{{ route('login') }}" class="px-8 py-3 rounded-md bg-white/10 hover:bg-white/20 text-white font-medium transition">Já tenho conta</a>
        @else
          <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-md bg-emerald-500 hover:bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-600/20 transition">Ir para Dashboard</a>
        @endguest
      </div>
      <div class="mt-10 flex items-center gap-6 text-xs text-slate-300">
        <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-400"></span> Emissão de dados auditáveis</div>
        <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-400"></span> Foco em impacto real</div>
      </div>
    </div>
    <div class="flex-1 w-full grid sm:grid-cols-2 gap-5">
      <div class="p-5 rounded-2xl bg-gradient-to-br from-white/15 to-white/5 border border-white/10 backdrop-blur shadow-xl">
        <h3 class="font-semibold text-white mb-2">👤 Usuário Comprador</h3>
        <p class="text-slate-200 text-sm mb-3">Acesse ofertas confiáveis e acompanhe o histórico das transações.</p>
        <ul class="text-xs space-y-1 text-slate-300 list-disc list-inside">
          <li>Filtros de origem e preço</li>
          <li>Rastreamento certificado</li>
          <li>Interação com fornecedores</li>
        </ul>
      </div>
      <div class="p-5 rounded-2xl bg-gradient-to-br from-white/15 to-white/5 border border-white/10 backdrop-blur shadow-xl">
        <h3 class="font-semibold text-white mb-2">🏭 Empresa Fornecedora</h3>
        <p class="text-slate-200 text-sm mb-3">Publique energia disponível e fortaleça credibilidade.</p>
        <ul class="text-xs space-y-1 text-slate-300 list-disc list-inside">
          <li>Gestão de ofertas</li>
          <li>Pedidos centralizados</li>
          <li>Relatórios e métricas</li>
        </ul>
      </div>
      <div class="p-5 rounded-2xl bg-gradient-to-br from-white/15 to-white/5 border border-white/10 backdrop-blur shadow-xl">
        <h3 class="font-semibold text-white mb-2">💹 Investidor</h3>
        <p class="text-slate-200 text-sm mb-3">Em breve: acompanhamento de retorno e impacto ESG.</p>
        <ul class="text-xs space-y-1 text-slate-300 list-disc list-inside">
          <li>Indicadores verdes</li>
          <li>Portfólio sustentável</li>
        </ul>
      </div>
      <div class="p-5 rounded-2xl bg-gradient-to-br from-white/15 to-white/5 border border-white/10 backdrop-blur shadow-xl">
        <h3 class="font-semibold text-white mb-2">🔬 Pesquisador</h3>
        <p class="text-slate-200 text-sm mb-3">Acesso planejado a dados abertos e análises setoriais.</p>
        <ul class="text-xs space-y-1 text-slate-300 list-disc list-inside">
          <li>Base de métricas</li>
          <li>Relatórios técnicos</li>
        </ul>
      </div>
    </div>
  </div>
</section>

{{-- PASSOS --}}
<section class="py-24 bg-white dark:bg-gray-950 relative overflow-hidden">
  <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_30%_20%,rgba(16,185,129,0.07),transparent_60%)]"></div>
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-12 text-center">Como funciona</h2>
    <div class="grid md:grid-cols-3 gap-10">
      <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-indigo-400 rounded-2xl blur opacity-30 group-hover:opacity-60 transition"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-7 shadow flex flex-col">
          <span class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-500 text-white font-semibold mb-4">1</span>
          <h3 class="font-semibold mb-2">Cadastro & Perfil</h3>
          <p class="text-sm text-slate-600 dark:text-slate-300">Crie sua conta como consumidor ou empresa em minutos.</p>
        </div>
      </div>
      <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-indigo-400 rounded-2xl blur opacity-30 group-hover:opacity-60 transition"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-7 shadow flex flex-col">
          <span class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-500 text-white font-semibold mb-4">2</span>
          <h3 class="font-semibold mb-2">Conexão & Ofertas</h3>
          <p class="text-sm text-slate-600 dark:text-slate-300">Empresas publicam disponibilidade e compradores analisam condições.</p>
        </div>
      </div>
      <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-indigo-400 rounded-2xl blur opacity-30 group-hover:opacity-60 transition"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-7 shadow flex flex-col">
          <span class="w-10 h-10 flex items-center justify-center rounded-full bg-sky-500 text-white font-semibold mb-4">3</span>
          <h3 class="font-semibold mb-2">Transação Segura</h3>
          <p class="text-sm text-slate-600 dark:text-slate-300">Registro imutável garantindo procedência e rastreabilidade.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- IMPACTO --}}
<section class="py-24 bg-gradient-to-b from-slate-900 to-slate-800 text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-20 bg-[linear-gradient(45deg,#334155_25%,transparent_25%,transparent_50%,#334155_50%,#334155_75%,transparent_75%,transparent)] bg-[length:16px_16px]"></div>
  <div class="max-w-7xl mx-auto px-6 relative">
    <div class="grid md:grid-cols-2 gap-14 items-center">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Transparência que gera <span class="text-emerald-400">confiança</span></h2>
        <p class="text-slate-300 leading-relaxed mb-6">Cada transação energética pode ser auditada, reduzindo assimetrias de informação e fortalecendo escolhas sustentáveis.</p>
        <ul class="space-y-3 text-sm">
          <li class="flex items-start gap-3"><span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span> Rastreabilidade fim a fim</li>
          <li class="flex items-start gap-3"><span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span> Dados verificáveis</li>
          <li class="flex items-start gap-3"><span class="mt-1 w-2 h-2 rounded-full bg-emerald-400"></span> Construção de reputação</li>
        </ul>
      </div>
      <div class="grid grid-cols-2 gap-6">
        <div class="p-6 rounded-xl bg-white/10 backdrop-blur border border-white/10">
          <p class="text-4xl font-bold mb-1">+0</p>
          <p class="text-xs uppercase tracking-wide text-slate-300">MWh negociados</p>
        </div>
        <div class="p-6 rounded-xl bg-white/10 backdrop-blur border border-white/10">
          <p class="text-4xl font-bold mb-1">+0</p>
          <p class="text-xs uppercase tracking-wide text-slate-300">Empresas ativas</p>
        </div>
        <div class="p-6 rounded-xl bg-white/10 backdrop-blur border border-white/10">
          <p class="text-4xl font-bold mb-1">+0</p>
          <p class="text-xs uppercase tracking-wide text-slate-300">Usuários verificados</p>
        </div>
        <div class="p-6 rounded-xl bg-white/10 backdrop-blur border border-white/10">
          <p class="text-4xl font-bold mb-1">0%</p>
          <p class="text-xs uppercase tracking-wide text-slate-300">Fraudes detectadas</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CTA FINAL --}}
<section class="py-24 relative bg-white dark:bg-gray-950">
  <div class="max-w-5xl mx-auto px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-6">Pronto para ajudar a transformar a matriz energética?</h2>
    <p class="text-slate-600 dark:text-slate-300 mb-10 max-w-2xl mx-auto">Participe agora e acompanhe a evolução do mercado de energia renovável com confiança, dados auditáveis e transparência real.</p>
    @guest
      <a href="{{ route('register') }}" class="px-10 py-4 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg shadow-indigo-600/30 transition">Criar Conta</a>
    @else
      <a href="{{ route('dashboard') }}" class="px-10 py-4 rounded-md bg-emerald-600 hover:bg-emerald-500 text-white font-semibold shadow-lg shadow-emerald-600/30 transition">Ir para Dashboard</a>
    @endguest
  </div>
</section>
@endsection
