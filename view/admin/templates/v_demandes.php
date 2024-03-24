<h1 class="fit-content " style="margin-top:0;">
    <a href="?view=demandes" class="text-color-black">
        <span class="aligne-icon gap-10px">
        <ion-icon name="folder-open-outline"></ion-icon>Demandes</a>
    </span>
</h1>
<div class="box display-flex flex-column ">

<?php if (empty($AllDemandes)) :  echo "<h3>L'utilisateur n'as pas des demandes </h3>" ?>
<?php else: ?>

<div class="display-flex flex-column">
    <div class="box-demandes-all second-color display-flex space-between">
        <div>#</div>
        <div>ARRIVÉE</div>
        <div>DEPART</div>
        <div>STATUS</div>
        <div># DEMANDEUR</div>
        <div># PROPRIETER</div>
        <div># APPARTEMENT</div>
    </div>
    <?php foreach ($AllDemandes as $Demande ): ?>
    <div class="box-demandes-all display-flex ">
        <div><?php echo $Demande['num_dem'] ; ?></div>
        <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateArrivee']);?></div>
        <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateDepart']);?></div>
        <div class="capitalize"><?php echo $Demande['status'] ; ?></div>
        <div class="capitalize"><?php echo $Demande['id_demandeur'] ; ?></div>
        <div class="capitalize"><?php echo $Demande['id_proprieter'] ; ?></div>
        <div class="capitalize"><?php echo $Demande['numappart'] ; ?></div>

    </div>
    <?php endforeach;?>
</div>
<?php endif; ?>

</div>