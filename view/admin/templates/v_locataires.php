<h1 class="fit-content " style="margin-top:0;">
    <a href="?view=utilisateurs" class="text-color-black">
        <span class="aligne-icon gap-10px">
            <ion-icon name="people-circle-outline"></ion-icon>Locataires</a>
    </span>
</h1>
<div class="box display-flex flex-column ">
    
    <div class="box-locataire second-color display-flex space-between">
        <div>#</div>
        <div>NOM</div>
        <div>PRENOM</div>
        <div>TÉLÉPHONE L</div>
        <div>BANQUE</div>
        <div>ADRESSE B</div>
        <div>CODE POSTAL B</div>
        <div>TÉLÉPHONE B</div>
        <div><ion-icon name="albums-outline"></ion-icon></div>
    </div>
    <?php if(empty($AllLocataire)): echo "<h3>Aucun locataire disponible </h3>";?>

    <?php else: ?>  
        <?php foreach($AllLocataire as $locataire):?>
    <div class="box-locataire display-flex space-between">
        <div><?php echo $locataire['numeroloc'] ;?></div>
        <div><?php echo $locataire['nom_loc'] ;?></div>
        <div><?php echo $locataire['prenom_loc'] ;?></div>
        <div><?php echo $locataire['tel_loc'] ;?></div>
        <div><?php echo $locataire['banque'] ;?></div>
        <div><?php echo $locataire['adress_banque'] ;?></div>
        <div><?php echo $locataire['code_ville_banque'] ;?></div>
        <div><?php echo $locataire['tel_banque'] ;?></div>
        <div><?php echo $locataire['numappart'] ;?></div>
    </div>

        <?php endforeach;?>
    <?php endif;?>
</div>

