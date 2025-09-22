@extends('layouts.app')
@section('content')
<section class="bg-black py-12 border-b border-white/10">
  <div class="max-w-4xl mx-auto px-6">
  <h1 class="text-3xl md:text-4xl font-bold text-white mb-6 text-center">Energia renovável para todos</h1>
  <p class="text-lg text-white mb-6 text-center">Aqui você encontra empresas e pessoas reais, conectando quem produz e quem consome energia limpa. Tudo de forma simples, segura e transparente.</p>
    <div class="bg-black rounded-xl p-6 mb-6 shadow border border-white/10">
      <h2 class="text-2xl font-semibold text-white mb-4">Como funciona?</h2>
      <ul class="space-y-3 text-base text-white">
        <li>Veja ofertas de energia renovável perto de você.</li>
        <li>Converse com empresas e tire dúvidas direto na plataforma.</li>
        <li>Escolha, negocie e contrate de forma transparente.</li>
        <li>Acompanhe para onde vai a energia que você compra.</li>
      </ul>
    </div>
    <div class="grid md:grid-cols-2 gap-8 mt-8">
  <div class="rounded-xl shadow-lg p-7 bg-black border border-white/10 flex items-center">
        <div class="text-6xl mr-6">👤</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-white">Consumidor</h3>
          <p class="mb-2 text-white">Encontre energia renovável, converse com empresas e escolha o que faz sentido pra você.</p>
        </div>
      </div>
  <div class="rounded-xl shadow-lg p-7 bg-black border border-white/10 flex items-center">
        <div class="text-6xl mr-6">🏭</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-white">Empresa</h3>
          <p class="mb-2 text-white">Publique ofertas, converse com clientes e mostre seu compromisso com energia limpa.</p>
        </div>
      </div>
  <div class="rounded-xl shadow-lg p-7 bg-black border border-white/10 flex items-center">
        <div class="text-6xl mr-6">💹</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-white">Investidor</h3>
          <p class="mb-2 text-white">Acompanhe projetos reais e veja o impacto do seu investimento.</p>
        </div>
      </div>
  <div class="rounded-xl shadow-lg p-7 bg-black border border-white/10 flex items-center">
        <div class="text-6xl mr-6">🔬</div>
        <div>
          <h3 class="font-bold text-lg mb-2 text-white">Pesquisador</h3>
          <p class="mb-2 text-white">Explore dados e estudos sobre energia renovável e blockchain.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection