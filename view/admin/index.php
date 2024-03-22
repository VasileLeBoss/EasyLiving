<?php
include('header-admin.php');
?>

<body class="admin">
    <div class="admin-conteiner">
        <?php include('controls/c_Admin.php');?>
        <h1 style="margin-top:0;">Tableau de bord</h1>

        <div class="admin-dashboard">
            <div class="box relative">
                <h3 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="people-circle-outline"></ion-icon>Utilisateurs </span> </h3>
                <h1 class="no-mar-pad font-size-72px"><?php echo count($AllUtilisateurs); ?></h1>
                <ion-icon class="trending-up" name="trending-up-outline"></ion-icon>
            </div>
            <div class="box relative">
                <h3 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="cash-outline"></ion-icon>Revenue</span> </h3>
                <ion-icon class="trending-up" name="trending-up-outline"></ion-icon>
                <h1 class=""><?php echo $revenuPotentiel. " €" ; ?></h1>
                
            </div>
            <div class="box relative">
            <h3 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="albums-outline"></ion-icon>Annonces</span> </h3>

                <ion-icon class="trending-up" name="trending-up-outline"></ion-icon>

                <h1 class="no-mar-pad font-size-72px"><?php echo count($AllAppartements); ?></h1>
            </div>
            <div class="box relative">
            <h3 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="calendar-outline"></ion-icon>Demandes</span> </h3>
                <ion-icon class="trending-up" name="trending-up-outline"></ion-icon>
                <h1 class="no-mar-pad font-size-72px"><?php echo count($AllDemandes); ?></h1>
            </div>

            <div class="box display-flex flex-column">
                <div class="box-user second-color display-flex space-between">
                    <div>#</div>
                    <div>NOM</div>
                    <div>PRENOM</div>
                    <div>E-MAIL</div>
                    <div>ADRESSE</div>
                    <div>CODE POSTAL</div>
                    <div>TÉLÉPHONE</div>
                </div>
                <?php for ($i = 0; $i < 8 && $i < count($AllUtilisateurs); $i++): ?>
                <?php $utilisateur = $AllUtilisateurs[$i]; ?>
                <div class="box-user display-flex ">
                    <div><?php echo $utilisateur->getId(); ?></div>
                    <div><?php echo $utilisateur->getNom(); ?></div>
                    <div><?php echo $utilisateur->getPrenom(); ?></div>
                    <div><?php echo $utilisateur->getEmail(); ?></div>
                    <div><?php echo $utilisateur->getAdresse(); ?></div>
                    <div><?php echo $utilisateur->getCodeVille(); ?></div>
                    <div><?php echo $utilisateur->getTel(); ?></div>
                </div>
                <?php endfor; ?>
                <?php if(count($AllUtilisateurs)>8): ?>
                <div class="display-flex end">
                    <button class="fit-content">Afficher détails</button>
                </div>
                <?php endif;?>
            </div>
            <div class="box display-flex flex-column">
                <div class="box-demandes second-color display-flex space-between">
                    <div>#</div>
                    <div>ARRIVÉE</div>
                    <div>DEPART</div>
                    <!-- <div>STATUS</div> -->
                </div>
                <?php for ($i = 0; $i < 8 && $i < count($AllDemandes); $i++): ?>
                <?php $Demande = $AllDemandes[$i]; ?>
                <div class="box-demandes display-flex ">
                    <div><?php echo $Demande['num_dem'] ; ?></div>
                    <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateArrivee']);?></div>
                    <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateDepart']);?></div>

                </div>
                <?php endfor; ?>
                <?php if(count($AllDemandes)>8): ?>
                <div class="display-flex end">
                    <button class="fit-content">Afficher détails</button>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</body>