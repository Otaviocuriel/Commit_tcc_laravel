<button id="connectMetaMaskBtn" type="button">Conectar MetaMask</button>
<span id="metamaskStatus">Não conectado</span>

<!-- shim: cria um holder e transforma `ethers` numa property com getter/setter para evitar referências obsoletas -->
<script>
	// cria um holder que armazenará a implementação real quando o CDN carregar
	if (typeof window.__ethersHolder === 'undefined') {
		window.__ethersHolder = (window.ethers && Object.keys(window.ethers).length) ? window.ethers : {};
	}

	// define property `ethers` com getter/setter para sempre devolver o holder atual.
	try {
		Object.defineProperty(window, 'ethers', {
			configurable: true,
			enumerable: true,
			get() { return window.__ethersHolder; },
			set(v) { window.__ethersHolder = v; }
		});
		console.warn('[metamask-shim] propriedade "ethers" definida como getter/setter (holder criado).');
	} catch (e) {
		// Em caso de falha, fallback: garantir window.ethers e log
		if (typeof window.ethers === 'undefined') window.ethers = window.__ethersHolder || {};
		console.warn('[metamask-shim] não foi possível definir getter/setter para window.ethers, usando fallback.', e);
	}

	// listener global simples para ajudar debug
	window.addEventListener('error', function (ev) {
		console.error('[metamask-shim] erro global capturado:', ev.message, 'em', ev.filename + ':' + ev.lineno);
	});
</script>

<!-- Carrega ethers v5 (CDN) - isso sobrescreverá a property via setter definida acima -->
<script src="https://cdn.jsdelivr.net/npm/ethers@5.7.2/dist/ethers.min.js"></script>

<!-- Seu script que usa ethers (defer para garantir DOM disponível) -->
<script src="{{ asset('js/metamask-connect.js') }}" defer></script>

<!-- Inline debug/fallback opcional -->
<script>
	(function () {
		const btn = document.getElementById('connectMetaMaskBtn');
		const status = document.getElementById('metamaskStatus');
		if (!btn) return;

		function log(...args){ console.log('[metamask-debug]', ...args); }
		function error(...args){ console.error('[metamask-debug]', ...args); }

		// espera até window.ethereum (ou window.web3) aparecer, polling
		async function waitForWindowEthereum(timeoutMs = 5000, intervalMs = 100) {
			if (window.ethereum) return true;
			const start = Date.now();
			return new Promise((resolve, reject) => {
				const id = setInterval(() => {
					if (window.ethereum) { clearInterval(id); resolve(true); return; }
					if (Date.now() - start > timeoutMs) { clearInterval(id); resolve(false); return; }
				}, intervalMs);
			});
		}

		async function connectMetaMask() {
			try {
				btn.disabled = true;
				status.textContent = 'Tentando conectar...';
				log('Iniciando conexão');

				const found = await waitForWindowEthereum(5000);
				if (!found) {
					status.textContent = 'MetaMask não detectado';
					alert('MetaMask não detectado no navegador. Verifique se a extensão está instalada e ativada.');
					return;
				}

				// se instalado mas sem accounts (bloqueado), vamos solicitar permissões abaixo
				let address = null;

				// se a lib ethers estiver disponível e suportada, use-a; senão, fallback para request
				const hasEthers = (typeof ethers !== 'undefined' && ethers.providers && typeof ethers.providers.Web3Provider === 'function');

				if (hasEthers) {
					try {
						const provider = new ethers.providers.Web3Provider(window.ethereum);
						// solicita permissão/contas
						await provider.send('eth_requestAccounts', []);
						const signer = provider.getSigner();
						address = await signer.getAddress();
					} catch (err) {
						// possível rejeição pelo usuário
						error('ethers connect erro:', err);
						if (err && err.code === 4001) { // user rejected
							status.textContent = 'Conexão negada pelo usuário';
							return;
						}
						// continuar para tentar fallback abaixo
					}
				}

				if (!address) {
					// fallback EIP-1193 direto
					try {
						if (window.ethereum.request) {
							const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
							if (Array.isArray(accounts) && accounts.length) address = accounts[0];
						} else if (window.ethereum.send) {
							// antigos providers
							const res = await window.ethereum.send('eth_requestAccounts', []);
							// normalizar
							if (Array.isArray(res)) address = res[0];
							else if (res && Array.isArray(res.result)) address = res.result[0];
						}
					} catch (err) {
						error('window.ethereum.request erro:', err);
						if (err && err.code === 4001) {
							status.textContent = 'Conexão negada pelo usuário';
							return;
						}
					}
				}

				// se ainda não tem endereço, pode estar instalada mas bloqueada (sem contas aprovadas)
				if (!address) {
					// tenta ver se há contas já aprovadas
					try {
						let accs = [];
						if (window.ethereum.request) {
							accs = await window.ethereum.request({ method: 'eth_accounts' });
						} else if (window.ethereum.send) {
							const r = await window.ethereum.send('eth_accounts');
							if (Array.isArray(r)) accs = r;
							else if (r && Array.isArray(r.result)) accs = r.result;
						}
						if (Array.isArray(accs) && accs.length) {
							address = accs[0];
						}
					} catch (e) {
						// ignore
					}
				}

				if (!address) {
					status.textContent = 'MetaMask detectado, desbloqueie a carteira e tente novamente';
					alert('MetaMask detectado, mas sem contas conectadas. Abra a extensão MetaMask e desbloqueie sua carteira, depois tente novamente.');
					return;
				}

				status.textContent = 'Conectado: ' + address;
				log('Conectado:', address);
				window.dispatchEvent(new CustomEvent('metamask:connected', { detail: { address } }));
			} catch (err) {
				error('Erro ao conectar:', err);
				status.textContent = 'Erro: ' + (err && err.message ? err.message : String(err));
			} finally {
				btn.disabled = false;
			}
		}

		btn.addEventListener('click', () => {
			log('Clique detectado');
			connectMetaMask();
		});
	})();
</script>

<!-- Wrapper: aguarda ethers estar pronto antes de chamar funções que usam ethers -->
<script>
	(function () {
		// waitForEthers: resolve quando ethers.providers.Web3Provider estiver disponível
		function waitForEthers(timeoutMs = 7000, intervalMs = 50) {
			if (window.ethers && window.ethers.providers && typeof window.ethers.providers.Web3Provider === 'function') {
				return Promise.resolve();
			}
			const start = Date.now();
			return new Promise((resolve, reject) => {
				const id = setInterval(() => {
					if (window.ethers && window.ethers.providers && typeof window.ethers.providers.Web3Provider === 'function') {
						clearInterval(id);
						console.log('[metamask-shim] ethers pronto');
						resolve();
						return;
					}
					if (Date.now() - start > timeoutMs) {
						clearInterval(id);
						reject(new Error('Timeout aguardando ethers.providers.Web3Provider'));
					}
				}, intervalMs);
			});
		}

		// Se blockchain.js define window.connectWallet, envolvemos para aguardar ethers
		if (typeof window.connectWallet === 'function') {
			if (!window._orig_connectWallet) {
				window._orig_connectWallet = window.connectWallet;
				window.connectWallet = async function (...args) {
					try {
						await waitForEthers();
					} catch (err) {
						console.error('[metamask-shim] ethers não ficou pronto a tempo — abortando connectWallet', err);
						// rethrow para que o código chamador receba o erro (ou remova para tolerância)
						throw err;
					}
					return window._orig_connectWallet.apply(this, args);
				};
				console.log('[metamask-shim] connectWallet wrapped para aguardar ethers');
			}
		} else {
			console.log('[metamask-shim] connectWallet não definido no momento; wrapper será aplicado se definido mais tarde.');
			// Observador: quando connectWallet for criado posteriormente, aplicamos o wrapper automaticamente
			const observer = new MutationObserver(() => {
				if (typeof window.connectWallet === 'function' && !window._orig_connectWallet) {
					observer.disconnect();
					// mesmo código de wrap acima
					window._orig_connectWallet = window.connectWallet;
					window.connectWallet = async function (...args) {
						try {
							await waitForEthers();
						} catch (err) {
							console.error('[metamask-shim] ethers não ficou pronto a tempo — abortando connectWallet', err);
							throw err;
						}
						return window._orig_connectWallet.apply(this, args);
					};
					console.log('[metamask-shim] connectWallet detectado e wrapped dinamicamente');
				}
			});
			// observar alterações no objeto window (simples trigger)
			observer.observe(document, { subtree: true, childList: true });
			// fallback: também checar periodicamente se connectWallet aparece
			const checkId = setInterval(() => {
				if (typeof window.connectWallet === 'function' && !window._orig_connectWallet) {
					clearInterval(checkId);
					// aplicar wrapper imediatamente
					window._orig_connectWallet = window.connectWallet;
					window.connectWallet = async function (...args) {
						try {
							await waitForEthers();
						} catch (err) {
							console.error('[metamask-shim] ethers não ficou pronto a tempo — abortando connectWallet', err);
							throw err;
						}
						return window._orig_connectWallet.apply(this, args);
					};
					console.log('[metamask-shim] connectWallet detectado por polling e wrapped');
				}
			}, 200);
		}
	})();
</script>
