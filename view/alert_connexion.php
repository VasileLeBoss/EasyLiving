
<div class="alert-connexion align-verticaly align-horizontaly">
        <div class="conteiner">
        <div class="form">
            <form method="post" action="../controls/c_Login.php">
            <div class="row-grid ">
            <div><h1>Se connecter</h1></div>
            
            <div class="row"><label for="email">Votre e-mail </label></div>
            <input id="email" name="email" type="text" required >
            <div class="row"><label for="mdp">Votre mot de passe</label></div>
            <input id="mdp" name="mdp" type="password" required>
            <div class="row align-horizontaly end "><a href="#" class="no-text-decoration" ><span class="small">Mot de passe oublié ?</span></a></div>

            <span id="login_error" class="error-message"></span>
            <input type="submit" value="Se connecter">
            <div class="row"><span class="small">Vous n'avez pas de compte ? </span><span ><strong><a href="v_inscription.php" class="call-to-inscription" >Créer un compte</a></strong></span></div>

            </div>
        </form>
        </div>
        </div>
</div>

