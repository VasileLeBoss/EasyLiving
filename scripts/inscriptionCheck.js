document.addEventListener('DOMContentLoaded', function () {

    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');
    var mdpInput = document.getElementById('mdp');
    var mdpError = document.getElementById('mdpError');
    var confirmMdpInput = document.getElementById('confirmMdp');
    var confirmMdpError = document.getElementById('confirmMdpError');
    var telInput = document.getElementById('tel');
    var telError = document.getElementById('telError');
    var codeVilleInput = document.getElementById('code_ville');
    var codeError = document.getElementById('codeError');
    var submitBtn = document.getElementById('submitBtn');
    var adresseInput = document.getElementById('adresse');
    var adresseError = document.getElementById('adresseError');


    var prenomInput = document.getElementById('prenom');
    var prenomError = document.getElementById('prenomError');

    var nomInput = document.getElementById('nom');
    var nomError = document.getElementById('nomError');

    // Fonction de validation de l'e-mail avec une regex simple
    function validateEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    // Fonction pour vérifier si le mot de passe et la confirmation sont identiques
    function passwordsMatch(password, confirmPassword) {
        return password === confirmPassword;
    }

    // Fonction de mise à jour de l'état du bouton et des messages d'erreur
    function updateFormState() {

        var isPrenomValid = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(prenomInput.value);
        var isNomValid = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(nomInput.value);

        var isEmailValid = validateEmail(emailInput.value);
        var isPasswordValid = mdpInput.value.length >= 6; // Exemple : au moins 6 caractères
        var doPasswordsMatch = passwordsMatch(mdpInput.value, confirmMdpInput.value);
        var isTelValid = /^\d{10}$/.test(telInput.value); 
        var isCodeValid = /^\d{5}$/.test(codeVilleInput.value);
        var isadresseValid = /^\d+\s[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+(?:[\s-]\d+\s[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+)*$/.test(adresseInput.value); 

        submitBtn.disabled = !(isEmailValid && isPasswordValid && doPasswordsMatch && isTelValid && isCodeValid && isadresseValid && isNomValid && isPrenomValid);

        // Affichage des messages d'erreur
        emailError.textContent = isEmailValid ? '' : 'Adresse e-mail invalide';
        mdpError.textContent = isPasswordValid ? '' : 'Le mot de passe doit contenir au moins 6 caractères';
        confirmMdpError.textContent = doPasswordsMatch ? '' : 'Les mots de passe ne correspondent pas';
        telError.textContent = isTelValid ? '' : 'Numéro de téléphone invalide';
        codeError.textContent = isCodeValid ? '' : 'Code postal invalide';
        adresseError.textContent = isadresseValid ? '' : 'Veuillez saisir une adresse valide';

        prenomError.textContent = isPrenomValid ? '' : "Le prénom n'est pas valide.";
        nomError.textContent = isNomValid ? '' : "Le nom n'est pas valide.";
        
    }

    // Écouteurs d'événements pour chaque champ d'entrée
    emailInput.addEventListener('input', updateFormState);
    mdpInput.addEventListener('input', updateFormState);
    confirmMdpInput.addEventListener('input', updateFormState);
    telInput.addEventListener('input', updateFormState);
    codeVilleInput.addEventListener('input', updateFormState);
    adresseInput.addEventListener('input', updateFormState);
    prenomInput.addEventListener('input', updateFormState);
    nomInput.addEventListener('input', updateFormState);
});
