<?php
include('header-annonce.php');
include('../controls/connected.php');
?>

<div class="min-conteiner ">
    <div class="full-width-white">
        <h1>Où est situé votre logement ?</h1>
    </div>
    <form id="form-annonce" action="../controls/c_nouveauAppartement.php" method="post">
    <div class="conteiner-form-annonce">

        <div class="box">
            <div class="grid-rows-form-appartement">
                        <div class="location">
                <label for="rue">Rue</label>
                <input class="capitalize" type="text" id="rue" name="rue" value="<?php echo $_SESSION['appart_temp']->getRue(); ?>" required>
                <span class="error-message" id="rueError"></span>
            </div>
            <div class="location">
                <label for="arrondissement">Arrondissement</label>
                <input type="number" id="arrondissement" name="arrondissement" value="<?php echo $_SESSION['appart_temp']->getArrondissement(); ?>" required>
                <span class="error-message" id="arrondissementError"></span>
            </div>
            <div class="location">
    <label for="etage">
        <span class="align-verticaly">
            Etage<ion-icon name="information-circle-outline" class="info-icon" title="Veuillez entrer 0 pour le rez-de-chaussée."></ion-icon>
        </span>
    </label>
    <input type="number" id="etage" name="etage" value="<?php echo $_SESSION['appart_temp']->getEtage(); ?>" required>
    <span class="error-message" id="etageError"></span>
</div>

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
            <a href="v_depot-annonce-structure.php"><button type="button"><b>Retour</b></button></a> 
            </div>
            <div class="align-verticaly end">
                <input type="hidden" name="form-annonce" value="location">
                <button id="submitbtn" type="submit" disabled><b>Continuer</b></button>
            
            </div>
        </div>
      
    </div>
    </form>
</div>

<script src="../scripts/annonce-formCheck-location.js"></script> 
<script src="../scripts/progressBar.js"></script>
<script>
setProgress(25); 
</script>
</body>