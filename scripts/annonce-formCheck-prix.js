document.addEventListener('DOMContentLoaded', function () {
    // Récupération des éléments du DOM
    var prix_loc = document.getElementById('prix_loc');
    var prix_locError = document.getElementById('prix_locError');
    var prix_charg = document.getElementById('prix_charg');
    var prix_chargError = document.getElementById('prix_chargError');
    var submitBtn = document.getElementById('submitbtn');

    // Fonction de validation du prix
    function validatePrix(prix) {
        // Utilisation d'une expression régulière pour autoriser les nombres décimaux
        return /^\d*\.?\d*$/.test(prix) && parseFloat(prix) >= 0;
    }

    // Fonction pour gérer l'événement d'entrée
    function handleInput(event) {
        var inputValue = event.target.value;
        // Supprimer tout caractère non numérique ou point sauf s'il est au début
        inputValue = inputValue.replace(/[^\d.]/g, (match, offset) => (offset === 0 && match === '.') ? match : '');

        // Mettre à jour la valeur dans le champ
        event.target.value = inputValue;

        // Vérifier la validité du formulaire
        checkFormValidity();
    }

    // Fonction pour vérifier la validité globale du formulaire
    function checkFormValidity() {
        var isPrixLoc = validatePrix(prix_loc.value);
        var isPrixCharg = validatePrix(prix_charg.value);

        submitBtn.disabled = !(isPrixLoc && isPrixCharg);

        // Affichage des messages d'erreur
        prix_locError.textContent = isPrixLoc ? '' : "Veuillez entrer un prix valide.";
        prix_chargError.textContent = isPrixCharg ? '' : 'Veuillez entrer un prix valide.';
    }

    // Écouteurs d'événements pour chaque champ d'entrée
    prix_loc.addEventListener('input', handleInput);
    prix_charg.addEventListener('input', handleInput);

    // Appel initial pour mettre à jour l'état du formulaire au chargement
    checkFormValidity();
});
