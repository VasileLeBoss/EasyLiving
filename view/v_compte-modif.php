<?php
include('header.php');
include('../controls/connected.php');
?>
<div class="min-conteiner ">
    <div class="full-width-white-padding-header">
        <a href="v_compte.php">
            <h1>Mon Compte</h1>
        </a>
        <div class="font-size-20px">
            <span class="capitalize">
                <strong><?php echo htmlspecialchars($_SESSION['utilisateur']->getNomComplet()); ?></strong>
            </span>
        </div>
    </div>
    <div class="grid-compte-info-perso">
        <form
            action="../controls/c_Utilisateur.php"
            method="post"
            onsubmit="return validerFormulaire()">
            <div class="box-compte-info-perso">
                <div class="box-compte-informations">
                    <div class="box-compte-information align-verticaly space-between">
                        <span class="font-size-24px">Information Personnele</span>
                        <span class="align-verticaly">
                            <a href="v_compte-info-perso.php" class="underline">Retour</a>
                        </span>
                    </div>

                </div>

                <div class="box-compte-informations">
                    <div class="box-compte-information">
                        <span>
                            <strong>Nom Légal</strong>
                        </span>
                    </div>
                    <div class="box-compte-information">
                        <div class="box-input-label">
                            <label for="prenom">Prenom</label>
                            <input
                                class="capitalize"
                                name="prenom"
                                id="prenom"
                                type="text"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getPrenom()); ?>"
                                required="required">
                            <span id="prenomError" class="error-message-modif"></span>
                        </div>
                        <div class="box-input-label">
                            <label for="nom">Nom</label>
                            <input
                                class="capitalize"
                                type="text"
                                name="nom"
                                id="nom"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getNom()); ?>"
                                required="required">
                            <span id="nomError" class="error-message-modif"></span>
                        </div>
                    </div>
                </div>
                <div class="box-compte-informations">
                    <div class="box-compte-information">
                        <span>
                            <strong>Adresse Email
                                <ion-icon
                                    name="information-circle-outline"
                                    id="info"
                                    class="info-icon"
                                    title="Le courriel que vous saisissez sera enregistré comme votre nouveau identifiant."></ion-icon>
                            </strong>
                        </span>
                    </div>
                    <div class="box-compte-information" id="box-input-label-single">
                        <span ></span>
                        <div class="box-input-label">
                            <label for="email">Email</label>
                            <input
                                type="text"
                                id="email"
                                name="email"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getEmail()); ?>"
                                required="required">
                            <span id="emailError" class="error-message-modif"></span>
                        </div>
                    </div>
                </div>

                <div class="box-compte-informations">
                    <div class="box-compte-information">
                        <span>
                            <strong>Adresse</strong>
                        </span>
                    </div>
                    <div class="box-compte-information" id="box-input-label-single">
                        <div class="box-input-label">
                            <label for="adresse">Adresse</label>
                            <input
                                type="text"
                                class="capitalize"
                                id="adresse"
                                name="adresse"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getAdresse()); ?>"
                                required="required">
                            <span id="adresseError" class="error-message-modif"></span>
                        </div>
                    </div>
                </div>
                <div class="box-compte-informations">
                    <div class="box-compte-information">
                        <span>
                            <strong>Code Postale</strong>
                        </span>
                    </div>
                    <div class="box-compte-information">
                        <div class="box-input-label">
                            <label for="codepostale">Code Postale</label>
                            <input
                                type="number"
                                name="codepostale"
                                id="codepostale"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getCodeVille()); ?>"
                                required="required">
                            <span id="codeError" class="error-message-modif"></span>
                        </div>
                    </div>
                </div>
                <div class="box-compte-informations">
                    <div class="box-compte-information">
                        <span>
                            <strong>Numéro Téléphone</strong>
                        </span>
                    </div>
                    <div class="box-compte-information">
                        <div class="box-input-label">
                            <label for="tel">Téléphone</label>
                            <input
                                type="number"
                                id="tel"
                                name="tel"
                                value="<?php echo htmlspecialchars($_SESSION['utilisateur']->getTel()); ?>"
                                required="required">
                            <span id="telError" class="error-message-modif"></span>
                        </div>
                    </div>
                </div>
                <span id="input-vide_error" class="error-message-modif"></span>
                <div class="box-compte-informations">
                    <div class="box-compte-information align-verticaly end">
                        <input type="hidden" name="modif" value="info-perso">
                        <button type="submit" id="submitBtn" disabled="disabled">Enregistrer</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<script src="../scripts/modifCheck.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorMessage = "<?php echo isset($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>";
         var InputerrorMessage = "<?php echo isset($_SESSION['input-vide_error']) ?
         htmlspecialchars($_SESSION['input-vide_error']) : ''; ?>";
         htmlspecialchars($_SESSION['input-vide_error']);

        <?php unset($_SESSION['email_error']); ?>
        var emailError = document.getElementById('emailError');
        emailError.textContent = errorMessage;

        <?php unset($_SESSION['input-vide_error']); ?>
        var inputVideError = document.getElementById('input-vide_error');
        inputVideError.textContent = InputerrorMessage;
    });
</script>
<?php
include('footer.php');
?>