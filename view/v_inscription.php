<?php
include('header.php')
?>
<div class="conteiner">
        <div class="form">
            <form method="post" action="../controls/c_nouveauUtilisateur.php">
                <div class="row-grid ">
                    <div><h1>Créer un compte</h1></div>
                    
                    <div class="row"><label for="email">Votre e-mail </label></div>
                    <input id="email" name="email" type="text" required>
                    <span id="emailError" class="error-message"></span>

                    <div class="row"><label for="mdp">Votre mot de passe</label></div>
                    <input id="mdp" name="mdp" type="password" required>
                    <span id="mdpError" class="error-message"></span>


                    <div class="row"><label for="confirmMdp">Confirmer le mot de passe</label></div>
                    <input id="confirmMdp" type="password" required>
                    <span id="confirmMdpError" class="error-message"></span>
                    
                    <div class="row"><label for="nom">Nom</label></div>
                    <input id="nom" name="nom" class="capitalize" type="text" required>
                    <span id="nomError" class="error-message"></span>

                    <div class="row"><label for="prenom">Prenom</label></div>
                    <input id="prenom" name="prenom" class="capitalize" type="text" required>
                    <span id="prenomError" class="error-message"></span>

                    <div class="row"><label for="tel">Téléphone</label></div>
                    <input id="tel" name="tel" type="number" required>
                    <span id="telError" class="error-message"></span>

                    <div class="row"><label for="adresse">Adresse</label></div>
                    <input id="adresse" name="adresse" class="capitalize" type="text" required>
                    <span id="adresseError" class="error-message"></span>

                    <div class="row"><label for="code_ville">Code Postale</label></div>
                    <input id="code_ville" name="code_ville" type="number" required>
                    <span id="codeError" class="error-message"></span>
                    <span id="error_message" class="error-message"></span>
                    <button type="submit" id="submitBtn" disabled>Créer un compte</button>
                    
                    <div class="row">
                        <span class="small">Vous avez déjà un compte ? </span>
                        <span><strong><a href="v_connexion.php" class="call-to-inscription">Se connecter</a></strong></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var errorMessage = "<?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>";
        var InputerrorMessage = "<?php echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : ''; ?>";


    <?php unset($_SESSION['email_error']); ?>
    var emailError = document.getElementById('emailError');
    emailError.textContent = errorMessage;

    <?php unset($_SESSION['error_message']); ?>
        var inputVideError = document.getElementById('error_message');
        inputVideError.textContent = InputerrorMessage;
});
</script>
<script src="../scripts/inscriptionCheck.js"></script>
<?php
include('footer.php')
?>