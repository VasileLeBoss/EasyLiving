
<div class="box display-flex flex-column ">

    <h2 class="no-mar-pad">
        <span class="aligne-icon gap-10px">
            <ion-icon name="albums-outline"></ion-icon>Annonces</span>
    </h2>
    </div>
    <?php if (empty($AllAppartements)) :  echo "<h3>Aucune annonce disponible </h3>";?>

<?php else: ?>
    <div class="conteiner-grid-accueil-annonces">

        <?php foreach ($AllAppartements as $appartement) : ?>
        <a href="#" onclick="submitForm(<?php echo $appartement->getNumappart() ?>)">
            <div class="box-grid-accueil-annonce">
                <div class="img-annonce align-horizontaly">
                    <img src="../../src/<?php echo $appartement->getTypappart() . '.png'; ?>" alt="">
                </div>
                <div class="annonce-info">
                    <p class="font-size-16px capitalize"><?php echo $appartement->getRue() . ', Paris ' ?></p>
                    <span class="font-size-16px"><?php echo $appartement->getArrondissement() > 1 ? $appartement->getArrondissement() . 'ème' : $appartement->getArrondissement() . 'er'; ?></span>
                </div>
                <div class="annonce-info">
                    <p class="grey font-size-16px"><?php echo $appartement->getDateLibre(); ?></p>
                </div>
                <div class="annonce-info">
                    <p>
                        <strong class="second-color "><?php echo ($appartement->getPrixLoc() + $appartement->getPrixCharg()) . '€'; ?></strong>
                        <span class="grey font-size-16px">par nuit</span>
                    </p>
                    <!-- <span class="button align-horizontaly align-verticaly"><ion-icon name="ticket-outline"></ion-icon></span> -->
                </div>

                <form
                    action="../controls/c_AppartementsAccueil.php"
                    method="post"
                    id="form_<?php echo $appartement->getNumappart() ?>">
                    <input
                        type="hidden"
                        name="view-annonce"
                        value="<?php echo $appartement->getNumappart() ?>">
                </form>

            </div>
        </a>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>
<script>
    function submitForm(formId) {
        document
            .getElementById('form_' + formId)
            .submit();
    }
</script>