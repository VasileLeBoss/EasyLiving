document.addEventListener('DOMContentLoaded', function () {
    // Récupération des éléments du DOM
    var rueInput = document.getElementById('rue');
    var rueError = document.getElementById('rueError');
    var arrondissementInput = document.getElementById('arrondissement');
    var arrondissementError = document.getElementById('arrondissementError');
    var etageInput = document.getElementById('etage');
    var etageError = document.getElementById('etageError');
    var submitBtn = document.getElementById('submitbtn'); // Correction de l'ID ici

    // Fonction de validation de la rue
    function validateRue(rue) {
        return /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(rue);        
    }

    // Fonction de validation de l'arrondissement
    function validateArrondissement(arrondissement) {
        return /^(?:[1-9]|1[0-9]|20)$/.test(arrondissement);
    }

    // Fonction de validation de l'étage
    function validateEtage(etage) {
        return parseFloat(etage) >= 0;
    }

    // Fonction pour vérifier la validité globale du formulaire
    function checkFormValidity() {
        var isRueValid = validateRue(rueInput.value);
        var isArrondissementValid = validateArrondissement(arrondissementInput.value);
        var isEtageValid = validateEtage(etageInput.value);

        submitBtn.disabled = !(isRueValid && isArrondissementValid && isEtageValid);

        // Affichage des messages d'erreur
        rueError.textContent = isRueValid ? '' : 'Veuillez saisir une rue valide.';
        arrondissementError.textContent = isArrondissementValid ? '' : 'Arrondissement invalide';
        etageError.textContent = isEtageValid ? '' : "Veuillez entrer un numéro d'étage valide";
    }

    // Écouteurs d'événements pour chaque champ d'entrée
    rueInput.addEventListener('input', checkFormValidity);
    arrondissementInput.addEventListener('input', checkFormValidity);
    etageInput.addEventListener('input', checkFormValidity);


    // Appel initial pour mettre à jour l'état du formulaire au chargement
    checkFormValidity();
});
