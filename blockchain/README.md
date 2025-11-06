Passos mínimos para deploy com Hardhat:

1) Entrar na pasta:
   cd blockchain

2) Instalar dependências:
   npm install

3) Criar .env (use .env.example) com PRIVATE_KEY e RPC_URL

4) Compilar:
   npm run compile

5) Deploy (Goerli por exemplo):
   npm run deploy:goerli
   -> copiar endereço exibido e colar no .env do Laravel (raiz):
      BLOCKCHAIN_CONTRACT_ADDRESS=0xYourDeployedAddress
      BLOCKCHAIN_NETWORK=goerli

Dicas:
- Use conta com ETH de teste.
- Se usar Infura/Alchemy defina RPC_URL apropriadamente.
- Depois, no frontend use MetaMask na mesma rede para testar chamadas ao contrato.

---- Acessar o site do celular (quando o site só roda no PC) ----

Opção A — ngrok (recomendada)
1) Instale ngrok: https://ngrok.com/download e siga a instrução de autenticação (authtoken).
2) Execute seu Laravel localmente e permita conexões externas:
   php artisan serve --host=0.0.0.0 --port=8000
3) Em outra janela, inicie ngrok apontando para a porta:
   ngrok http 8000
4) Copie a URL pública HTTPS fornecida pelo ngrok (ex.: https://abcd1234.ngrok.io).
5) No MetaMask mobile, abra o Browser interno e cole a URL:
   https://abcd1234.ngrok.io/blockchain
6) Teste: conectar carteira, preencher formulário (usuário autenticado) e registrar.

Opção B — rede local (Wi‑Fi)
1) Descubra o IP do seu PC na rede (Windows: ipconfig; Linux/Mac: ifconfig/ip addr). Ex.: 192.168.1.42
2) Inicie o servidor Laravel aceitando conexões:
   php artisan serve --host=0.0.0.0 --port=8000
3) No celular (na mesma rede Wi‑Fi) abra:
   http://192.168.1.42:8000/blockchain
4) Se não carregar, verifique firewall do Windows e permita a porta 8000.

Observações importantes
- Use HTTPS (ngrok fornece) para evitar problemas de mixed content em alguns navegadores/wallets.
- No MetaMask Mobile use o Browser interno para garantir que window.ethereum esteja disponível.
- Certifique-se de que a rede do MetaMask (Goerli/Sepolia) corresponda à rede onde o contrato foi deployado.
- O endpoint /blockchain/contract-info deve retornar o endereço do contrato; se estiver vazio, adicione BLOCKCHAIN_CONTRACT_ADDRESS no .env do Laravel e recarregue.

Verificação rápida (após expor)
- Abra: <URL>/blockchain
- Se for guest verá CTA para login; faça login no site no mesmo navegador/aba do MetaMask (ou use sessão do navegador do celular)
- Conectar carteira → Registrar uma venda → confirmar na MetaMask → verificar histórico e DB (tabela blockchain_transactions).

Se quiser, eu gero um pequeno script .bat / .ps1 com os comandos php artisan serve + ngrok que você só executa no PC para abrir o túnel automaticamente. Deseja que eu gere?
