document.addEventListener('DOMContentLoaded', () => {
	const btn = document.getElementById('connectMetaMaskBtn');
	const status = document.getElementById('metamaskStatus');
	if (!btn || !status) {
		console.warn('Elemento de conexão MetaMask ou status não encontrado');
		return;
	}

	async function ensureEthers(timeoutMs = 5000) {
		if (typeof ethers !== 'undefined') {
			console.log('ethers já disponível');
			return;
		}

		console.log('ethers não detectado — carregando CDN como fallback...');
		return new Promise((resolve, reject) => {
			let timedOut = false;
			const t = setTimeout(() => {
				timedOut = true;
				reject(new Error('Timeout ao carregar ethers CDN'));
			}, timeoutMs);

			const s = document.createElement('script');
			s.src = 'https://cdn.jsdelivr.net/npm/ethers@5.7.2/dist/ethers.min.js';
			s.onload = () => {
				clearTimeout(t);
				if (timedOut) return;
				if (typeof ethers === 'undefined') {
					reject(new Error('ethers carregado, mas global não definido'));
					return;
				}
				console.log('ethers carregado com sucesso via fallback CDN');
				resolve();
			};
			s.onerror = () => {
				clearTimeout(t);
				if (timedOut) return;
				reject(new Error('Falha ao carregar ethers CDN'));
			};
			document.head.appendChild(s);
		});
	}

	btn.addEventListener('click', async () => {
		try {
			status.textContent = 'Conectando...';
			await ensureEthers();

			if (!window.ethereum) {
				status.textContent = 'MetaMask não detectado';
				alert('Instale o MetaMask');
				return;
			}

			const provider = new ethers.providers.Web3Provider(window.ethereum);
			// Para MetaMask: solicitar permissão
			await provider.send('eth_requestAccounts', []);
			const signer = provider.getSigner();
			const address = await signer.getAddress();

			status.textContent = 'Conectado: ' + address;
			console.log('MetaMask conectado:', address);
			window.dispatchEvent(new CustomEvent('metamask:connected', { detail: { address } }));
		} catch (err) {
			console.error('Erro ao conectar carteira:', err);
			status.textContent = 'Erro: ' + (err.message || err);
			alert('Erro ao conectar carteira: ' + (err.message || err));
		}
	});
});