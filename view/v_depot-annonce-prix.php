<?php
include('header-annonce.php');
include('../controls/connected.php');
?>

<div class="min-conteiner ">
    <div class="full-width-white">
        <h1>Quel prix souhaitez-vous fixer ? </h1>
    </div>
    <form id="form-annonce" action="../controls/c_nouveauAppartement.php" method="post">
    <div class="conteiner-form-annonce">

        <div class="box">
            <div class="grid-rows-form-appartement">
                <div class="location">
                <label for="prix_loc" class="small">Indiquer le loyer (hors charges)</label>
                <input type="text" min="0" id="prix_loc" name="prix_loc" placeholder="€/mois" value="<?php echo $_SESSION['appart_temp']->getPrixLoc(); ?>" required>
                <span id="prix_locError" class="error-message"></span> 

                </div>
                <div class="location">
                <label for="prix_charg" class="small">À combien s'élèvent les charges ?</label>
                <input type="text" min="0" id="prix_charg" name="prix_charg" placeholder="€/mois" value="<?php echo $_SESSION['appart_temp']->getPrixCharg(); ?>" required>
                <span id="prix_chargError" class="error-message"></span>

                </div>

                <div class="location">
            <details>
                <summary class="summary_prix_annonce align-verticaly space-between">
                    <span><h3><span class="aligne-icon"><ion-icon name="chevron-down-outline"></ion-icon>Coût total pour le voyageur</span></h3></span>
                    <span class="end"><h3 id="total">0</h3></span>
                </summary>
                <table class="table_annonce">
                    <tr>
                        <td>Prix hors charges:</td>
                        <td id="basePrice"></td>
                    </tr>
                    <tr>
                        <td>Charges :</td>
                        <td id="charges"></td>
                    </tr>
                    <tr>
                        <td>Taxes<ion-icon name="information-circle-outline" class="info-icon" title="Le montant total est soumis aux frais et taxes, y compris une taxe de 7 %."></ion-icon> :</td>
                        <td id="tax">7%</td>
                    </tr>
                    <tr>
                        <td id="totaltr"><strong>Vous gagnez :</strong></td>
                        <td id="totalGagne">0</td>
                    </tr>
                </table>
            </details>
        </div>
        <!-- <h3>En savoir plus sur la tarification</h3> -->
            </div>
        </div>
    </div>
    <div class="progress-bar">
        <div class="progress"></div>
    </div>
    <div class="progress-bar-conteiner align-verticaly">
        <div class="progress-bar-grid ">
            <div class="align-verticaly start">
            <a href="v_depot-annonce-access.php"><button type="button"><b>Retour</b></button></a> 
            </div>
            <div class="align-verticaly end">
                <input type="hidden" name="form-annonce" value="prix">
                <button id="submitbtn" type="submit" disabled><b>Continuer</b></button>
            </div>
        </div>
    </div>
    </form>
</div>

<script src="../scripts/annonce-formCheck-prix.js"></script> 
<script src="../scripts/progressBar.js"></script>
<script>
setProgress(75); 
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Récupération des éléments du DOM
    var prixLocInput = document.getElementById('prix_loc');
    var prixChargInput = document.getElementById('prix_charg');
    var basePriceElement = document.getElementById('basePrice');
    var chargesElement = document.getElementById('charges');
    var taxElement = document.getElementById('tax');
    var totalElement = document.getElementById('total');
    var totalGagneElement = document.getElementById('totalGagne');
    // Fonction pour mettre à jour les montants
    function updateAmounts() {
        var basePrice = parseFloat(prixLocInput.value) || 0;
        var charges = parseFloat(prixChargInput.value) || 0;

        // Calcul du coût total sans la taxe
        var totalWithoutTax = basePrice + charges;

        // Calcul de la taxe (7%)
        var tax = totalWithoutTax * 0.07;

        // Calcul du coût total avec la taxe
        var totalWithTax = totalWithoutTax - tax;

        // Mise à jour des éléments HTML avec les valeurs calculées
        basePriceElement.innerText = basePrice.toFixed(2) + '€';
        chargesElement.innerText = charges.toFixed(2) + '€';
        taxElement.innerText = '- '+ tax.toFixed(2) + '€';
        totalElement.innerText = totalWithoutTax.toFixed(2) + '€';
        totalGagneElement.innerHTML = '<strong>' + totalWithTax.toFixed(2) + '€</strong>';

    }

    // Écouteurs d'événements pour chaque champ d'entrée
    prixLocInput.addEventListener('input', updateAmounts);
    prixChargInput.addEventListener('input', updateAmounts);

    var summaryElement = document.querySelector('.summary_prix_annonce');
    var iconElement = summaryElement.querySelector('ion-icon');

        summaryElement.addEventListener('click', function () {
        iconElement.classList.toggle('rotate-icon');
        });
    updateAmounts();});

</script>


</body>