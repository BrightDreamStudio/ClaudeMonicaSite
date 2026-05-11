function changeLanguage() {
    var selectedLang = document.getElementById('language-select').value;

    // Liste des pages pour chaque langue
    var pages = {
        'fr': '../fr/accueil_fr.html', // Page en français
        'en': '../en/accueil_en.html', // Page en anglais (ou une autre page locale)
        'es': '../es/accueil_es.html', // Page en espagnol
        'de': '../de/accueil_de.html', // Page en allemand (ou autre page locale)
    };

    // Vérification si la langue existe dans l'objet pages, sinon on reste sur la page actuelle
    if (pages[selectedLang]) {
        window.location.href = pages[selectedLang];
    }
}