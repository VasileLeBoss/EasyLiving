document.addEventListener('DOMContentLoaded', function () {
    var dateInput = document.querySelector('input[name="date_libre"]');
    var currentDate = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', currentDate);

    // Set initial state for radio buttons and trigger 'input' event
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        if (input.checked) {
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }
    });

    // Trigger the 'input' event for the date input when the page loads
    dateInput.dispatchEvent(new Event('input'));

    // Trigger the 'input' event for pre-filled date fields
    document.querySelectorAll('input[type="date"][value]').forEach(input => {
        if (input.valueAsDate) {
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }
    });

    // Call checkFormValidity to set the initial state of the submit button
    checkFormValidity();

    // Add an input event listener to each radio and date input
    document.querySelectorAll('input[type="radio"], input[type="date"]').forEach(input => {
        input.addEventListener('input', function() {
            checkFieldValidity(input);
        });
    });
});

function checkFieldValidity(input) {
    if (input.type === 'radio') {
        var radioGroup = document.querySelectorAll('input[name="' + input.name + '"]');
        var isAnyChecked = Array.from(radioGroup).some(radio => radio.checked);
        displayError(input.id + 'Error', isAnyChecked, 'Veuillez sélectionner une option.');
    } else if (input.type === 'date') {
        // Ajouter une vérification pour la validité de la date
        checkDateValidity(input);
    } else {
        // Handle other input types if needed
    }

    checkFormValidity();
}

// Ajoutez cette fonction pour vérifier la validité de la date
function checkDateValidity(input) {
    var isValidDate = input.checkValidity() && input.value.trim() !== '';
    displayError(input.id + 'Error', isValidDate, 'Veuillez sélectionner une date valide.');
}

document.querySelectorAll('input[type="radio"], input[type="date"]').forEach(input => {
    input.addEventListener('input', function() {
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
        if (input.type === 'radio') {
            var radioGroup = document.querySelectorAll('input[name="' + input.name + '"]');
            return Array.from(radioGroup).some(radio => radio.checked);
        } else {
            return input.checkValidity() && input.value.trim() !== ''; // Check for non-empty value
        }
    });

    var submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.disabled = !allInputsValid;
    }
}

 document.addEventListener("DOMContentLoaded", function() {
    // Obtenez le type d'appartement de l'objet dans la session
    var preavisFromSession = "<?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getPreavis() : ''; ?>";
    var ascenseurFromSession = "<?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getAscenseur() : ''; ?>";

    // Trouvez les boutons radio correspondants
    var preavisRadio = document.querySelector('input[name="preavis"][value="' + preavisFromSession + '"]');
    var ascenseurRadio = document.querySelector('input[name="ascenseur"][value="' + ascenseurFromSession + '"]');

    // Vérifiez s'ils existent avant de les sélectionner
    if (preavisRadio) {
        preavisRadio.checked = true;
        var changeEventPreavis = new Event('change', { bubbles: true });
        preavisRadio.dispatchEvent(changeEventPreavis);
    }

    if (ascenseurRadio) {
        ascenseurRadio.checked = true;
        var changeEventAscenseur = new Event('change', { bubbles: true });
        ascenseurRadio.dispatchEvent(changeEventAscenseur);
    }
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.dispatchEvent(new Event('input', { bubbles: true }));
    });
});