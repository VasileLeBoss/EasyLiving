<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="fit-content relative aligne-icon" style="margin-top:0;">
    <a href="?view=utilisateurs" class="aligne-icon return-demande">
        <ion-icon name="chevron-back-outline"></ion-icon>
    </a>
    <span class="aligne-icon gap-10px capitalize">
        <ion-icon name="people-circle-outline"></ion-icon><?php echo $user->getNomComplet() ;?>
    </span>
</h1>

<div class="admin-utilisateur-details relative">
    <div class="box">

        <form action="" method="post">
            <div class="admin-utilisateur-details-info-perso">
                <div class="input relative">
                    <label for="prenom">Nom</label>
                    <input
                        class="capitalize"
                        type="text"
                        name="nom"
                        id="nom"
                        value="<?php echo $user->getNom();?>"
                        required="required">
                    <span id="nomError" class="error-message-modif"></span>
                </div>
                <div class="input relative">
                    <label for="prenom">Prenom</label>
                    <input
                        class="capitalize"
                        name="prenom"
                        id="prenom"
                        type="text"
                        value="<?php echo $user->getPrenom();?>"
                        required="required">
                    <span id="prenomError" class="error-message-modif"></span>
                </div>

                <div class="input relative">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        value="<?php echo $user->getEmail(); ?>"
                        required="required">
                    <span id="emailError" class="error-message-modif"></span>
                </div>
                <div class="input relative">
                    <label for="adresse">Adresse</label>
                    <input
                        type="text"
                        class="capitalize"
                        id="adresse"
                        name="adresse"
                        value="<?php echo $user->getAdresse(); ?>"
                        required="required">
                    <span id="adresseError" class="error-message-modif"></span>
                </div>
                <div class="input relative">
                    <label for="codepostale">Code Postale</label>
                    <input
                        type="number"
                        name="codepostale"
                        id="codepostale"
                        value="<?php echo $user->getCodeVille(); ?>"
                        required="required">
                    <span id="codeError" class="error-message-modif"></span>
                </div>
                <div class="input relative">
                    <label for="tel">Téléphone</label>
                    <input
                        type="number"
                        id="tel"
                        name="tel"
                        value="<?php echo $user->getTel(); ?>"
                        required="required">
                    <span id="telError" class="error-message-modif"></span>
                </div>
                <span id="input-vide_error" class="error-message-modif"></span>
                <input type="hidden" name="modif" value="info-perso">
                <input
                    type="hidden"
                    name="id_utilisateur"
                    value="<?php echo $user->getId(); ?>">
                <button type="submit" id="submitBtn" disabled="disabled">Enregistrer</button>
            </div>

        </form>

    </div>
    <div class="box-2 absolute">
        <div >
            <h3 class="no-mar-pad">
                <span class="aligne-icon gap-10px">
                    <ion-icon name="albums-outline"></ion-icon>Annonces</span>
            </h3>
            <div class="align-horizontaly">
                <h1 class="no-mar-pad font-size-72px">
                    <?php 
                    $nombreDemandes = $user->getNombreAppartementUtilisateurAdmin(); 
                    echo $nombreDemandes !== false ? $nombreDemandes : 0; 
                    ?>
                </h1>

            </div>
        </div>
        <div>
            <h3 class="no-mar-pad">
                <span class="aligne-icon gap-10px">
                    <ion-icon name="calendar-outline"></ion-icon>Demandes</span>
            </h3>
            <div class="align-horizontaly">
                <h1 class="no-mar-pad font-size-72px">
                    <?php 
                    $nombreDemandes = $user->getNombreDemandesUtilisateurAdmin(); 
                    echo $nombreDemandes !== false ? $nombreDemandes : 0; 
                    ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="box">
        <h2 class="no-mar-pad" style="margin-bottom:16PX;">
            <span class="aligne-icon gap-10px">
                <ion-icon name="calendar-outline"></ion-icon>Demandes</span>
        </h2>
        <?php $AllDemandes = $user->getAllDemandesUtilisateurAdmin();?>

        <?php if (empty($AllDemandes)) :  echo "<h3>L'utilisateur n'as pas des demandes </h3>" ?>
    <?php else: ?>

        <div class="display-flex flex-column">
            <div class="box-demandes-user second-color display-flex space-between">
                <div>#</div>
                <div>ARRIVÉE</div>
                <div>DEPART</div>
                <div>STATUS</div>
                <div># PROPRIETER</div>
                <div># APPARTEMENT</div>
            </div>
            <?php foreach ($AllDemandes as $Demande ): ?>
            <div class="box-demandes-user display-flex ">
                <div><?php echo $Demande['num_dem'] ; ?></div>
                <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateArrivee']);?></div>
                <div><?php echo $_SESSION['utilisateur']->formaterDateDemande($Demande['dateDepart']);?></div>
                <div class="capitalize"><?php echo $Demande['status'] ; ?></div>
                <div class="capitalize"><?php echo $Demande['id_proprieter'] ; ?></div>
                <div class="capitalize"><?php echo $Demande['numappart'] ; ?></div>

            </div>
            <?php endforeach;?>
        </div>
        <?php endif; ?>
    </div>
    <?php $AllAnnonces = $user->GetAllAppartementsbyIdUtilisateurAdmin();?>

    <div class="box display-flex flex-column ">

        <h2 class="no-mar-pad">
            <span class="aligne-icon gap-10px">
                <ion-icon name="albums-outline"></ion-icon>Annonces</span>
        </h2>
        <?php if (empty($AllAnnonces)) :  echo "<h3>L'utilisateur n'as pas des annonces </h3>"?>
    <?php else: ?>
    </div>

    <div class="conteiner-grid-accueil-annonces">
    <?php foreach ($AllAnnonces as $appartement) : ?>
        <div class="relative ">
            <a href="#" onclick="submitForm(<?php echo $appartement->getNumappart() ?>)">
                <div class="box-grid-accueil-annonce no-hover-shadows">
                    <div class="img-annonce align-horizontaly">
                        <img src="../../src/<?php echo $appartement->getTypappart() . '.png'; ?>" alt="">
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

                <?php if ($appartement->getNombreLocataireAppartementByIdAdmin() > 0 ): ?>
                <span
                    onclick="submitFormLocataire(<?php echo $appartement->getNumappart() ?>)"
                    class="button-demande align-horizontaly align-verticaly relative">
                    <ion-icon name="people-outline"></ion-icon>
                    <span class="notification-absolute"><?php echo $appartement->getNombreLocataireAppartementByIdAdmin();?></span>

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

                <?php if ($appartement->getNombreDemandesAppartementByIdAdmin() > 0 ): ?>
                <span
                    onclick="submitFormDemande(<?php echo $appartement->getNumappart() ?>)"
                    class="button-demande align-horizontaly align-verticaly relative">
                    <ion-icon name="folder-outline"></ion-icon>
                    <span class="notification-absolute"><?php echo $appartement->getNombreDemandesAppartementByIdAdmin();?></span>
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
    </div>
    <?php endif; ?>
</div>
<div class="box">
    <div class="display-flex  align-verticaly space-between">
        <h2 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="cash-outline"></ion-icon></ion-icon>Revenu</span></h2>
            <h2>
            <?php echo $user->calculeAdminRevenuUtilisateur() > 0 ? $user->calculeAdminRevenuUtilisateur()*0.93." €" : ""; ?>
            </h2>
    </div>

<?php if (!$user->calculeAdminRevenuUtilisateur()) :  echo "<h3>L'utilisateur n'as pas de revenu </h3>"?>
<?php else: ?>

    <div id="bar-chart-container">
        <canvas id="bar-chart"></canvas>
    </div>

</div>

</div>

<script>
    // Données du graphique
    const revenusProprietaires = <?php echo json_encode($donneesProrieter); ?>;

    const data = {
        // labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        datasets: [{
        label: "Revenus propriétaires" ,
        data: revenusProprietaires, 
        backgroundColor: '#1F7A8C',
        },
      ],
    };

    // Configuration du graphique
    const config = {
      type: 'bar',
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true // Démarre l'axe y à zéro
          }
        }
      }
    };

    // Création du graphique
    const ctx = document.getElementById('bar-chart').getContext('2d');
    new Chart(ctx, config);
  </script>

<?php endif; ?>

<script src="../../scripts/modifCheck.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
var errorMessage = "<?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>";
var InputerrorMessage = "<?php echo isset($_SESSION['input-vide_error']) ?  $_SESSION['input-vide_error" +"'] : ''; ?>";

<?php unset($_SESSION['email_error']); ?>
var emailError = document.getElementById('emailError');
emailError.textContent = errorMessage;

<?php unset($_SESSION['input-vide_error']); ?>
var inputVideError = document.getElementById('input-vide_error');
inputVideError.textContent = InputerrorMessage;
});
</script>
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    
    //     var revenuLiElements = document.querySelectorAll('.revenu-li');
    //     revenuLiElements.forEach(function (liElement) {
    //         var revenu = parseFloat(liElement.getAttribute('data-revenu'));
    //         var hauteur = revenu * 0.07;
    //         liElement.style.height = hauteur + 'px';
    //     });
        
    // });
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