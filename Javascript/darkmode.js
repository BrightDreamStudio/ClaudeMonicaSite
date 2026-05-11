    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Fonction pour appliquer le mode sombre ou clair
    function setDarkMode(isDark) {
        if (isDark) {
            body.classList.add('dark-mode');
            toggleButton.textContent = "☀️"; // Bouton pour le mode clair
        } else {
            body.classList.remove('dark-mode');
            toggleButton.textContent = "🌙"; // Bouton pour le mode sombre
        }
    }

    // Initialisation du mode au chargement
    if (currentTheme === 'dark') {
        setDarkMode(true);
    }

    // Écouteur d'événements sur le bouton
    toggleButton.addEventListener('click', () => {
        const isDark = body.classList.contains('dark-mode');
        setDarkMode(!isDark);

        // Sauvegarder l'état du thème dans le localStorage
        localStorage.setItem('theme', isDark ? 'light' : 'dark');
    });
