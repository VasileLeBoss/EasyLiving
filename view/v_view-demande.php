<div class="grid-view-demandes">
    <div class="display-flex align-verticaly relative">
        <a href="v_compte-annonce.php" class="aligne-icon return-demande">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
        <h2 class="no-mar-pad second-color capitalize"><?php echo $appartementAnnonce->getRue(); ?>, Paris
            <?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?></h2>

    </div>
    <?php if(!empty($ea)):?>
    <h3 class='no-mar-pad text-color-black underline'>En attente</h3>
    <?php endif; ?>
    <?php foreach ($ea as $demande) : ?>

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
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">PLUS</span>

                <ion-icon
                    data-target="<?php echo $demande['num_dem'] ;?>"
                    class="plus"
                    name="chevron-down-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">

            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">APPROUVER</span>
                <form action="../controls/c_Demandes.php" method="post">
                    <input
                        type="hidden"
                        name="approuver-demande-ap"
                        value="<?php echo $demande['num_dem'] ;?>">
                    <button id="accepter">
                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                    </button>
                </form>
            </div>

            <div class="display-flex flex-column gap-10px align-verticaly">

                <span class="small second-color">DÉCLINER</span>
                <form action="../controls/c_Demandes.php" method="post">
                    <input
                        type="hidden"
                        name="annuler-demande-an"
                        value="<?php echo $demande['num_dem'] ;?>">
                    <button id="decliner">
                        <ion-icon class="rotate-icon" name="close-circle-outline"></ion-icon>
                    </button>
                </form>
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
    <?php if(!empty($ap)):?>
    <h3 class='no-mar-pad text-color-black underline'>Approuvée et en attente de paiement</h3>
    <?php endif; ?>
    <?php foreach ($ap as $demande) : ?>
    <div class="box-view-demandes display-flex flex-column gap-24px">
    <?php 
        $demandeur = new Utilisateur;
        $demandeur = $demandeur->createUtilisateur($modele->getDemandeurById($demande['id_demandeur'])); 
    ?>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">ID</span>
                <?php echo $demande['num_dem'] ;?>
            </div>
        </div>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DATE ARRIVÉE</span>
                <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee']); ?></span>
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
        <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">PLUS</span>
                <ion-icon
                    data-target="<?php echo $demande['num_dem'] ;?>"
                    class="plus"
                    name="chevron-down-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">

            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">VOIR</span>
                <form action="v_accueil.php" method="post">
                    <input
                        type="hidden"
                        name="view-annonce"
                        value="<?php echo $appartementAnnonce->getNumappart() ?>">
                    <button id="accepter">
                        <ion-icon name="business-outline"></ion-icon>
                    </button>
                </form>
            </div>

            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">ANNULER</span>
                <form action="../controls/c_Demandes.php" method="post">
                    <input
                        type="hidden"
                        name="annuler-demande-an"
                        value="<?php echo $demande['num_dem'] ?>">
                    <button id="decliner">
                        <ion-icon class="rotate-icon" name="close-circle-outline"></ion-icon>
                    </button>
                </form>
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

    <?php if(!empty($an)):?>
    <h3 class='no-mar-pad text-color-black underline'>Annulée</h3>
    <?php endif; ?>
    <?php foreach ($an as $demande) : ?>
    <div class="box-view-demandes display-flex flex-column gap-24px">
    <?php 
        $demandeur = new Utilisateur;
        $demandeur = $demandeur->createUtilisateur($modele->getDemandeurById($demande['id_demandeur'])); 
    ?>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">ID</span>
                <?php echo $demande['num_dem'] ;?>
            </div>
        </div>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DATE ARRIVÉE</span>
                <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee']); ?></span>
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
        <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">PLUS</span>
                <ion-icon
                    data-target="<?php echo $demande['num_dem'] ;?>"
                    class="plus"
                    name="chevron-down-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">

        <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">VOIR</span>
                    <form action="v_accueil.php" method="post">
                        <input
                            type="hidden"
                            name="view-annonce"
                            value="<?php echo $appartementAnnonce->getNumappart() ?>">
                        <button id="accepter">
                            <ion-icon name="business-outline"></ion-icon>
                        </button>
                    </form>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">SUPPRIMER</span>
                    <form action="../controls/c_Demandes.php" method="post">
                        <input
                            type="hidden"
                            name="supprimer-demande"
                            value="<?php echo $demande['num_dem'] ?>">
                        <input
                            type="hidden"
                            name="location"
                            value="demande">
                        <button type="submit" id="decliner">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
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

    <?php if(!empty($ex)):?>
    <h3 class='no-mar-pad text-color-black underline'>Expirée</h3>
    <?php endif; ?>
    <?php foreach ($ex as $demande) : ?>
    <div class="box-view-demandes display-flex flex-column gap-24px">
    <?php 
        $demandeur = new Utilisateur;
        $demandeur = $demandeur->createUtilisateur($modele->getDemandeurById($demande['id_demandeur'])); 
    ?>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">ID</span>
                <?php echo $demande['num_dem'] ;?>
            </div>
        </div>
        <div class="display-flex gap-10px align-horizontaly">
            <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">DATE ARRIVÉE</span>
                <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee']); ?></span>
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
        <div class="display-flex flex-column gap-10px align-verticaly">
                <span class="small second-color">PLUS</span>
                <ion-icon
                    data-target="<?php echo $demande['num_dem'] ;?>"
                    class="plus"
                    name="chevron-down-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="display-flex gap-10px align-horizontaly">

        <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">VOIR</span>
                    <form action="v_accueil.php" method="post">
                        <input
                            type="hidden"
                            name="view-annonce"
                            value="<?php echo $appartementAnnonce->getNumappart() ?>">
                        <button id="accepter">
                            <ion-icon name="business-outline"></ion-icon>
                        </button>
                    </form>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">SUPPRIMER</span>
                    <form action="../controls/c_Demandes.php" method="post">
                        <input
                            type="hidden"
                            name="supprimer-demande"
                            value="<?php echo $demande['num_dem'] ?>">
                            <input
                            type="hidden"
                            name="location"
                            value="demande">
                        <button type="submit" id="decliner">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
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