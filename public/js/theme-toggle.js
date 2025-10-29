(function () {
	// keys e elementos
	const STORAGE_KEY = 'site-theme-choice'; // 'light' | 'dark'
	const btnWhite = document.getElementById('theme-white');
	const btnBlack = document.getElementById('theme-black');

	function applyTheme(theme) {
		if (!theme) return;
		document.body.classList.remove('theme-light', 'theme-dark');
		document.body.classList.add(theme === 'dark' ? 'theme-dark' : 'theme-light');

		if (btnWhite) btnWhite.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
		if (btnBlack) btnBlack.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
		localStorage.setItem(STORAGE_KEY, theme);
	}

	// inicializa: lê localStorage, senão define padrão (light)
	const saved = localStorage.getItem(STORAGE_KEY);
	if (saved) {
		applyTheme(saved);
	} else {
		// padrão: light (branco)
		applyTheme('light');
	}

	// handlers
	if (btnWhite) btnWhite.addEventListener('click', function () { applyTheme('light'); });
	if (btnBlack) btnBlack.addEventListener('click', function () { applyTheme('dark'); });

	// Expor para console se precisar (opcional)
	window.themeToggle = { applyTheme };
})();
