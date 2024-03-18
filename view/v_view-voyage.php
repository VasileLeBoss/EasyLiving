<?php include('header.php') ;?>
<?php include('../controls/connected.php') ;?>
<?php require('../controls/c_Demandes.php');?>
<div class="min-conteiner">
    <div
        class="full-width-white-padding-header align-verticaly space-between flex-wrap  gap-10px">
        <a href="v_view-voyage.php">
            <h1>Mes Voyages</h1>
        </a>
    </div>
    <div class="grid-view-demandes">

        <?php if (!empty($mesDemandes)) : ?>
        <h2 class='no-mar-pad second-color'>Mes demandes</h2>
        <?php if(!empty($ecl)):?>
        <h3 class='no-mar-pad text-color-black underline'>Mes réservations</h3>
        <?php endif; ?>
        <?php foreach ($ecl as $demande) : ?>
        <div class="box-view-demandes display-flex flex-column gap-24px">
            <?php 
                    $proprieter = new Utilisateur;
                    $proprieter = $proprieter->createUtilisateur($modele->getproprieterById($demande['id_proprieter'])); 
                    $resultat = $modele->getAnnoncebyID($demande['numappart']);
                    $appartementAnnonce = new Appartement ;
                    $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
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
                    <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">DATE DEPART</span>
                    <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
                </div>
            </div>

            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PROPRIETER</span>
                    <?php echo $proprieter->getNomComplet() ;?>
                </div>
            </div>
            <div class="display-flex gap-10px align-horizontaly">
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
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PLUS</span>
                    <ion-icon
                        data-target="<?php echo $demande['num_dem'] ;?>"
                        class="plus"
                        name="chevron-down-circle-outline"></ion-icon>
                </div>
                </div>

            </div>

        </div>
        <div class="hidden voir-plus-demande" id="<?php echo $demande['num_dem'] ;?>">
            <h3 class="no-mar-pad">Informations additionnelles</h3>
            <div class="display-grid grid-template-columns-2 gap-10px">
                <div class="display-flex flex-column gap-10px">
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">ADDRESS</span>

                        <span class="capitalize"><?php echo $appartementAnnonce->getRue(); ?>, Paris
                            <?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?></span>

                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">EMAIL</span>
                        <?php echo $proprieter->getEmail() ;?>
                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">NUMÉRO TÉLÉPHONE</span>
                        <?php echo $proprieter->getTel() ;?>
                    </div>

                </div>
                <div class="display-flex flex-column gap-10px end">

                    <div class="display-flex flex-column gap-5px flex-end">
                        <span class="small second-color">NUITS</span>
                        <span><?php echo $appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']) ?></span>
                    </div>

                    <div class="display-flex space-between flex-wrap gap-10px end">

                        <div class="display-flex flex-column gap-5px flex-end">
                            <span class="small second-color">A PAYER</span>
                            <span ><?php echo $appartementAnnonce->calculerGagneReel($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()),$appartementAnnonce->calculerLesTaxes($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()))) ?>
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
                    $proprieter = new Utilisateur;
                    $proprieter = $proprieter->createUtilisateur($modele->getproprieterById($demande['id_proprieter'])); 
                    $resultat = $modele->getAnnoncebyID($demande['numappart']);
                    $appartementAnnonce = new Appartement ;
                    $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
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
                    <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">DATE DEPART</span>
                    <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
                </div>
            </div>

            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PROPRIETER</span>
                    <?php echo $proprieter->getNomComplet() ;?>
                </div>
            </div>
            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">Payer</span>
                    <ion-icon
                        data-target="<?php echo $demande['num_dem'] ;?>"
                        class="plus"
                        name="journal-outline"></ion-icon>

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
                        <span class="small second-color">ADDRESS</span>

                        <span class="capitalize"><?php echo $appartementAnnonce->getRue(); ?>, Paris
                            <?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?></span>

                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">EMAIL</span>
                        <?php echo $proprieter->getEmail() ;?>
                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">NUMÉRO TÉLÉPHONE</span>
                        <?php echo $proprieter->getTel() ;?>
                    </div>

                </div>
                <div class="display-flex flex-column gap-10px end">

                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">NUITS</span>
                        <span><?php echo $appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']) ?></span>
                    </div>

                    <div class="display-flex space-between flex-wrap gap-10px ">

                        <div class="display-flex flex-column gap-5px ">
                            <span class="small second-color">A PAYER</span>
                            <span ><?php echo $appartementAnnonce->calculerGagneReel($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()),$appartementAnnonce->calculerLesTaxes($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()))) ?>
                                €</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="no-mar-pad display-flex ">Relevé d'identité bancaire</h3>
                <div class="display-grid  gap-10px">
                    <div class="display-flex flex-column gap-10px">
                        <div class="display-flex flex-column gap-5px">
                            <span class="small second-color">TITULAIRE DU COMPTE</span>

                            <span class="capitalize grey small"><?php echo $_SESSION['utilisateur']->getNomComplet() ;?></span>
                            <span class="capitalize grey small"><?php echo $_SESSION['utilisateur']->getCodeVille() ;?></span>
                        </div>
                        <form action="../controls/c_Demandes.php" method="post">
                            <div class="box-compte-informations">

                                <div class="box-compte-information" id="box-input-label-single">

                                    <div class="box-input-label">
                                        <label for="email">Numéro de compte</label>
                                        <input type="number" id="num_compte" name="num_compte" required="required">
                                        <span id="num_compteError" class="error-message-modif"></span>
                                    </div>
                                </div>
                                <div class="box-compte-information">
                                    <div class="box-input-label">
                                        <label for="prenom">Banque</label>
                                        <input
                                            class="capitalize"
                                            name="banque"
                                            id="banque"
                                            type="text"
                                            required="required">
                                        <span id="banqueError" class="error-message-modif"></span>
                                    </div>
                                    <div class="box-input-label">
                                        <label for="email">Téléphone (banque)</label>
                                        <input type="number" id="tel_banque" name="tel_banque" required="required">
                                        <span id="tel_banqueError" class="error-message-modif"></span>
                                    </div>
                                </div>
                                <div class="box-compte-information">
                                    <div class="box-input-label">
                                        <label for="email">Adresse (banque)</label>
                                        <input
                                            type="text"
                                            id="adresse_banque"
                                            name="adresse_banque"
                                            required="required">
                                        <span id="adresse_banqueError" class="error-message-modif"></span>
                                    </div>
                                    <div class="box-input-label">
                                        <label for="nom">Code postal (banque)</label>
                                        <input
                                            class="capitalize"
                                            type="number"
                                            name="Code_postal"
                                            id="Code_postal"
                                            required="required">
                                        <span id="Code_postalError" class="error-message-modif"></span>
                                    </div>
                                </div>
                                <div class="display-flex align-verticaly">
                                    <input type="checkbox" name="" id="checkboxrRemboursement" required="required">
                                    <label for="checkboxrRemboursement" class="small grey">J'ai lu et accepté la politique de remboursement</label>
                                </div>
                                <div class="display-flex align-verticaly">
                                    <input type="checkbox" name="" id="checkboxConditions" required="required">
                                    <label for="checkboxConditions" class="small grey">J'ai lu et accepté les conditions générales</label>
                                </div>

                                <div class="box-compte-information">
                                    <input type="hidden" name="num_dem" value="<?php echo $demande['num_dem'];?>">
                                    <input
                                        type="hidden"
                                        name="reserver-logement-rib"
                                        value="<?php echo $demande['numappart']; ?>">
                                    <input type="hidden" name="dateDepart" value="<?php echo $demande['dateDepart'] ;?>">
                                    <button class="width-100" id="submitBtn" disabled="disabled">Réserver le logement</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    <?php endforeach; ?>
        <?php if(!empty($ea)):?>
        <h3 class='no-mar-pad text-color-black underline'>En Attente</h3>
        <?php endif; ?>
    <?php foreach ($ea as $demande) : ?>
        <div class="box-view-demandes display-flex flex-column gap-24px">
            <?php 
                    $proprieter = new Utilisateur;
                    $proprieter = $proprieter->createUtilisateur($modele->getproprieterById($demande['id_proprieter'])); 
                    $resultat = $modele->getAnnoncebyID($demande['numappart']);
                    $appartementAnnonce = new Appartement ;
                    $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
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
                    <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">DATE DEPART</span>
                    <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
                </div>
            </div>

            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PROPRIETER</span>
                    <?php echo $proprieter->getNomComplet() ;?>
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
                        <span class="small second-color">ADDRESS</span>

                        <span class="capitalize"><?php echo $appartementAnnonce->getRue(); ?>, Paris
                            <?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?></span>

                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">EMAIL</span>
                        <?php echo $proprieter->getEmail() ;?>
                    </div>
                    <div class="display-flex flex-column gap-5px">
                        <span class="small second-color">NUMÉRO TÉLÉPHONE</span>
                        <?php echo $proprieter->getTel() ;?>
                    </div>

                </div>
                <div class="display-flex flex-column gap-10px end">

                    <div class="display-flex flex-column gap-5px flex-end">
                        <span class="small second-color">NUITS</span>
                        <span><?php echo $appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']) ?></span>
                    </div>

                    <div class="display-flex space-between flex-wrap gap-10px end">

                        <div class="display-flex flex-column gap-5px flex-end">
                            <span class="small second-color">A PAYER</span>
                            <span ><?php echo $appartementAnnonce->calculerGagneReel($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()),$appartementAnnonce->calculerLesTaxes($appartementAnnonce->calculerGagnePotentielle($appartementAnnonce->calculerNombreNuits($demande['dateArrivee'],$demande['dateDepart']),$appartementAnnonce->getPrixTotal()))) ?>
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
            $proprieter = new Utilisateur;
            $proprieter = $proprieter->createUtilisateur($modele->getproprieterById($demande['id_proprieter'])); 
            $resultat = $modele->getAnnoncebyID($demande['numappart']);
            $appartementAnnonce = new Appartement ;
            $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
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
                    <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">DATE DEPART</span>
                    <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
                </div>
            </div>

            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PROPRIETER</span>
                    <?php echo $proprieter->getNomComplet() ;?>
                </div>
            </div>
            <div class="display-flex gap-10px align-horizontaly"></div>

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
                            value="voyage">
                        <button type="submit" id="decliner">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
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
                $proprieter = new Utilisateur;
                $proprieter = $proprieter->createUtilisateur($modele->getproprieterById($demande['id_proprieter'])); 
                $resultat = $modele->getAnnoncebyID($demande['numappart']);
                $appartementAnnonce = new Appartement ;
                $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
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
                    <span id="dateArrivee"><?php echo $appartementAnnonce->FormatDate($demande['dateArrivee'])   ;?></span>
                </div>

                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">DATE DEPART</span>
                    <span id="dateDepart"><?php echo $appartementAnnonce->FormatDate($demande['dateDepart'])  ;?></span>
                </div>
            </div>

            <div class="display-flex gap-10px align-horizontaly">
                <div class="display-flex flex-column gap-10px align-verticaly">
                    <span class="small second-color">PROPRIETER</span>
                    <?php echo $proprieter->getNomComplet() ;?>
                </div>
            </div>
            <div class="display-flex gap-10px align-horizontaly"></div>

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
                            value="voyage">
                        <button type="submit" id="decliner">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
                </div>

            </div>

        </div>

        <?php endforeach; ?>
    <?php else: ?>
        <h3 class='text-color-black'>Vous n'avez pas encore des demandes</h3>
        <?php endif; ?>
    </div>
</div>
<?php include('footer.php') ?>
<script src="../scripts/ribCheck.js"></script>
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