<?php
include('header-annonce.php');
include('../controls/connected.php');
?>

<div class="min-conteiner ">
    <div class="full-width-white">
        <h1>Indiquez les disponibilités</h1>
    </div>
    <form id="form-annonce" action="../controls/c_nouveauAppartement.php" method="post">
    <div class="conteiner-form-annonce">

        <div class="box">
        <h3>Ascenseur</h3>
        <div class="grid-columns-form-appartement">
                <div>
                <label for="true">
                    <div class="input-option align-verticaly align-horizontaly ">
                    
                    <input type="radio" id="true" name="ascenseur"  value="1" required>
                        <label class="aligne-icon"  for="true">Oui<ion-icon name="checkmark-outline"></ion-icon></label>
                        <i></i>
                    </div>
                </label>
                </div>
                <div>
                <label for="false">
                    <div class="input-option align-verticaly align-horizontaly ">
                        <input type="radio" id="false" name="ascenseur"  value="0" required>
                        <label class="aligne-icon" for="false">Non <ion-icon name="close-outline"></ion-icon></label>
                        <i></i>
                    </div>
                </label>
                </div>
            </div>
            <h3>Date libre</h3>
        <div class="grid-columns-form-appartement">
                <div>
                <label for="date">
                    <div class="input-option align-verticaly align-horizontaly ">
                    <input type="date" name="date_libre" id="date_libre" value="<?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getDateLibre() : ''; ?>">
                    </div>
                </label>
                </div>
            </div>
            <h3>Préavis</h3>
        <div class="grid-columns-form-appartement">
                <div>
                <label for="true-preavis">
                    <div class="input-option align-verticaly align-horizontaly ">
                    <input type="radio" id="true-preavis" name="preavis"  value="1" required>
                        <label class="aligne-icon"  for="true-preavis">Oui<ion-icon name="checkmark-outline"></ion-icon></label>
                        <i></i>
                    </div>
                </label>
                </div>
                <div>
                <label for="false-preavis">
                    <div class="input-option align-verticaly align-horizontaly ">
                        <input type="radio" id="false-preavis" name="preavis"  value="0" required>
                        <label class="aligne-icon" for="false-preavis">Non <ion-icon name="close-outline"></ion-icon></label>
                        <i></i>
                    </div>
                </label>
                </div>
            </div>
            <span class="small align-verticaly" style="margin-top:8px;"><ion-icon name="information-circle-outline" class="info-icon"></ion-icon>Le préavis est de 2 jours.</span>

            <div id="divPreavis" class="hidden">
            <!-- <h3>Quel est le préavis nécessaire pour ce logement ?</h3>
            <select name="preavis" id="preavis">
                <option value="7">Une semaine </option>
                <option value="30">Un mois </option>
                <option value="60" >Deux mois</option>
            </select> -->
    </div>
        </div>
    </div>
    <div class="progress-bar">
    <div class="progress"></div>
    </div>
    <div class="progress-bar-conteiner align-verticaly start">
    </div>
    <div class="progress-bar-conteiner align-verticaly">
        <div class="progress-bar-grid ">
            <div class="align-verticaly start">
            <a href="v_depot-annonce-location.php"><button type="button"><b>Retour</b></button></a> 
            </div>
            <div class="align-verticaly end">
                <input type="hidden" name="form-annonce" value="access">
                <button id="submitbtn" type="submit" disabled><b>Continuer</b></button>
            </div>
        </div>
    </div>
    </form>
</div>
<script src="../scripts/annonce-formCheck-access.js"></script>
<script src="../scripts/icon-radio-change.js"></script>

<script src="../scripts/progressBar.js"></script>
<script>setProgress(50);</script>
<script>

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
</script>
<script>
        var truePreavisRadio = document.getElementById('true-preavis');
        var falsePreavisRadio = document.getElementById('false-preavis');
        var divPreavis = document.getElementById('divPreavis');
        truePreavisRadio.addEventListener('change', function() {
            divPreavis.style.display = this.checked ? 'block' : 'none';
        });
        falsePreavisRadio.addEventListener('change', function() {
            divPreavis.style.display = this.checked ? 'none' : 'block';
        });
</script>
<script>

</script>

</body>