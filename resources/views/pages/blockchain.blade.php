@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 space-y-6">
  <h1 class="text-2xl font-bold">Blockchain — registrar e verificar transações</h1>

  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <p class="mb-2">Aqui você pode conectar sua carteira, registrar uma venda/contratação no contrato público e visualizar o histórico de registros.</p>

    <div id="metamask-warning" class="mb-4"></div>

    <div id="contract-info" class="mb-4 text-sm text-gray-700 dark:text-gray-200">
      <p>Carregando informações do contrato...</p>
    </div>

    <div class="flex gap-3 mb-4">
      <button id="btn-connect-wallet" class="px-4 py-2 rounded bg-emerald-600 text-white">Conectar carteira</button>
      <button id="btn-refresh-info" class="px-4 py-2 rounded bg-gray-700 text-white">Atualizar info</button>

      {{-- NOVO: testar conexão --}}
      <button id="btn-test-connection" class="px-4 py-2 rounded bg-blue-600 text-white">Testar conexão</button>
    </div>

    {{-- Resultado do teste --}}
    <div id="test-connection-result" class="mb-4 text-sm"></div>

    @auth
      <form id="form-record" class="space-y-3 mb-4">
        <div>
          <label class="block text-sm">ID da Oferta (opcional)</label>
          <input id="input-oferta" type="number" class="mt-1 px-3 py-2 rounded w-48 bg-gray-100 dark:bg-gray-700" placeholder="ex.: 123">
        </div>
        <div>
          <label class="block text-sm">Empresa</label>
          <input id="input-empresa" type="text" class="mt-1 px-3 py-2 rounded w-full bg-gray-100 dark:bg-gray-700" placeholder="Nome da empresa">
        </div>
        <div>
          <label class="block text-sm">Preço (R$) — ex: 295,00</label>
          <input id="input-price" type="text" class="mt-1 px-3 py-2 rounded w-48 bg-gray-100 dark:bg-gray-700" placeholder="295,00">
        </div>
        <div>
          <button id="btn-record" class="px-4 py-2 rounded bg-emerald-600 text-white">Registrar na blockchain</button>
        </div>
        <div id="record-status" class="text-sm mt-2"></div>
      </form>
    @else
      <div class="mb-4 p-4 bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 rounded">
        <p class="text-yellow-800 dark:text-yellow-200 mb-2"><strong>Importante:</strong> é necessário estar autenticado para registrar transações na blockchain.</p>
        <div class="flex gap-2">
          <a href="{{ route('login') }}" class="px-3 py-2 rounded bg-emerald-600 text-white">Entrar</a>
          @if(Route::has('register'))
            <a href="{{ route('register') }}" class="px-3 py-2 rounded bg-gray-700 text-white">Criar conta</a>
          @endif
        </div>
      </div>
    @endauth

    <hr class="my-4">

    <div>
      <h3 class="font-semibold mb-2">Histórico público</h3>
      <div class="flex items-center gap-2 mb-3">
        <label class="text-sm">Mostrar</label>
        <select id="select-limit" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">
          <option value="10">10</option>
          <option value="25" selected>25</option>
          <option value="50">50</option>
        </select>
        <button id="btn-refresh-history" class="px-3 py-1 rounded bg-gray-700 text-white text-sm">Atualizar</button>
      </div>
      <div id="tx-list" class="text-xs"></div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const contractInfoEl = document.getElementById('contract-info');
  const btnConnect = document.getElementById('btn-connect-wallet');
  const btnRefresh = document.getElementById('btn-refresh-info');
  const btnRecord = document.getElementById('btn-record');
  const statusEl = document.getElementById('record-status');
  const txListEl = document.getElementById('tx-list');
  const selectLimit = document.getElementById('select-limit');
  const btnRefreshHistory = document.getElementById('btn-refresh-history');
  const btnTest = document.getElementById('btn-test-connection');
  const resultEl = document.getElementById('test-connection-result');

  async function loadContractInfo() {
    contractInfoEl.innerHTML = 'Carregando informações do contrato...';
    try {
      const res = await fetch('/blockchain/contract-info');
      if (!res.ok) throw new Error('Falha ao carregar info');
      const info = await res.json();
      const addr = info.address || '<span class="text-red-500">não configurado</span>';
      contractInfoEl.innerHTML = `<div><strong>Endereço:</strong> ${addr}</div><div><strong>Rede:</strong> ${info.network || 'n/a'}</div>`;
    } catch (err) {
      contractInfoEl.innerHTML = `<div class="text-red-600">Erro: ${err.message}</div>`;
    }
  }

  // Substitui a função connectWallet local por chamada ao helper global
  async function handleConnectClick() {
    try {
      if (!window.isEthereumAvailable || !window.isEthereumAvailable()) {
        // reforçar instrução se usuário clicou no botão mas não tem provider
        window.showInstallMetaMask('metamask-warning');
        return;
      }
      if (!window.connectWallet) {
        alert('Aguardando carregamento do provedor Web3. Recarregue a página e tente novamente.');
        return;
      }
      await window.connectWallet(
        function(accounts) {
          alert('Carteira conectada: ' + (accounts[0] || ''));
        },
        function(err) {
          console.error('Erro ao conectar carteira:', err);
          alert('Erro ao conectar carteira: ' + (err.message || err));
        }
      );
    } catch (err) {
      console.error(err);
    }
  }

  async function recordSale() {
    statusEl.textContent = 'Iniciando transação...';
    const ofertaId = document.getElementById('input-oferta').value || 0;
    const empresa = document.getElementById('input-empresa').value || '';
    const price = document.getElementById('input-price').value || '';
    try {
      const res = await window.blockchainContractFlow({
        ofertaId: ofertaId,
        empresa: empresa,
        price: price,
        onSuccess: function(r) {
          statusEl.innerHTML = `<span class="text-green-600">Confirmado na chain. TX: ${r.txHash}</span>`;
          // atualizar histórico automaticamente
          window.renderBlockchainTransactions('tx-list', parseInt(selectLimit.value || 25));
        },
        onError: function(err) {
          statusEl.innerHTML = `<span class="text-red-600">Erro: ${err.message || err}</span>`;
        }
      });
    } catch (err) {
      statusEl.innerHTML = `<span class="text-red-600">Erro: ${err.message || err}</span>`;
    }
  }

  async function renderTestResult() {
    if (!window.testProvider || typeof window.testProvider !== 'function') {
      resultEl.innerHTML = `<div class="p-3 rounded bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700">
        Ferramenta de diagnóstico não carregada. Recarregue a página e verifique se <code>/js/blockchain.js</code> foi carregado (ver Network).
      </div>`;
      return;
    }

    resultEl.innerHTML = `<div class="p-2 text-sm">Executando teste... aguarde</div>`;
    try {
      const res = await window.testProvider();
      let html = `<div class="p-3 rounded bg-white dark:bg-gray-900 border">`;
      html += `<div><strong>window.ethereum:</strong> ${res.hasWindowEthereum ? '<span class="text-green-600">detectado</span>' : '<span class="text-red-600">não detectado</span>'}</div>`;
      html += `<div><strong>MetaMask:</strong> ${res.isMetaMask ? '<span class="text-green-600">sim</span>' : '<span class="text-yellow-600">não (ou outro provider)</span>'}</div>`;
      html += `<div><strong>ethers.js:</strong> ${res.hasEthers ? '<span class="text-green-600">carregado</span>' : '<span class="text-red-600">não carregado</span>'}</div>`;
      html += `<div><strong>connectWallet:</strong> ${res.hasConnectWallet ? '<span class="text-green-600">disponível</span>' : '<span class="text-yellow-600">indisponível</span>'}</div>`;

      if (res.accounts && Array.isArray(res.accounts) && res.accounts.length > 0) {
        html += `<div><strong>Contas:</strong> ${res.accounts.join(', ')}</div>`;
      } else {
        html += `<div><strong>Contas:</strong> <span class="text-gray-600">nenhuma conta conectada</span></div>`;
      }

      if (res.requestError) {
        html += `<div class="mt-2 text-red-600"><strong>Erro ao solicitar contas:</strong> ${res.requestError}</div>`;
      }

      html += `<hr class="my-2">`;
      html += `<div class="text-xs text-gray-700 dark:text-gray-300">Sugestões rápidas:</div>`;
      html += `<ul class="text-xs ml-4 mt-1"><li>- Verifique se a extensão MetaMask está instalada e desbloqueada.</li><li>- Em chrome://extensions/ → MetaMask → Detalhes → defina "Acesso ao site" para "Em todos os sites".</li><li>- Permita pop-ups e desative bloqueadores temporariamente.</li><li>- Recarregue a página após alterar configurações.</li></ul>`;

      html += `</div>`;
      resultEl.innerHTML = html;
    } catch (err) {
      resultEl.innerHTML = `<div class="p-3 rounded bg-red-50 text-red-700">Erro no teste: ${err && err.message ? err.message : String(err)}</div>`;
      console.error('testProvider error', err);
    }
  }

  btnConnect.addEventListener('click', handleConnectClick);
  btnRefresh.addEventListener('click', loadContractInfo);
  btnRecord.addEventListener('click', function(e){ e.preventDefault(); recordSale(); });
  btnRefreshHistory.addEventListener('click', function(e){ e.preventDefault(); window.renderBlockchainTransactions('tx-list', parseInt(selectLimit.value || 25)); });
  btnTest.addEventListener('click', function(e){
    e.preventDefault();
    renderTestResult();
  });

  // Ao carregar, verifica provider e mostra aviso se necessário
  if (typeof window.isEthereumAvailable === 'function') {
      if (!window.isEthereumAvailable()) {
          window.showInstallMetaMask('metamask-warning');
      } else if (!window.isMetaMask || !window.isMetaMask()) {
          // provider existe, mas não MetaMask
          window.showProviderButNotMetaMask('metamask-warning');
      } else {
          // provider MetaMask presente — limpa aviso
          const mw = document.getElementById('metamask-warning');
          if (mw) mw.innerHTML = '';
      }
  }

  // inicializa
  loadContractInfo();
  window.renderBlockchainTransactions('tx-list', parseInt(selectLimit.value || 25));
});
</script>
@endsection
