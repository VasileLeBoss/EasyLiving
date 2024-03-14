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
<div class="grid-compte">
    <a href="v_compte-info-perso.php">
    <div class="box-compte">
        <div>
            <img src="../src/id-card.png" alt="">
        </div>
        <div>
            <span class="font-size-24px">Informations Personnelles</span>
        </div>
            <span class="grey">
            Informations personnelles indiquant les méthodes de contact que nous pouvons utiliser pour vous joindre.
            </span>
    </div></a>
    <a href="v_compte-modif-mdp.php">
    <div class="box-compte">
        <div>
            <img src="../src/cyber-security.png" alt="">
        </div>
        <div>
            <span class="font-size-24px">Connexion et securité</span>
        </div>
            <span class="grey">Mettez à jour votre mot de passe et sécurisez votre compte.</span>

    </div>
    </a>
    <a href="">
    <div class="box-compte">
        <div>
            <img src="../src/question.png" alt="">
        </div>
        <div>
            <span class="font-size-24px">Aide & contact</span>
        </div>
        <span class="grey">Besoin d'aide ou de support ? Contactez-nous ou consulter notre FAQ</span>
    </div>
    </a>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var message = "<?php echo isset($_SESSION['mdp_Changed']) ? htmlspecialchars($_SESSION['mdp_Changed']) : ''; ?>";

        if (message) {
            alert(message);
        }
    });
</script>
<?php
include('footer.php');
?>