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
    <div
        class="full-width-white-padding-header align-verticaly space-between flex-wrap  gap-10px">
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
    <?php require_once('../controls/c_AppartementsUtilisateur.php');?>
    <div class="grid-compte">
        <?php if(isset($_SESSION['messageUpdateAnnonce'])) : unset($_SESSION['messageUpdateAnnonce']); endif;?>
        <?php if (empty($appartements)) :  echo $messageNoResult?>
    <?php else: ?>
        <?php foreach ($appartements as $appartement) : ?>
        <div class="relative ">
            <a href="#" onclick="submitForm(<?php echo $appartement->getNumappart() ?>)">
                <div class="box-grid-accueil-annonce no-hover-shadows">
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

            <div class="notification-absolute-div">

                <?php if ($appartement->getNombreLocataireAppartementById() > 0 ): ?>
                <span
                    onclick="submitFormLocataire(<?php echo $appartement->getNumappart() ?>)"
                    class="button-demande align-horizontaly align-verticaly relative">
                    <ion-icon name="people-outline"></ion-icon>
                    <span class="notification-absolute"><?php echo $appartement->getNombreLocataireAppartementById();?></span>

                </span>

                <form
                    action=""
                    method="post"
                    id="formDemandeLocataire_<?php echo $appartement->getNumappart() ?>">
                    <input
                        type="hidden"
                        name="view-locataire"
                        value="<?php echo $appartement->getNumappart() ?>">
                </form>

                <?php endif; ?>

                <?php if ($appartement->getNombreDemandesAppartementById() > 0 ): ?>
                <span
                    onclick="submitFormDemande(<?php echo $appartement->getNumappart() ?>)"
                    class="button-demande align-horizontaly align-verticaly relative">
                    <ion-icon name="folder-outline"></ion-icon>
                    <span class="notification-absolute"><?php echo $appartement->getNombreDemandesAppartementById();?></span>
                </span>

                <form
                    action=""
                    method="post"
                    id="formDemande_<?php echo $appartement->getNumappart() ?>">
                    <input
                        type="hidden"
                        name="view-demande"
                        value="<?php echo $appartement->getNumappart() ?>">
                </form>

                <?php endif; ?>
            </div>

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
            function submitFormLocataire(formId) {
                document
                    .getElementById('formDemandeLocataire_' + formId)
                    .submit();
            }

            document.addEventListener("DOMContentLoaded", function () {
                const notificationDivs = document.querySelectorAll(
                    '.notification-absolute-div'
                );
                notificationDivs.forEach(function (div) {
                    if (div.innerHTML.trim() === '') {
                        div
                            .classList
                            .add('empty');
                    }
                });
            });
        </script>
        <?php endif; ?>
    </div>



<?php if( !empty($appartements) ): ?>
    <?php
        $nb = 0;
        foreach ($appartements as $appartement) {
            $nb = $nb + $appartement->getNombreLocataireAppartementById();
        }
    ?>
    <?php if(  $nb > 0 ): ?>
<div class="cotisation">
    <div class="display-flex space-between">
        <div>
            <h2 class="underline"  onclick="toggleDetailCotisation()"><span class="align-verticaly gap-10px"><ion-icon id="icon-cotisation" name="chevron-down-outline"></ion-icon>Revenu</span></h2>
        </div>
        <div>
            <h2 onclick="toggleDetailCotisation()"><?php echo $_SESSION['utilisateur']->calculeRevenuUtilisateur()*0.93." €"; ?></h2>
        </div>
    </div>
    <div class="display-flex">
        <div>
            <?php $revenuparmois = $_SESSION['utilisateur']->revenusParMoisUtilisateur(); ?>
        </div>
        <ul class="capitalize">
          
            <?php foreach($revenuparmois as $mois => $revenu) : ?>
            <li
                class="display-flex flex-column space-between align-verticaly revenu-li relative"
                data-revenu="<?php echo $revenu; ?>">
                <span class="small revenu-li"><?php echo $revenu*0.93.'€';?></span>
                <span class="mois-li"><?php echo $_SESSION['utilisateur']->formaterMoisAnnee($mois);?></span>
            </li>
            <?php endforeach; ?>
            
        </ul>

    </div>
</div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    
        var revenuLiElements = document.querySelectorAll('.revenu-li');
        revenuLiElements.forEach(function (liElement) {
            var revenu = parseFloat(liElement.getAttribute('data-revenu'));
            var hauteur = revenu * 0.025;
            liElement.style.height = hauteur + 'px';
        });
    });
</script>
<script>
    function toggleDetailCotisation() {
        var divCotisations = document.querySelectorAll('.cotisation');
        var iconCotisation = document.getElementById('icon-cotisation');
        divCotisations.forEach(function(divCotisation) {
            var currentBottom = divCotisation.style.bottom;
            if (currentBottom == "0px") {
                divCotisation.style.bottom = "-195px";
                iconCotisation.classList.remove('rotate-icon');
            } else {
                divCotisation.style.bottom = "0px";
                iconCotisation.classList.add('rotate-icon');
            }
        });
    }
</script>



<?php endif;?>
</div>