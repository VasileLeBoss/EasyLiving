<?php
include('header.php')
?>
<div class="conteiner">
        <div class="form">
          <form method="post" action="../controls/c_Login.php">
          <div class="row-grid ">
            <div><h1>Se connecter</h1></div>
            
            <div class="row"><label for="email">Votre e-mail </label></div>
            <input id="email" name="email" type="text" required >
            <div class="row"><label for="mdp">Votre mot de passe</label></div>
            <input id="mdp" name="mdp" type="password" required>
            <span id="login_error" class="error-message"></span>
            <input type="submit" value="Se connecter">
            <div class="row align-horizontaly"><a href="#" class="no-text-decoration" ><span >Mot de passe oublié ?</span></a></div>
            <div class="row"><span class="small">Vous n'avez pas de compte ? </span><span ><strong><a href="v_inscription.php" class="call-to-inscription" >Créer un compte</a></strong></span></div>

          </div>

          </form>

      </div>
</div>
<script>
      document.addEventListener('DOMContentLoaded', function () {
    var errorMessage = "<?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';?>";
    <?php unset($_SESSION['login_error']); ?>
    var login_error = document.getElementById('login_error');
    login_error.textContent = errorMessage;
});
  
</script>


<?php
include('footer.php')
?>