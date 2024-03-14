function checkFieldValidity(input) {
    if (input.type === 'radio') {
        // Vérifier si au moins un bouton radio du groupe est sélectionné
        var radioGroup = document.querySelectorAll('input[name="' + input.name + '"]');
        var isAnyChecked = Array.from(radioGroup).some(radio => radio.checked);
        
        displayError(input.id + 'Error', isAnyChecked, 'Veuillez sélectionner une option.');
    } else {
    
    }

    checkFormValidity();
}

document.querySelectorAll('input[type="radio"]').forEach(input => {
    input.addEventListener('change', function() {
        checkFieldValidity(input);
    });
});

// Fonction pour afficher les erreurs
function displayError(spanId, isValid, errorMessage) {
    var errorSpan = document.getElementById(spanId);
    if (errorSpan) {
        errorSpan.textContent = isValid ? '' : errorMessage;
    }
}

function checkFieldValidity(input) {
    if (input.type === 'radio') {
        // Vérifier si au moins un bouton radio du groupe est sélectionné
        var radioGroup = document.querySelectorAll('input[name="' + input.name + '"]');
        var isAnyChecked = Array.from(radioGroup).some(radio => radio.checked);
        
        displayError(input.id + 'Error', isAnyChecked, 'Veuillez sélectionner une option.');
    } else {
    
    }

    checkFormValidity();
}

document.querySelectorAll('input[type="radio"]').forEach(input => {
    input.addEventListener('change', function() {
        checkFieldValidity(input);
    });
});

function checkFieldValidity(input) {
    if (input.type === 'radio') {
        var radioGroup = document.querySelectorAll('input[name="' + input.name + '"]');
        var isAnyChecked = Array.from(radioGroup).some(radio => radio.checked);
        
        displayError(input.id + 'Error', isAnyChecked, 'Veuillez sélectionner une option.');
    }

    checkFormValidity();
}

document.querySelectorAll('input[type="radio"]').forEach(input => {
    input.addEventListener('change', function() {
        
        checkFieldValidity(input);
    });
});

function displayError(spanId, isValid, errorMessage) {
    var errorSpan = document.getElementById(spanId);
    if (errorSpan) {
        errorSpan.textContent = isValid ? '' : errorMessage;
    }
}

function checkFormValidity() {
    var allInputsValid = Array.from(document.querySelectorAll('input')).every(input => {
        return input.type === 'radio' ? true : input.checkValidity();
    });

    var submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        
        submitButton.disabled = !allInputsValid;
    }
}

