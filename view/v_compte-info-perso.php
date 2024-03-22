<?php
include('header.php');
include('../controls/connected.php');
?>
<div class="min-conteiner ">
<div class="full-width-white-padding-header">
<h1><a href="v_compte.php">Mon Compte</a></h1>
<div class="font-size-20px">
<span class="capitalize"><strong><?php echo $_SESSION['utilisateur']->getNomComplet(); ?></strong></span>
</div>
</div>
<div class="grid-compte-info-perso">
    <div class="box-compte-info-perso">
        <div class="box-compte-informations">
            <div class="box-compte-information align-verticaly space-between">
                <span class="font-size-24px">Information Personnele</span>
                <div>
                <span class="align-verticaly gap-10px">
                    <a href="v_compte.php" class="underline">Retour</a>
                    <a href="v_compte-modif.php" class="underline">Modifier</a>
                </span> 
                </div>        
             </div>

        </div>

        <div class="box-compte-informations">
            <div class="box-compte-information">
                <span>
                    <strong>Nom Légal</strong>
                </span>
            </div>
            <div class="box-compte-information">
                <span class="capitalize"><?php echo $_SESSION['utilisateur']->getNomComplet(); ?></span>

            </div>
        </div>
        <div class="box-compte-informations">
            <div class="box-compte-information">
                <span>
                    <strong>Adresse Email</strong>
                </span>
            </div>
            <div class="box-compte-information">
                <span ><?php echo $_SESSION['utilisateur']->getEmail(); ?></span>

            </div>
        </div>

        <div class="box-compte-informations">
            <div class="box-compte-information">
                <span>
                    <strong>Adresse</strong>
                </span>
            </div>
            <div class="box-compte-information">
                <span class="capitalize"><?php echo $_SESSION['utilisateur']->getAdresse(); ?></span>
            </div>
        </div>
        <div class="box-compte-informations">
            <div class="box-compte-information">
                <span>
                    <strong>Code Postale</strong>
                </span>
            </div>
            <div class="box-compte-information">
                <span><?php echo $_SESSION['utilisateur']->getCodeVille(); ?></span>
            </div>
        </div>
        <div class="box-compte-informations">
            <div class="box-compte-information">
                <span>
                    <strong>Numéro Téléphone</strong>
                </span>
            </div>
            <div class="box-compte-information">
                <span><?php echo $_SESSION['utilisateur']->getTel(); ?></span>
            </div>
        </div>

        <div class="width-100">
        <div class=" align-horizontaly align-verticaly ">
        <span class="font-size-12px">Besoin de désactiver votre compte ?</span>
        </div>
        <div class="align-horizontaly align-verticaly ">
            <span><a href="v_compte-suppresion.php" class="underline grey font-size-12px">M'en occuper maintenant</a></span>
        </div>
        </div>

        
    </div>
</div>
</div>

<?php
include('footer.php');
?>