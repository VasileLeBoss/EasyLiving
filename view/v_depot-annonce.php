<?php
include('header.php');
include('../controls/connected.php');
?>
<div class="min-conteiner ">
<div class="full-width-white-padding-header">
<h1>Vous avez un bien <span class="second-color">à louer</span></h1>
</div>
<div class="grid-columns">
    <div class="box">
        <div class=" box-min-height">
        <H2>Louez par vous-même, avec nos conseils</H2>
        <h4>Gérez l'intégralité du processus.</h4>
        <ul>
            <li><span class="align-verticaly "><ion-icon name="gift-outline"></ion-icon>100% (vraiment) gratuit</span></li>
            <li><span class="align-verticaly "><ion-icon name="balloon-outline"></ion-icon>Utilisation simple, à la portée de tous</span></li>
            <li><span class="align-verticaly "> <ion-icon name="time-outline"></ion-icon>Louez rapidement et efficacement</span></li>
        </ul>
        </div>
        <form action="../controls/c_nouveauAppartement.php" method="post">
        <button type="submit">Déposer mon annonce</button>
        <!-- <a href="v_depot-annoce-structure.php"></a> -->
        </form>

    </div>
    <div class="box">
        <div class="box-min-height">
        <H2>Connaissez-vous le montant de votre loyer ?</H2>
        <h4 >Évaluez votre bien gratuitement en quelques clics.</h4>
        <ul>
            <li><span class="align-verticaly "><ion-icon name="gift-outline"></ion-icon>100% (vraiment) gratuit</span></li>
            <li><span class="align-verticaly "><ion-icon name="key-outline"></ion-icon>Estimation personnalisée du prix de location</span></li>
            <li><span class="align-verticaly "><ion-icon name="checkmark-outline"></ion-icon>Traitement rapide et résultats instantanés</span></li>
        </ul>
        </div>
        <button type="submit">Estimer mon bien</button>
    </div>
</div>

</div>

<?php
include('footer.php');
?>