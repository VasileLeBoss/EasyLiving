document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments du DOM
    var oldmdpInput = document.getElementById('ancien-mdp');
    var oldMdpError = document.getElementById('mdpError');
    var nouveauMdpInput = document.getElementById('nouveauMdpInput');
    var newMdpError = document.getElementById('newMdpError');
    var confirmMdpInput = document.getElementById('confirmMdpInput');
    var confirmMdpError = document.getElementById('confirm-mdpError');
    var submitBtn = document.getElementById('submitBtn');

    // Ajoutez un écouteur d'événements pour la saisie du nouveau mot de passe
    nouveauMdpInput.addEventListener('input', updateFormState);

    // Ajoutez un écouteur d'événements pour la saisie de la confirmation du mot de passe
    confirmMdpInput.addEventListener('input', updateFormState);

    // Ajoutez un écouteur d'événements pour la saisie de l'ancien mot de passe
    oldmdpInput.addEventListener('input', function () {
        var isOldPasswordEmpty = oldmdpInput.value.trim() === '';
        oldMdpError.textContent = isOldPasswordEmpty ? 'Saisissez le mot de passe actuel' : '';
        updateFormState(); // Déclencher la mise à jour de l'état du formulaire
    });

    function isStrongPassword(password) {
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{6,}$/;
        return passwordRegex.test(password);
    }

    function passwordsMatch(password, confirmPassword) {
        return password === confirmPassword;
    }

    // Fonction pour mettre à jour l'état du formulaire et activer/désactiver le bouton 
    function updateFormState() {
        var isOldPasswordEmpty = oldmdpInput.value.trim() === '';
        oldMdpError.textContent = isOldPasswordEmpty ? 'Saisissez le mot de passe actuel' : '';
        
        var isNewPasswordValid = isStrongPassword(nouveauMdpInput.value);
        var doPasswordsMatch = passwordsMatch(nouveauMdpInput.value, confirmMdpInput.value);

        newMdpError.textContent = isNewPasswordValid ? '' : 'Le nouveau mot de passe doit contenir: 6 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial';
        confirmMdpError.textContent = doPasswordsMatch ? '' : 'Les mots de passe ne correspondent pas';

        submitBtn.disabled = !(isNewPasswordValid && doPasswordsMatch);
    }
});
