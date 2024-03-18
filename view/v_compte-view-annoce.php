<?php
include('../controls/connected.php');
?>
    
<div class="grid-compte-info-perso">
    <div class="align-horizontaly">
    <div class="box-compte-info-perso fit-content">
        <div class="box-compte-informations">
            <div class="box-compte-information align-verticaly space-between">
                <span class="font-size-24px">Information Annonce N°<?php echo $appartementAnnonce->getNumappart() ?></span>
                <div>
                <span class="align-verticaly gap-10px">
                    <a href="v_compte-annonce.php" class="underline">Retour</a>
                    <?php if (!$appartementAnnonce->getNombreDemandesAppartementById() > 0 ): ?>
                    <form action="../controls/c_AppartementsUtilisateur.php" method="post">
                        
                        <input type="hidden" name="delete-annonce" value="<?php echo $appartementAnnonce->getNumappart() ?>">
                        <input type="submit" class="underline supprimer" value="Supprimer">
                    </form>
                    <?php endif; ?>
                </span> 
                </div>        
             </div>

</div>
<div class="align-verticaly align-horizontaly width-100 ">
<form action="../controls/c_AppartementsUtilisateur.php" method="post">
    <div class="box-compte-informations">
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label" >
                <label >Type Appartement</label>
                <input type="text" class="capitalize" value="<?php echo $appartementAnnonce->getTypAppart() ?> "name="typappart" disabled>
                </div>
            </div>
            <div class="box-compte-information" >

                <div class="box-input-label" >
                <label >Rue appartement</label>
                <input type="text" class="capitalize" value="<?php echo $appartementAnnonce->getRue() ?>"name="rue" disabled>
                </div>
                
                <div class="box-input-label" >
                <label >Arrondissement</label>
                <input type="text" class="capitalize"  value="<?php echo $appartementAnnonce->getArrondissement() > 1 ? $appartementAnnonce->getArrondissement() . 'ème' : $appartementAnnonce->getArrondissement() . 'er'; ?>" disabled>
                </div>
            </div>
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label" >
                <label >Etage</label>
                <input type="text" class="capitalize"  value="<?php $etage = $appartementAnnonce->getEtage();if ($etage == '0') {echo 'Rez-de-chaussée';} else {echo $etage . ($etage == '1' ? 'er' : 'ème');}?>" disabled>
                </div>
            </div>
            <div class="box-compte-information" id="box-input-label-single">

            <div class="box-input-label" >
            <label >Date Libre</label>
            <input type="date" name="date_libre" class="capitalize" min="<?php echo $appartementAnnonce->getDateLibreAjour(); ?>" value="<?php echo $appartementAnnonce->getDateLibre(); ?>" required>
            </div>

            </div>
            <div class="box-compte-information">
                <div class="box-input-label">
                    <label for="prix_loc">Prix hors charges</label>
                    <input class="capitalize" type="text" min="0" name="prix_loc" id="prix_loc" value="<?php echo $appartementAnnonce->getPrixLoc(); ?>"required >
                    <span id="prix_locError" class="error-message-modif"></span>
                </div>
                <div class="box-input-label">
                <label for="prix_charg">Prix Charge</label>
                <input class="capitalize" type="text" name="prix_charg" id="prix_charg" value="<?php echo $appartementAnnonce->getPrixCharg(); ?>" required>
                <span id="prix_chargError" class="error-message-modif"></span>
            </div>
            </div>
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label" >
                <label >Ascenseur</label>
                <input type="text" class="capitalize" value="<?php echo $appartementAnnonce->getAscenseur() == '1' ? 'oui' : 'non'; ?>" disabled>
                </div>
            </div>
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label" >
                <label >Preavis</label>
                <input type="text" class="capitalize" value="<?php echo $appartementAnnonce->getPreavis() == '1' ? 'oui' : 'non'; ?>" disabled>
                </div>
            </div>
            
            <div class="box-compte-information align-verticaly align-horizontaly" >
                <input type="hidden" name="modif-annonce" >    
                <input type="hidden" name="numappart" value="<?php echo $appartementAnnonce->getNumappart() ?>">
                <button type="submit" id="submitbtn" disabled>Enregistrer</button>
            </div>
            </form>
    </div>
</div>
<script src="../scripts/annonce-formCheck-prix.js"></script> 
   
</div>
</div>
    </div>
</div>

<?php
include('footer.php');
?>