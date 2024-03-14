<!-- <?php
include('header-annonce.php');
include('../controls/connected.php');
?>

<div class="min-conteiner ">
    <div class="full-width-white">
        <h1>Choisissez une image pour votre appartement</h1>
    </div>
    <form id="form-annonce" action="../controls/c_nouveauAppartement.php" method="post" enctype="multipart/form-data">
    <div class="conteiner-form-annonce">

    <div class="box">
    <label for="image" class="img-choisir">
        <div class="image-annonce align-verticaly align-horizontaly">
            <ion-icon name="add-outline"></ion-icon>
        </div>
    </label>
    <input type="file" name="image" id="image" accept="image/*" onchange="afficherImage()" style="display: none;">

    <div class="image-selectionnee">
    <label for="image" class="img-choisir">
       <div class="button align-verticaly align-horizontaly">Modifier</div>
       </label>
    </div>
    </div>
    <style>

</style>
    </div>
    <div class="progress-bar">
        <div class="progress"></div>
    </div>
    <div class="progress-bar-conteiner align-verticaly">
        <div class="progress-bar-grid ">
            <div class="align-verticaly start">
            <a href="v_depot-annonce-prix.php"><button type="button"><b>Retour</b></button></a> 
            </div>
            <div class="align-verticaly end">
                <input type="hidden" name="form-annonce" value="image">
                <button id="submitbtn" type="submit" disabled><b>Continuer</b></button>
            </div>
        </div>
    </div>
    </form>
</div>

<script src="../scripts/annonce-formCheck-prix.js"></script> 
<script src="../scripts/progressBar.js"></script>
<script>
setProgress(90); 
</script>
<script>
    function afficherImage() {
        var input = document.getElementById('image');
        var imageAnnonce = document.querySelector('.image-annonce');
        var imageSelectionnee = document.querySelector('.image-selectionnee');
        var submitBtn = document.getElementById('submitbtn');

        // Vérifier si un fichier a été sélectionné
        if (input.files && input.files[0]) {
            var lecteur = new FileReader();

            lecteur.onload = function (e) {
                // Mettre à jour le fond avec l'image sélectionnée
                imageAnnonce.style.display = 'none'; // Masquer l'image par défaut
                imageSelectionnee.style.display = 'block'; // Afficher la nouvelle image
                imageSelectionnee.style.backgroundImage = 'url(' + e.target.result + ')';
                
                // Activer le bouton
                submitBtn.disabled = false;
            };

            lecteur.readAsDataURL(input.files[0]); // Lire le fichier en tant que données URL
        }
    }
</script>


</body> -->