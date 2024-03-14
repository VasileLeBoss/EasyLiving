document.addEventListener("DOMContentLoaded", function () {
    var prenomInput = document.getElementById('prenom');
    var nomInput = document.getElementById('nom');
    var emailInput = document.getElementById('email');
    var adresseInput = document.getElementById('adresse');
    var codeVilleInput = document.getElementById('codepostale');
    var telInput = document.getElementById('tel');
    var submitBtn = document.getElementById('submitBtn');

    var emailError = document.getElementById('emailError');
    var telError = document.getElementById('telError');
    var codeError = document.getElementById('codeError');
    var adresseError = document.getElementById('adresseError');
    var prenomError = document.getElementById('prenomError');
    var nomError = document.getElementById('nomError');

    function validateEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    function updateFormState() {

        var isPrenomValid = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(prenomInput.value);
        var isNomValid = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/.test(nomInput.value);
        var isEmailValid = validateEmail(emailInput.value);
        var isTelValid = /^\d{10}$/.test(telInput.value); 
        var isCodeValid = /^\d{5}$/.test(codeVilleInput.value);
        var isadresseValid = /^\d+\s[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+(?:[\s-]\d+\s[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+)*$/.test(adresseInput.value); 

        submitBtn.disabled = !(isEmailValid && isTelValid && isCodeValid && isadresseValid && isNomValid && isPrenomValid);


        emailError.textContent = isEmailValid ? '' : 'Adresse e-mail invalide';
       
        telError.textContent = isTelValid ? '' : 'Numéro de téléphone invalide';
        codeError.textContent = isCodeValid ? '' : 'Code postal invalide';
        adresseError.textContent = isadresseValid ? '' : 'Veuillez saisir une adresse valide';

        prenomError.textContent = isPrenomValid ? '' : "Le prénom n'est pas valide.";
        nomError.textContent = isNomValid ? '' : "Le nom n'est pas valide.";
    }

    // Ajoutez des écouteurs d'événements pour chaque champ d'entrée
    emailInput.addEventListener('input', updateFormState);
    telInput.addEventListener('input', updateFormState);
    codeVilleInput.addEventListener('input', updateFormState);
    adresseInput.addEventListener('input', updateFormState);
    prenomInput.addEventListener('input', updateFormState);
    nomInput.addEventListener('input', updateFormState);

    // updateFormState();
});
