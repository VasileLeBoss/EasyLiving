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
    <form name="modif-mdp" action="../controls/c_Utilisateur.php" method="post">
    <div class="box-compte-info-perso">
        <div class="box-compte-informations">
            <div class="box-compte-information align-verticaly space-between" >
                <span class="font-size-24px">Changement de mot de passe</span><span class="align-verticaly"><a href="v_compte.php" class="underline">Retour</a></span>
            </div>

        </div>
        <div class="box-compte-informations">
            <div class="box-compte-information" id="box-input-label-single">
                <span ></span>
                <div class="box-input-label" >
                <label for="ancien-mdp">Ancien mot de passe</label>
                <input type="password" id="ancien-mdp" name="ancien-mdp" required>
                <span id="mdpError" class="error-message-modif"></span>
                </div>
            </div>
        </div>                

        <div class="box-compte-informations">
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label">
                    <label for="nouveauMdpInput">Nouveau mot de passe</label>
                    <input class="capitalize" name="nouveauMdpInput" id="nouveauMdpInput" type="password" required >
                    <span id="newMdpError" class="error-message-modif"></span>
                </div>

            </div>
            <div class="box-compte-information" id="box-input-label-single">
                <div class="box-input-label">
                <div class="box-input-label">
                <label for="confirmMdpInput">Confirmer le mot de passe</label>
                <input class="capitalize" type="password" name="confirmMdpInput" id="confirmMdpInput" required>
                <span id="confirm-mdpError" class="error-message-modif"></span>
            </div>
                </div>

            </div>
        </div>
        
        <span id="dpError" class="error-message-modif"></span>
        <div class="box-compte-informations">
            <div class="box-compte-information align-verticaly end" >
                <input type="hidden" name="modif" value="modif-mdp">
                <button type="submit" id="submitBtn" disabled>Modifier le mot de passe</button>
            </div>

        </div>
    </div>
    </form>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var errorMessage = "<?php echo isset($_SESSION['mdp_Error']) ? $_SESSION['mdp_Error'] : ''; ?>";
    <?php unset($_SESSION['mdp_Error']); ?>
    var mdpError = document.getElementById('mdpError');
    mdpError.textContent = errorMessage;
});
</script>


<script src="../scripts/modifMdpCheck.js"></script>
<?php
include('footer.php');
?>
