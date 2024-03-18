<div class="grid-view-demandes">
    <div class="display-flex align-verticaly relative">
        <a href="v_compte-annonce.php" class="aligne-icon return-demande">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
        <h2 class="no-mar-pad second-color capitalize"><?php echo $appartementAnnonce->getRue(); ?>, Paris
            <?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?></h2>

    </div>
    <?php if(!empty($demandes)):?>
    <h3 class='no-mar-pad text-color-black underline'>Prochaine Locataire</h3>
    <?php endif; ?>
    <?php foreach ($demandes as $demande) : ?>

    <?php 
        $demandeur = new Utilisateur;
        $demandeur = $demandeur->createUtilisateur($modele->getDemandeurById($demande['id_demandeur'])); 
    ?>
    <div class="box-view-demandes display-flex flex-column gap-10px">

        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">ID</span>
                <?php echo $demande['num_dem'] ;?>
            </div>
        </div>

        <div class="display-flex gap-24px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DATE ARRIVÉE</span>
                <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
            </div>

            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DATE DEPART</span>
                <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DEMANDEUR</span>
                <?php echo $demandeur->getNomComplet() ;?>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly"></div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">

            <div class="display-flex flex-column gap-10px align-verticaly"></div>

            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">PLUS</span>

                <ion-icon
                    data-target="<?php echo $demande['num_dem'] ;?>"
                    class="plus"
                    name="chevron-down-circle-outline"></ion-icon>
            </div>

        </div>
    </div>
    <div class="hidden voir-plus-demande" id="<?php echo $demande['num_dem'] ;?>">
        <h3 class="no-mar-pad">Informations additionnelles</h3>
        <div class="display-grid grid-template-columns-2 gap-10px">
            <div class="display-flex flex-column gap-10px">
                <div class="display-flex flex-column gap-5px">
                    <span class="small second-color">EMAIL</span>
                    <?php echo $demandeur->getEmail() ;?>
                </div>
                <div class="display-flex flex-column gap-5px">
                    <span class="small second-color">NUMÉRO TÉLÉPHONE</span>
                    <?php echo $demandeur->getTel() ;?>
                </div>

            </div>
            <div class="display-flex flex-column gap-10px">

                <div class="display-flex flex-column gap-5px">
                    <span class="small second-color">NUITS</span>
                    <span><?php echo $appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']) ?></span>
                </div>

                <div class="display-flex space-between flex-wrap gap-10px">
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">GAGNE POTENTIELLE</span>
                        <span><?php echo $appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()) ?>
                            €</span>
                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">TAXES</span>
                        <span><?php echo $appartementAnnonce->calculerLesTaxes($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal())) ?>
                            €</span>
                    </div>

                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">GAGNE RÉEL</span>
                        <span><?php echo $appartementAnnonce->calculerGagneReel($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()),$appartementAnnonce->calculerLesTaxes($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()))) ?>
                            €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
    document
        .querySelectorAll('.plus')
        .forEach(function (button) {
            button.addEventListener('click', function () {
                var targetId = button.getAttribute('data-target');

                var targetDiv = document.getElementById(targetId);

                if (targetDiv.classList.contains('hidden')) {
                    targetDiv
                        .classList
                        .remove('hidden');
                    button
                        .classList
                        .add('rotate-icon');
                } else {
                    targetDiv
                        .classList
                        .add('hidden');
                    button
                        .classList
                        .remove('rotate-icon');
                }
            });
        });
</script>