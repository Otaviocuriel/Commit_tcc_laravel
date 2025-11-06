/* Minimal blockchain client integration using ethers (MetaMask) */

(async function () {
    const API_CONTRACT_INFO = '/blockchain/contract-info';

    async function getContractInfo() {
        const res = await fetch(API_CONTRACT_INFO);
        if (!res.ok) throw new Error('Failed to fetch contract info');
        return res.json();
    }

    async function ensureEthereum() {
        if (!window.ethereum) throw new Error('MetaMask ou provider Web3 não encontrado.');
        await window.ethereum.request({ method: 'eth_requestAccounts' });
        const provider = new ethers.providers.Web3Provider(window.ethereum);
        return provider;
    }

    async function recordOnChain(ofertaId, empresa, priceStr) {
        let normalized = String(priceStr).replace(/\./g, '').replace(',', '.');
        let priceFloat = parseFloat(normalized) || 0;
        let priceCents = Math.round(priceFloat * 100);

        const info = await getContractInfo();
        if (!info.address) throw new Error('Contract address not configured. Set BLOCKCHAIN_CONTRACT_ADDRESS in .env');

        const provider = await ensureEthereum();
        const signer = provider.getSigner();
        const contract = new ethers.Contract(info.address, info.abi, signer);

        const tx = await contract.recordSale(
            ethers.BigNumber.from(String(ofertaId || 0)),
            String(empresa || ''),
            ethers.BigNumber.from(String(priceCents))
        );

        const receipt = await tx.wait(1);

        return {
            txHash: receipt.transactionHash,
            chain: receipt.chainId || (info.network || null),
            status: receipt.status === 1 ? 'confirmed' : 'failed',
            price: priceCents
        };
    }

    window.blockchainContractFlow = async function (options) {
        try {
            // Novo: exige que o usuário esteja autenticado no Laravel antes de registrar
            if (!(window.Laravel && window.Laravel.isAuthenticated)) {
                const err = new Error('Você precisa estar autenticado para registrar na blockchain. Faça login e tente novamente.');
                if (typeof options.onError === 'function') options.onError(err);
                throw err;
            }

            const res = await recordOnChain(options.ofertaId, options.empresa, options.price);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            await fetch('/blockchain/record', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({
                    tx_hash: res.txHash,
                    oferta_id: options.ofertaId,
                    empresa: options.empresa,
                    price: res.price,
                    chain: res.chain,
                    status: res.status
                })
            });
            if (typeof options.onSuccess === 'function') options.onSuccess(res);
            return res;
        } catch (err) {
            if (typeof options.onError === 'function') options.onError(err);
            else console.error(err);
            throw err;
        }
    };

    // Novo: busca últimas transações do backend
    async function fetchTransactions(limit = 50) {
        const res = await fetch(`/blockchain/transactions?limit=${encodeURIComponent(limit)}`);
        if (!res.ok) throw new Error('Falha ao buscar transações');
        return res.json();
    }

    // Novo: renderiza em um container com id fornecido (simples tabela)
    async function renderTransactions(containerId, limit = 50) {
        const container = document.getElementById(containerId);
        if (!container) return;
        container.innerHTML = '<p>Carregando histórico...</p>';
        try {
            const txs = await fetchTransactions(limit);
            if (!txs || txs.length === 0) {
                container.innerHTML = '<p>Nenhuma transação registrada ainda.</p>';
                return;
            }
            let html = '<table class="min-w-full text-xs"><thead><tr class="text-left"><th>Data</th><th>Empresa</th><th>Oferta</th><th>Preço (cents)</th><th>TX</th><th>Status</th></tr></thead><tbody>';
            txs.forEach(t => {
                const created = new Date(t.created_at).toLocaleString();
                const txLink = t.tx_hash ? `<a href="https://etherscan.io/tx/${t.tx_hash}" target="_blank" rel="noopener noreferrer">${t.tx_hash.slice(0,12)}…</a>` : '';
                html += `<tr class="border-t"><td>${created}</td><td>${escapeHtml(t.empresa||'')}</td><td>${t.oferta_id||''}</td><td>${t.price||''}</td><td>${txLink}</td><td>${t.status||''}</td></tr>`;
            });
            html += '</tbody></table>';
            container.innerHTML = html;
        } catch (err) {
            container.innerHTML = `<p class="text-red-600">Erro ao carregar histórico: ${escapeHtml(err.message || err)}</p>`;
            console.error(err);
        }
    }

    // Pequena função utilitária de escape
    function escapeHtml(str) {
        return String(str || '').replace(/[&<>"'`=\/]/g, function(s) {
            return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'})[s];
        });
    }

    // Expor helpers globalmente
    window.fetchBlockchainTransactions = fetchTransactions;
    window.renderBlockchainTransactions = renderTransactions;

    /* NOVO: expõe connectWallet para uso pelo frontend (garante que ethers/blockchain.js estejam carregados) */
    window.connectWallet = async function(onSuccess, onError) {
        try {
            const provider = await ensureEthereum(); // garante conexão e prompt do MetaMask
            const accounts = await provider.listAccounts();
            if (typeof onSuccess === 'function') onSuccess(accounts);
            return accounts;
        } catch (err) {
            if (typeof onError === 'function') onError(err);
            else console.error(err);
            throw err;
        }
    };

    /* helpers de detecção e UI para MetaMask */
    window.isEthereumAvailable = function() {
        return typeof window.ethereum !== 'undefined';
    };

    window.isMetaMask = function() {
        return !!(window.ethereum && window.ethereum.isMetaMask);
    };

    /**
     * Mostra instrução amigável dentro do containerId.
     * containerId: id de um elemento existente na página onde a mensagem deve aparecer.
     */
    window.showInstallMetaMask = function(containerId) {
        const c = document.getElementById(containerId);
        if (!c) return;
        c.innerHTML = `
            <div class="p-3 rounded-md bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 text-sm text-yellow-800 dark:text-yellow-200">
                <strong>MetaMask não detectado.</strong>
                <div class="mt-1">Instale a extensão MetaMask no seu navegador e permita o acesso ao site.</div>
                <div class="mt-2">
                    <a href="https://metamask.io/download/" target="_blank" rel="noopener noreferrer" class="underline">Instalar MetaMask</a>
                    <span class="mx-2">•</span>
                    <a href="https://metamask.io/faqs/" target="_blank" rel="noopener noreferrer" class="underline">Ajuda / FAQ</a>
                </div>
            </div>
        `;
    };

    window.showProviderButNotMetaMask = function(containerId) {
        const c = document.getElementById(containerId);
        if (!c) return;
        c.innerHTML = `
            <div class="p-3 rounded-md bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 text-sm text-yellow-800 dark:text-yellow-200">
                Provedor Web3 detectado, mas não é MetaMask. Você pode usar outro wallet provider compatível, mas recomendo MetaMask.
                <div class="mt-2"><a href="https://metamask.io/download/" target="_blank" rel="noopener noreferrer" class="underline">Instalar MetaMask</a></div>
            </div>
        `;
    };

    /**
     * Testa o provider disponível no navegador e tenta solicitar contas (se houver provider).
     * Retorna um objeto com informações e possíveis erros.
     */
    window.testProvider = async function() {
        const result = {
            hasWindowEthereum: typeof window.ethereum !== 'undefined',
            isMetaMask: !!(window.ethereum && window.ethereum.isMetaMask),
            hasEthers: typeof window.ethers !== 'undefined',
            hasConnectWallet: typeof window.connectWallet === 'function',
            accounts: null,
            requestError: null
        };

        if (!result.hasWindowEthereum) {
            return result;
        }

        // tenta listar contas (pode abrir prompt)
        try {
            // se connectWallet existir, usa-o (ele solicita contas)
            if (window.connectWallet) {
                const accs = await window.connectWallet(
                    (a) => a,
                    (err) => { throw err; }
                );
                result.accounts = accs;
            } else if (window.ethereum && window.ethereum.request) {
                const accs = await window.ethereum.request({ method: 'eth_accounts' });
                result.accounts = accs;
            }
        } catch (err) {
            // captura erro (ex.: usuário rejeitou, provider bloqueou, etc.)
            result.requestError = (err && (err.message || err.toString())) || String(err);
        }

        return result;
    };

})();
