<?php


require_once ('../models/AppartementModel.php');
include("header.php");
?>
<div class="min-conteiner">
    <?php if (!isset($_SESSION['appartementAnnonce'])) : ?>

    <div class="align-horizontaly">
        <h2>L'appartement n'est plus disponilbe</h2>
    </div>
<?php else :?>
    <?php $appartementAnnonce = $_SESSION['appartementAnnonce'];?>
    <div class="grid-compte-info-perso">

        <div class="grid-view-annonce">

            <div class="box-view-annonce align-horizontaly align-verticaly">

                <div>
                    <div class="align-horizontaly">
                        <h1 class="capitalize " style="margin-bottom: 12px !important;"><?php echo $appartementAnnonce->getTypappart(); ?></h1>
                    </div>
                    <div class="align-horizontaly">
                        <img src="../src/<?php echo $appartementAnnonce->getTypappart() . '.png'; ?>">
                    </div>
                </div>

            </div>
            <div class="grid-view-annonce-option">
                <div class="gap-10px display-flex flex-column">
                    <div class="box-view-annonce ">

                        <div class="gap-10px display-flex flex-column">
                            <div>
                                <h4 class="second-color">Logement entier
                                </h4>
                                <span class="capitalize font-size-20px">
                                    <?php
                            echo $appartementAnnonce->getRue().", Paris " . (
                                $appartementAnnonce->getArrondissement() > 1
                                    ? $appartementAnnonce->getArrondissement() . 'ème arrondissement'
                                    : $appartementAnnonce->getArrondissement() . 'er arrondissement'
                            );
                            ?>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="box-view-annonce">
                        <h4 class="second-color">Disponibilités</h4>
                        <div class="display-flex space-between flex-wrap">
                            <div class="display-flex flex-column align-verticaly">
                                <img class="icon" src="../src/preavis.png" alt="">
                                <span>
                                    Préavis:
                                </span>
                                <span class="capitalize">
                                    <?php echo $appartementAnnonce->getPreavis() == '1' ? 'oui' : 'non';?>
                                </span>
                            </div>
                            <div class="display-flex flex-column align-verticaly">
                                <img class="icon" src="../src/multistorey.png" alt="">
                                <span>
                                    Etage:
                                </span>
                                <span>
                                <?php $etage = $appartementAnnonce->getEtage();if ($etage == '0') {echo 'Rez-de-chaussée';} else {echo $etage . ($etage == '1' ? 'er' : 'ème');}?>
                                </span>
                            </div>
                            <div class="display-flex flex-column align-verticaly">
                                <img class="icon" src="../src/ascenseur.png" alt="">
                                <span>
                                    Ascenseur:
                                </span>
                                <span class="capitalize">
                                    <?php echo $appartementAnnonce->getAscenseur() == '1' ? 'oui' : 'non'; ?>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="box-view-annonce">
                        <div class="display-flex gap-10px flex-column">
                            <h4 class="second-color">Requis pour votre voyage</h4>
                            <div>

                                <h4 >Numéro de téléphone</h4>
                                <div class="display-flex space-between align-items-end gap-24px">
                                    <p class="max-caracter">Ajoutez et confirmez votre numéro de téléphone afin
                                        qu'Airbnb puisse vous communiquer des informations sur vos voyages.</p>
                                    <a href="v_compte-modif.php#tel" class="button">Ajouter</a>
                                </div>
                            </div>
                            <div>

                                <h4 >Envoyez un message à l'hôte</h4>
                                <div class="display-flex space-between align-items-end gap-24px">
                                    <p class="max-caracter">Fournissez des détails sur votre voyage, les personnes
                                        qui vous accompagnent et ce que vous recherchez spécifiquement dans le logement.</p>
                                    <a href="v_compte-modif.php#tel" class="button">Ajouter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-view-annonce">
                        <div class="display-flex gap-10px flex-column">
                            <h4 class="second-color">A savoir</h4>
                            <div>
                                <h4 class="underline">Conditions d'annulation</h4>
                                <p>
                                    Annulation gratuite à tout moment.
                                </p>

                                <p class="max-caracter">
                                    Consultez les conditions d'annulation complètes de l'hôte, qui s'appliquent même
                                    en cas d'annulation pour des raisons de maladie ou de perturbations causées par
                                    le Covid-19.
                                </p>

                            </div>
                            <div>
                                <h4 class="underline">Sécurité et logement</h4>
                                <p class="max-caracter">Aucune indication de la présence d'un détecteur de monoxyde de carbone</p>
                                <p class="max-caracter">Aucune indication de la présence d'un détecteur de fumée</p>
                                <p class="max-caracter">Caméra de surveillance/système d'enregistrement
                                </p>
                            </div>
                            <div>
                                <h4 class="underline">Responsabilité en matière de Sécurité du Logement</h4>
                                <p class="max-caracter">EasyLiving décline toute responsabilité en ce qui
                                    concerne la sécurité des logements répertoriés sur notre plateforme.
                                </p>
                                <p class="max-caracter">Les propriétaires sont entièrement responsables de
                                    mettre en place des mesures de sécurité appropriées.</p>
                                <p class="max-caracter">EasyLiving ne garantit ni ne certifie la présence ou le
                                    bon fonctionnement des équipements de sécurité tels que les détecteurs de fumée
                                    ou de monoxyde de carbone.</p>
                                <p class="max-caracter">Les utilisateurs sont invités à contacter directement
                                    les propriétaires pour obtenir des informations détaillées sur la sécurité du
                                    logement.</p>
                            </div>
                        </div>

                    </div>
                    <div class="box-view-annonce">
                        <div class="display-flex gap-10px flex-column">
                            <h4 class="second-color">Règles de base</h4>
                            <p class="max-caracter">Nous encourageons tous les voyageurs à respecter
                                quelques règles simples qui contribueront à rendre leur séjour aussi agréable
                                pour eux que pour les hôtes.</p>
                            <ul style="margin:0; " class="display-flex flex-column gap-5px">
                                <li>Respectez le règlement intérieur.</li>
                                <li>Traitez le logement de votre hôte comme si c'était le vôtre.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="relative" style="height:100%">
                    <div class="box-view-annonce sticky-div">
                        <div class="display-flex flex-column gap-10px ">
                            <h2 class="capitalize"><?php echo $appartementAnnonce->getPrixTotal(); ?>€
                                <span class="small">
                                    par nuit</span>
                            </h2>

                            <div>
                                <?php if (!isset($_SESSION['utilisateur'])) : ?>
                                <div class="display-flex flex-column gap-10px">
                                    <div class="display-grid grid-template-columns-2 gap-10px">
                                        <div class="display-flex flex-column gap-5px">
                                            <span class="small">ARRIVÉE</span>
                                            <input
                                                type="date"
                                                id="dateArrivee"
                                                min="<?php echo $appartementAnnonce->getDateLibreAjour(); ?>"
                                                name="dateArrivee"
                                                value="<?php echo $appartementAnnonce->getDateLibreAjour(); ?>"
                                                required>
                                        </div>
                                        <div class="display-flex flex-column gap-5px">
                                            <span class="small">DÉPART</span>

                                            <input
                                                type="date"
                                                id="dateDepart"
                                                name="dateDepart"
                                                min="<?php echo $appartementAnnonce->getDateReservationMin(); ?>"
                                                value="<?php echo $appartementAnnonce->getDateReservationMin(); ?>"
                                                required>
                                        </div>
                                    </div>
                                    <a href="v_connexion.php" class="button-annonce">Connectez-vous pour réserver</a>


                                </div>
                                <p class="small text-align-center" style="margin-top:12px;">Connectez-vous pour effectuer une réservation</p>


                                <table class="table_reservation">
                            <tr>
                                <td><?php echo $appartementAnnonce->getPrixTotal(); ?>€ x
                                    <span id="nuittotal"></span>
                                    nuits</td>
                                <td id="prixnuittotal"></td>
                            </tr>
                            <tr>
                                <td>Charges
                                </td>
                                <td id="charges"></td>
                            </tr>
                            <tr>
                                <td>Frais de service EasyLiving
                                </td>
                                <td id="frais"></td>
                            </tr>
                            <tr>

                                <td>
                                    <hr>
                                    <strong>Total</strong>
                                </td>
                                <td >
                                    <hr>
                                    <strong>
                                        <span id="prixtotal"></span></strong>
                                </td>
                            </tr>
                        </table>



                            <?php elseif ($_SESSION['utilisateur']->verifyReservation($appartementAnnonce->getNumappart(),$_SESSION['utilisateur']->getId())): ?>
                                <div class="align-verticaly align-horizontaly">
                                    
                                        <a href="v_view-voyage.php" class="button-annonce align-horizontaly">
                                            <span class="aligne-icon gap-10px">Voir ma demande réservation</span>
                                        </a>
                                   
                                </div>
                            <?php elseif ($appartementAnnonce->getIdUtilisateur() == $_SESSION['utilisateur']->getId()): ?>
                                <div class="align-verticaly align-horizontaly">
                                    <form action="v_compte-annonce.php" method="post" class="width-100">
                                        <input
                                            type="hidden"
                                            name="view-annonce"
                                            value="<?php echo $appartementAnnonce->getNumappart(); ?>">
                                        <button class="align-horizontaly">
                                            <span class="aligne-icon gap-10px">
                                                <ion-icon name="settings-outline"></ion-icon>Modifier</span></button>
                                        <p class="small text-align-center" style="margin-top:12px;">Modifiez votre annonce</p>

                                    </form>
                                </div>
                            <?php else : ?>
                                <form
                                    class="width-100"
                                    action="../controls/c_AppartementsAccueil.php"
                                    method="post">
                                    <div class="display-grid grid-template-columns-2 gap-10px">
                                        <div class="display-flex flex-column gap-5px">
                                            <span class="small">ARRIVÉE</span>
                                            <input
                                                type="date"
                                                id="dateArrivee"
                                                min="<?php echo $appartementAnnonce->getDateLibreAjour(); ?>"
                                                name="dateArrivee"
                                                value="<?php echo $appartementAnnonce->getDateLibreAjour(); ?>"
                                                required>
                                        </div>
                                        <div class="display-flex flex-column gap-5px">
                                            <span class="small">DÉPART</span>

                                            <input
                                                type="date"
                                                id="dateDepart"
                                                name="dateDepart"
                                                min="<?php echo $appartementAnnonce->getDateReservationMin(); ?>"
                                                value="<?php echo $appartementAnnonce->getDateReservationMin(); ?>"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="align-verticaly align-horizontaly">

                                    <input
                                        type="hidden"
                                        name="demande_reservation"
                                        value="<?php echo $appartementAnnonce->getNumappart(); ?>">
                                    <input
                                        type="hidden"
                                        name="id_proprieter"
                                        value="<?php echo $appartementAnnonce->getIdUtilisateur(); ?>">
                                    <button>Demande de réservation</button>
                                </form>
                            </div>
                            <p class="small text-align-center" style="margin-top:12px;">Aucun montant ne vous sera débité pour le moment
                            </p>

                        </div>
                        <table class="table_reservation">
                            <tr>
                                <td><?php echo $appartementAnnonce->getPrixTotal(); ?>€ x
                                    <span id="nuittotal"></span>
                                    nuits</td>
                                <td id="prixnuittotal"></td>
                            </tr>
                            <tr>
                                <td>Charges
                                </td>
                                <td id="charges"></td>
                            </tr>
                            <tr>
                                <td>Frais de service EasyLiving
                                </td>
                                <td id="frais"></td>
                            </tr>
                            <tr>

                                <td>
                                    <hr>
                                    <strong>Total</strong>
                                </td>
                                <td >
                                    <hr>
                                    <strong>
                                        <span id="prixtotal"></span></strong>
                                </td>
                            </tr>
                        </table>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div style="margin-block:48px;" class="align-verticaly align-horizontaly">

    <div class="flex-column gap-10px ">

        <div class="logo-annonce align-horizontaly">
            <a href="v_accueil.php">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    id="EasyLiving"
                    data-name="EasyLiving"
                    viewbox="0 0 70.87 28.35">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: #1d1d1b;
                            }
                        </style>
                    </defs><path
                        class="cls-1"
                        d="M47.84,4.76l-.93-1h-.08l-.93,1L40.68,10.1v2H53.09v-2ZM42,10.7l4.86-4.95,4.86,4.95Z"/><path
                        class="cls-1"
                        d="M6.84,16.14H2.16v3.91H7.59v1.18H.74v-11H7.52V11.4H2.16V15H6.84Z"/><path
                        class="cls-1"
                        d="M14.1,21.23a2.91,2.91,0,0,1-.19-.86,3,3,0,0,1-2.28,1,2.78,2.78,0,0,1-2-.69A2.22,2.22,0,0,1,8.92,19a2.33,2.33,0,0,1,.95-2,4.38,4.38,0,0,1,2.68-.71h1.34v-.64a1.62,1.62,0,0,0-.43-1.17A1.72,1.72,0,0,0,12.19,14,2,2,0,0,0,11,14.4a1.13,1.13,0,0,0-.5.91H9.08a2,2,0,0,1,.43-1.18,2.86,2.86,0,0,1,1.16-.9,3.67,3.67,0,0,1,1.6-.34,3.13,3.13,0,0,1,2.17.71,2.56,2.56,0,0,1,.82,2v3.77a4.63,4.63,0,0,0,.28,1.79v.12Zm-2.27-1.06a2.44,2.44,0,0,0,1.22-.34,2.17,2.17,0,0,0,.84-.89V17.26H12.81c-1.68,0-2.52.5-2.52,1.51a1.28,1.28,0,0,0,.43,1A1.69,1.69,0,0,0,11.83,20.17Z"/><path
                        class="cls-1"
                        d="M22.08,19.06a1,1,0,0,0-.42-.88,4,4,0,0,0-1.46-.54,6.42,6.42,0,0,1-1.66-.55,2.44,2.44,0,0,1-.9-.75,1.9,1.9,0,0,1-.29-1.05,2.14,2.14,0,0,1,.83-1.7,3.2,3.2,0,0,1,2.13-.7,3.28,3.28,0,0,1,2.21.72,2.29,2.29,0,0,1,.85,1.84H22a1.27,1.27,0,0,0-.47-1A1.76,1.76,0,0,0,20.31,14a1.79,1.79,0,0,0-1.17.34,1.05,1.05,0,0,0-.42.87.86.86,0,0,0,.39.76,4.67,4.67,0,0,0,1.42.49,7.6,7.6,0,0,1,1.66.56,2.45,2.45,0,0,1,.95.79A1.89,1.89,0,0,1,23.45,19a2.11,2.11,0,0,1-.86,1.76,3.52,3.52,0,0,1-2.23.67A4,4,0,0,1,18.65,21a2.84,2.84,0,0,1-1.16-1,2.4,2.4,0,0,1-.42-1.36h1.37A1.46,1.46,0,0,0,19,19.83a2.06,2.06,0,0,0,1.36.41,2.15,2.15,0,0,0,1.25-.32A1,1,0,0,0,22.08,19.06Z"/><path
                        class="cls-1"
                        d="M27.86,19.18,29.73,13h1.46L28,22.5c-.5,1.36-1.29,2-2.38,2l-.26,0-.51-.1V23.29l.37,0A1.83,1.83,0,0,0,26.28,23,2.15,2.15,0,0,0,26.92,22l.3-.84L24.36,13h1.5Z"/><path class="cls-1" d="M34.06,20.05h5.12v1.18H32.63v-11h1.43Z"/><path class="cls-1" d="M40.59,12.1m1.48,9.13H40.7V13h1.37Z"/><path class="cls-1" d="M46.91,19.33l2-6.29h1.4l-2.87,8.19h-1L43.48,13h1.4Z"/><path class="cls-1" d="M53.11,21.23H51.74V13h1.37Z"/><path
                        class="cls-1"
                        d="M56.6,13l0,1a2.91,2.91,0,0,1,2.4-1.18c1.69,0,2.55,1,2.56,2.93v5.41H60.24V15.81a1.9,1.9,0,0,0-.4-1.31,1.56,1.56,0,0,0-1.21-.42,2,2,0,0,0-1.17.36,2.46,2.46,0,0,0-.78,1v5.83H55.3V13Z"/><path
                        class="cls-1"
                        d="M63.35,17.07A4.89,4.89,0,0,1,64.22,14,3,3,0,0,1,68.81,14l.07-.91h1.25v8a3.17,3.17,0,0,1-3.4,3.42,4.08,4.08,0,0,1-1.7-.38,2.94,2.94,0,0,1-1.27-1l.71-.84a2.66,2.66,0,0,0,2.16,1.12,2.08,2.08,0,0,0,1.56-.58,2.23,2.23,0,0,0,.56-1.62v-.7a2.82,2.82,0,0,1-2.25,1,2.72,2.72,0,0,1-2.27-1.16A5.09,5.09,0,0,1,63.35,17.07Zm1.38.16a3.76,3.76,0,0,0,.56,2.18,1.81,1.81,0,0,0,1.56.79A2,2,0,0,0,68.75,19V15.25a2,2,0,0,0-1.89-1.17,1.8,1.8,0,0,0-1.56.8A4,4,0,0,0,64.73,17.23Z"/></svg>
            </a>
        </div>

        <h2 style="color:var(--text-color-black); text-align:center;">"Où la recherche d'un chez-soi devient aussi simple que le nom de l'entreprise"</h2>
    </div>

</div>
<div class="align-horizontaly">
    <h3 class="second-color">Vous pourriez également aimer</h3>
</div>
<?php 
         include_once('../controls/c_AppartementsAccueil.php'); 
        ?>
<?php if (empty($appartements)) :  echo $messageNoAppart?>
<?php else: ?>
<div class="conteiner-grid-annonce-like-icons scroll-container">
    <div class="conteiner-grid-annonce-like scroll-content " id="scrollContainer">

        <?php foreach ($appartements as $appartement) : ?>
        <a href="#" onclick="submitForm(<?php echo $appartement->getNumappart() ?>)">
            <div class="box-grid-accueil-annonce">
                <div class="img-annonce align-horizontaly">
                    <img src="../src/<?php echo $appartement->getTypappart() . '.png'; ?>" alt="">
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
                    <!-- <span class="button align-horizontaly align-verticaly"><ion-icon
                    name="ticket-outline"></ion-icon></span> -->
                </div>

                <form
                    action="../controls/c_AppartementsAccueil.php"
                    method="post"
                    id="form_<?php echo $appartement->getNumappart() ?>">
                    <input
                        type="hidden"
                        name="view-annonce"
                        value="<?php echo $appartement->getNumappart() ?>">
                </form>

            </div>
        </a>
        <?php endforeach; ?>

    </div>
</div>

<?php endif; ?>
</div>
<script>
function submitForm(formId) {
    document
        .getElementById('form_' + formId)
        .submit();
}
</script>
</div>

</div>

<?php endif;?>

</div>

<?php include('footer.php'); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
const scrollContainer = document.querySelector(".scroll-container");
const scrollContent = document.querySelector(".scroll-content");
const scrollSpeed = 80;

scrollContainer.addEventListener("wheel", function (event) {
event.preventDefault();

const delta = Math.sign(event.deltaY);
scrollContent.scrollLeft += delta * scrollSpeed;
});
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
// Récupérer les éléments HTML nécessaires
var nuitsSpan = document.getElementById("nuittotal");
var chargesSpan = document.getElementById("charges");
var prixNuitsTotalSpan = document.getElementById("prixnuittotal");
var fraisSpan = document.getElementById("frais");
var prixTotalSpan = document.getElementById("prixtotal");
var dateArriveeInput = document.getElementById("dateArrivee");
var dateDepartInput = document.getElementById("dateDepart");

// Fonction pour calculer le nombre de nuits entre deux dates
function calculerNombreNuits(dateArrivee, dateDepart) {
var diff = new Date(dateDepart) - new Date(dateArrivee);
return Math.ceil(diff / (1000 * 60 * 60 * 24));
}

// Fonction pour mettre à jour les résultats
function mettreAJourResultats() {
// Vérifier si les champs d'entrée sont vides
if (dateArriveeInput.value == '' || dateDepartInput.value == '') {
// Si l'un des champs est vide, les résultats seront vides
nuitsSpan.textContent = '0';
prixNuitsTotalSpan.textContent = '0€';
fraisSpan.textContent = '0€';
prixTotalSpan.textContent = '0€';
chargesSpan.textContent = '0€';
return;
}
var nuits = Math.max(
calculerNombreNuits(dateArriveeInput.value, dateDepartInput.value),
0
);
var prixNuitsTotal = nuits * <?php echo $appartementAnnonce->getPrixTotal(); ?>;
var prixChargeTotal = nuits * <?php echo $appartementAnnonce->getPrixCharg(); ?>;
var frais = (prixNuitsTotal * 0.07).toFixed(2);
var prixTotal = prixNuitsTotal;

// Mettre à jour les éléments HTML
nuitsSpan.textContent = nuits;
prixNuitsTotalSpan.textContent = prixNuitsTotal + "€";
fraisSpan.textContent = frais + "€";
prixTotalSpan.textContent = prixTotal + "€";
chargesSpan.textContent = prixChargeTotal + "€";
}

// Ajouter des écouteurs d'événements pour mettre à jour les résultats lors de
// la modification des dates
dateArriveeInput.addEventListener("input", mettreAJourResultats);
dateDepartInput.addEventListener("input", mettreAJourResultats);

// Appeler la fonction une fois au chargement de la page
mettreAJourResultats();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
// Sélectionnez les éléments d'entrée de date
var dateArriveeInput = document.getElementById('dateArrivee');
var dateDepartInput = document.getElementById('dateDepart');

// Ajoutez un écouteur d'événements à la date d'arrivée
dateArriveeInput.addEventListener('change', function () {
// Récupérez la date d'arrivée sélectionnée
var dateArrivee = new Date(dateArriveeInput.value);

// Récupérez la valeur du préavis
var preavis = <?php echo $appartementAnnonce->getPreavis(); ?>;

// Ajoutez le nombre approprié de jours à la date d'arrivée pour obtenir la date
// de départ minimale
dateArrivee.setDate(dateArrivee.getDate() + (
preavis === 1
    ? 7
    : 2
));

// Mettez à jour la valeur minimale de la date de départ
dateDepartInput.min = dateArrivee
.toISOString()
.split('T')[0];

// Réinitialisez la valeur de la date de départ à la nouvelle valeur minimale
dateDepartInput.value = "";
});
});
</script>