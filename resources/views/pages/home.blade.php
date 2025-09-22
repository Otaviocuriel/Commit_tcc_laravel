@extends('layouts.app')
@section('content')
<section class="bg-white dark:bg-gray-900 py-12 border-b border-gray-200 dark:border-gray-800">
  <div class="max-w-4xl mx-auto px-6">
  <h1 class="text-3xl md:text-4xl font-bold text-green-700 dark:text-green-400 mb-6 text-center">Energia renovável para todos</h1>
  <p class="text-lg text-gray-700 dark:text-gray-200 mb-6 text-center">Aqui você encontra empresas e pessoas reais, conectando quem produz e quem consome energia limpa. Tudo de forma simples, segura e transparente.</p>
    <div class="bg-green-50 dark:bg-green-900/30 rounded-xl p-6 mb-6 shadow">
      <h2 class="text-2xl font-semibold text-green-800 dark:text-green-300 mb-4">Como funciona?</h2>
      <ul class="space-y-3 text-base text-gray-800 dark:text-gray-100">
        <li>Veja ofertas de energia renovável perto de você.</li>
        <li>Converse com empresas e tire dúvidas direto na plataforma.</li>
        <li>Escolha, negocie e contrate de forma transparente.</li>
        <li>Acompanhe para onde vai a energia que você compra.</li>
      </ul>
    </div>
    <div class="grid md:grid-cols-2 gap-8 mt-8">
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 flex items-center">
        <div class="text-6xl mr-6">👤</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-emerald-700 dark:text-emerald-300">Consumidor</h3>
          <p class="mb-2 text-gray-700 dark:text-gray-200">Encontre energia renovável, converse com empresas e escolha o que faz sentido pra você.</p>
        </div>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-yellow-50 to-white dark:from-yellow-900 dark:to-gray-900 flex items-center">
        <div class="text-6xl mr-6">🏭</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-yellow-700 dark:text-yellow-300">Empresa</h3>
          <p class="mb-2 text-gray-700 dark:text-gray-200">Publique ofertas, converse com clientes e mostre seu compromisso com energia limpa.</p>
        </div>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-indigo-50 to-white dark:from-indigo-900 dark:to-gray-900 flex items-center">
        <div class="text-6xl mr-6">💹</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-indigo-700 dark:text-indigo-300">Investidor</h3>
          <p class="mb-2 text-gray-700 dark:text-gray-200">Acompanhe projetos reais e veja o impacto do seu investimento.</p>
        </div>
      </div>
      <div class="rounded-xl shadow-lg p-7 bg-gradient-to-br from-pink-50 to-white dark:from-pink-900 dark:to-gray-900 flex items-center">
        <div class="text-6xl mr-6">🔬</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-pink-700 dark:text-pink-300">Pesquisador</h3>
          <p class="mb-2 text-gray-700 dark:text-gray-200">Explore dados e estudos sobre energia renovável e blockchain.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection