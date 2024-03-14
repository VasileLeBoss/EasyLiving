<?php
include('header.php');
include('../controls/connected.php');
?>
<div class="min-conteiner ">
<div class="full-width-white-padding-header">
<a href="v_compte.php"><h1>Mon Compte</h1></a>
<div class="font-size-20px">
<span class="capitalize"><strong><?php echo $_SESSION['utilisateur']->getNomComplet(); ?></strong></span>
</div>
</div>
<div class="grid-compte-info-perso">
    <div class="box-compte-info-perso">
        <div class="box-compte-informations">
            <div class="box-compte-information align-verticaly space-between">
                <span class="font-size-24px ">Voulez-vous désactiver le compte ?</span>
                <div>
                <span class="align-verticaly">
                    <a href="v_compte-info-perso.php" class="underline">Retour</a>
                </span> 
                </div>        
             </div>

        </div>
        <div class="box-compte-informations align-verticaly">
            <div class="box-compte-information">
                <span><ion-icon name="alert-circle-outline"></ion-icon></span>
                <span>
                Le profil et les annonces associées à ce compte ne seront plus visibles.
                </span>
            </div>
        </div>
        <div class="box-compte-informations">
            <div class="box-compte-information " >
                <span><ion-icon name="alert-circle-outline"></ion-icon></span>
                <span >
                Vous ne pourrez plus accéder aux informations du compte ni aux réservations passées.
                </span>
            </div>
        </div>
        <div class="box-compte-informations red">
            <div class="box-compte-information align-verticaly ali" >
                <button type="submit" id="delete" >Désactiver le compte</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include('footer.php');
?>