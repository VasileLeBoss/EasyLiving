<?php

include('header.php');
include('../controls/connected.php');

?>

<?php if (!empty($_SESSION['messageUpdateAnnonce'])) : ?>
<div
    class='align-horizontaly align-verticaly absolute width-100 height-100'
    id='messageUpdateAnnonce'>
    <span class='annonce-positif'><?php echo $_SESSION['messageUpdateAnnonce']; ?></span>
</div>
<script>

    setTimeout(function () {
        var message = document.getElementById('messageUpdateAnnonce');
        message.style.opacity = '0';
        setTimeout(function () {
            message.style.display = 'none';
        }, 1000);
    }, 2000);
</script>
<?php endif; ?>

<div class="min-conteiner">
    <div class="full-width-white-padding-header align-verticaly space-between flex-wrap  gap-10px">
        <a href="v_compte-annonce.php">
            <h1>Mes annonces</h1>
        </a>

        <div class="aling-horizontaly align-verticaly gap-10px flex-wrap">
            <form action="" method="post">

                <span class="align-verticaly relative">
                    <input
                        type="search"
                        name="search-request"
                        id="search-annonce"
                        placeholder="Chercher une annonce">
                    <ion-icon
                        name="search-outline"
                        style="position:absolute; right: 10px;"
                        onclick="submitForm()"></ion-icon>
                </span>
            </form>
            <form action="../controls/c_nouveauAppartement.php" method="post">
                <button type="submit">Déposer mon annonce</button>
            </form>
        </div>
    </div>
    <?php
require_once('../controls/c_AppartementsUtilisateur.php');
?>
    <div class="grid-compte">
        <?php if(isset($_SESSION['messageUpdateAnnonce'])) : unset($_SESSION['messageUpdateAnnonce']); endif;?>
        <?php if (empty($appartements)) :  echo $messageNoResult?>
    <?php else: ?>
        <?php foreach ($appartements as $appartement) : ?>
        <div class="relative">
            <a href="#" onclick="submitForm(<?php echo $appartement->getNumappart() ?>)">
                <div class="box-grid-accueil-annonce">
                    <div class="img-annonce align-horizontaly">
                        <img src="../src/<?php echo $appartement->getTypappart() . '.png'; ?>" alt="">
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

                    </div>

                    <form
                        action=""
                        method="post"
                        id="form_<?php echo $appartement->getNumappart() ?>">
                        <input
                            type="hidden"
                            name="view-annonce"
                            value="<?php echo $appartement->getNumappart() ?>">
                    </form>
                </div>
            </a>
            <?php if ($appartement->getNombreDemandesAppartementById() > 0 ): ?>

            <span
                onclick="submitFormDemande(<?php echo $appartement->getNumappart() ?>)"
                class="button-demande align-horizontaly align-verticaly">
                <ion-icon name="folder-outline"></ion-icon>
                <span class="notification-absolute"><?php echo $appartement->getNombreDemandesAppartementById();?></span>
            </span>

            <form
                action=""
                method="post"
                id="formDemande_<?php echo $appartement->getNumappart() ?>">
                <input type="hidden" name="view-demande" value="<?php echo $appartement->getNumappart() ?>">
            </form>

            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <script>
            function submitForm(formId) {
                document
                    .getElementById('form_' + formId)
                    .submit();
            }
            function submitFormDemande(formId) {
                document
                    .getElementById('formDemande_' + formId)
                    .submit();
            }
        </script>

        <?php endif; ?>

    </div>
</div>
<?php
include('footer.php')
?>