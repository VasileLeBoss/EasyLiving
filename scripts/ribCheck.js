
    document.addEventListener('DOMContentLoaded', function () {
        const numCompteInput = document.getElementById('num_compte');
        const banqueInput = document.getElementById('banque');
        const telBanqueInput = document.getElementById('tel_banque');
        const adresseBanqueInput = document.getElementById('adresse_banque');
        const codePostalInput = document.getElementById('Code_postal');
        const checkboxRemboursement = document.getElementById('checkboxrRemboursement');
        const checkboxConditions = document.getElementById('checkboxConditions');
        const submitButton = document.querySelector('.box-compte-information button');

        function validateNumCompte() {
            const numCompte = numCompteInput.value.trim();
            const isValid = /^[0-9]{11}$/.test(numCompte);
            return { isValid, message: isValid ? '' : 'Le numéro de compte est invalide' };
        }

        function validateBanque() {
            const banque = banqueInput.value.trim();
            const regex = /^[A-Za-z]+$/;
        
            const isValid = banque.length > 0 && regex.test(banque);
            return { isValid, message: isValid ? '' : 'Le champ est obligatoire' };
        }
        

        function validateTelBanque() {
            const telBanque = telBanqueInput.value.trim();
            const isValid = /^[0-9]{10}$/.test(telBanque);
            return { isValid, message: isValid ? '' : 'Le téléphone est invalide' };
        }

        function validateAdresseBanque() {
            const adresseBanque = adresseBanqueInput.value.trim();
            const regex = /^\d+\s[A-Za-z\s]+$/;
        
            const isValid = regex.test(adresseBanque);
            return { isValid, message: isValid ? '' : 'Adresse invalide' };
        }
        

        function validateCodePostal() {
            const codePostal = codePostalInput.value.trim();
            const isValid = /^[0-9]{5}$/.test(codePostal);
            return { isValid, message: isValid ? '' : 'Le code postal est invalide' };
        }

        function validateCheckboxes() {
            return checkboxRemboursement.checked && checkboxConditions.checked;
        }

        function updateSubmitButton() {
            const numCompteValidation = validateNumCompte();
            const banqueValidation = validateBanque();
            const telBanqueValidation = validateTelBanque();
            const adresseBanqueValidation = validateAdresseBanque();
            const codePostalValidation = validateCodePostal();

            submitButton.disabled = !(numCompteValidation.isValid && banqueValidation.isValid &&
                telBanqueValidation.isValid && adresseBanqueValidation.isValid && codePostalValidation.isValid &&
                validateCheckboxes());

            document.getElementById('num_compteError').textContent = numCompteValidation.message;
            document.getElementById('banqueError').textContent = banqueValidation.message;
            document.getElementById('tel_banqueError').textContent = telBanqueValidation.message;
            document.getElementById('adresse_banqueError').textContent = adresseBanqueValidation.message;
            document.getElementById('Code_postalError').textContent = codePostalValidation.message;
        }

        // Ajoutez des écouteurs d'événements pour chaque champ d'entrée
        numCompteInput.addEventListener('input', updateSubmitButton);
        banqueInput.addEventListener('input', updateSubmitButton);
        telBanqueInput.addEventListener('input', updateSubmitButton);
        adresseBanqueInput.addEventListener('input', updateSubmitButton);
        codePostalInput.addEventListener('input', updateSubmitButton);
        checkboxRemboursement.addEventListener('change', updateSubmitButton);
        checkboxConditions.addEventListener('change', updateSubmitButton);
    });
