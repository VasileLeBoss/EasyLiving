<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Date Picker avec Dates Prédéfinies</title>
</head>
<body>
    <label for="datePicker">Sélectionnez une date :</label>
    <input type="date" id="datePicker">



    <?php require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        print_r( $result = $monModele->restrictedDateRangesFromDatabase(16));?>
    <script>
        // Tableau des dates prédéfinies non sélectionnables
        var disabledDates = [
            ["2022-02-01", "2022-02-05"],
            ["2022-08-01", "2022-10-05"]
        ];

        // Fonction pour désactiver les dates prédéfinies
        function disableDates(date) {
            var stringDate = date.toISOString().substr(0, 10); // Convertir la date en format YYYY-MM-DD
            for (var i = 0; i < disabledDates.length; i++) {
                var startDate = disabledDates[i][0];
                var endDate = disabledDates[i][1];
                if (stringDate >= startDate && stringDate <= endDate) {
                    return true; // Désactiver la date si elle est dans l'intervalle prédéfini
                }
            }
            return false;
        }

        // Sélection de l'élément input date
        var datePicker = document.getElementById('datePicker');

        // Appliquer la fonction de désactivation des dates prédéfinies
        datePicker.addEventListener('input', function() {
            var selectedDate = new Date(this.value); // Convertir la date sélectionnée en objet Date
            if (disableDates(selectedDate)) {
                alert('Cette date est indisponible.'); // Afficher un message d'erreur si la date est indisponible
                this.value = ''; // Réinitialiser la valeur de l'input date
            }
        });


        
    </script>
</body>
</html>
