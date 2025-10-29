<div class="theme-toggle-wrap" aria-hidden="false">
	<!-- Inline styles para funcionar sem arquivos adicionais -->
	<style>
		/* Temas: altera só o background (não força cor do texto) */
		html.theme-light, body.theme-light { background: #ffffff; transition: background-color .25s; }

		/* NOVO: fundo escuro mais agradável (gradiente + leve textura de estrelas), fixo */
		html.theme-dark, body.theme-dark {
			background-color: #05060a;
			background-image:
				/* textura de estrelas (muito sutil) */
				radial-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
				radial-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
				/* gradiente tonal */
				linear-gradient(180deg, #0a1220 0%, #000000 60%);
			background-size: 200px 200px, 400px 400px, cover;
			background-attachment: fixed;
			transition: background-color .25s;
		}

		/* NÃO alterar cores de texto/link globais — manter comportamento do site */
		html.theme-dark a, body.theme-dark a { color: inherit; }
		html.theme-light a, body.theme-light a { color: inherit; }

		/* Toggle UI */
		.theme-toggle-wrap { position: fixed; top: 12px; right: 12px; z-index: 1000; }
		.theme-toggle { display:flex; gap:8px; align-items:center; padding:6px; border-radius:8px; backdrop-filter: blur(6px); }
		.theme-btn {
			background: transparent;
			border: none;
			padding:6px;
			display:inline-flex;
			align-items:center;
			justify-content:center;
			cursor:pointer;
			border-radius:6px;
			transition: transform .08s, background-color .12s;
		}
		.theme-btn:hover { transform: translateY(-2px); }
		.theme-btn:active { transform: translateY(0); }

		.theme-btn[aria-pressed="true"] {
			outline: 2px solid rgba(0,0,0,0.08);
			box-shadow: 0 4px 12px rgba(0,0,0,0.12);
			background: rgba(255,255,255,0.06);
		}

		/* Tornar os ícones legíveis conforme o tema: apenas para o seletor */
		html.theme-dark .theme-toggle, body.theme-dark .theme-toggle {
			color: #ffffff; /* ícones do seletor no modo escuro */
			background: rgba(255,255,255,0.04);
		}
		html.theme-light .theme-toggle, body.theme-light .theme-toggle {
			color: #0b0b0b; /* ícones do seletor no modo claro */
			background: rgba(0,0,0,0.02);
		}

		.theme-btn svg { display:block; color: currentColor; }
	</style>

	<div class="theme-toggle" id="theme-toggle" role="toolbar" aria-label="Escolher fundo">
		<button id="theme-white" class="theme-btn" title="Fundo branco" aria-pressed="false" aria-label="Fundo branco">
			<!-- Sun SVG -->
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<circle cx="12" cy="12" r="4" fill="currentColor"/>
				<g stroke="currentColor" stroke-width="2">
					<path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
				</g>
			</svg>
		</button>

		<button id="theme-black" class="theme-btn" title="Fundo preto" aria-pressed="false" aria-label="Fundo preto">
			<!-- Moon SVG -->
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="currentColor"/>
			</svg>
		</button>
	</div>

	<!-- Inline JS: aplica tema em html e body e persiste em localStorage -->
	<script>
		(function () {
			const STORAGE_KEY = 'site-theme-choice'; // 'light' | 'dark'
			const btnWhite = document.getElementById('theme-white');
			const btnBlack = document.getElementById('theme-black');

			function setClassesOnRoot(theme) {
				const root = document.documentElement;
				const body = document.body;
				root.classList.remove('theme-light','theme-dark');
				body.classList.remove('theme-light','theme-dark');
				if (theme === 'dark') {
					root.classList.add('theme-dark');
					body.classList.add('theme-dark');
				} else {
					root.classList.add('theme-light');
					body.classList.add('theme-light');
				}
			}

			function applyTheme(theme) {
				if (!theme) return;
				setClassesOnRoot(theme);
				if (btnWhite) btnWhite.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
				if (btnBlack) btnBlack.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
				try { localStorage.setItem(STORAGE_KEY, theme); } catch (e) { /* storage pode falhar */ }
			}

			// Aplica tema imediatamente (se existir) antes de adicionar handlers
			try {
				const saved = localStorage.getItem(STORAGE_KEY);
				if (saved) {
					setClassesOnRoot(saved);
				} else {
					// padrão: light (branco)
					setClassesOnRoot('light');
				}
			} catch (e) {
				setClassesOnRoot('light');
			}

			// Depois do load, atualiza atributos e listeners
			window.addEventListener('load', function () {
				const saved = (function () { try { return localStorage.getItem(STORAGE_KEY); } catch (e) { return null; } })();
				applyTheme(saved || 'light');

				if (btnWhite) btnWhite.addEventListener('click', function () { applyTheme('light'); });
				if (btnBlack) btnBlack.addEventListener('click', function () { applyTheme('dark'); });
			});
		})();
	</script>
</div>
