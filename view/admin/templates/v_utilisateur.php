<h1 class="fit-content " style="margin-top:0;">
    <a href="?view=utilisateurs" class="text-color-black">
        <span class="aligne-icon gap-10px">
            <ion-icon name="people-circle-outline"></ion-icon>Utilisateurs</a>
    </span>
</h1>
<div class="admin-utilisateurs flex-column display-flex gap-10px">
    <div class="box display-flex flex-column gap-10px">
        <h3 class="no-mar-pad">Chercher un utilisateur</h3>
        <form action="" method="get">
            <input type="search" name="query" id="search-utilisateur">
            <input type="hidden" name="view" value="utilisateurs">
        </form>
    </div>
    <?php if(!empty($AllUtilisateurs)): ?>
    <div class="box display-flex flex-column show-on-decktop">
    
        <div class="box-user second-color display-flex space-between">
            <div>#</div>
            <div>NOM</div>
            <div>PRENOM</div>
            <div>E-MAIL</div>
            <div>ADRESSE</div>
            <div>CODE POSTAL</div>
            <div>TÉLÉPHONE</div>
        </div>

        <?php foreach ($AllUtilisateurs as $utilisateur): ?>
            <form id="form_<?php echo $utilisateur->getId(); ?>" action="" method="get">
                <input type="hidden" name="view" value="utilisateurs">
                <input type="hidden" name="id" value="<?php echo $utilisateur->getId(); ?>">
                <a href="#" onclick="submitForm(<?php echo $utilisateur->getId(); ?>);" class="text-color-black">
                    <div class="box-user display-flex ">
                        <div><?php echo $utilisateur->getId(); ?></div>
                        <div><?php echo $utilisateur->getNom(); ?></div>
                        <div><?php echo $utilisateur->getPrenom(); ?></div>
                        <div><?php echo $utilisateur->getEmail(); ?></div>
                        <div><?php echo $utilisateur->getAdresse(); ?></div>
                        <div><?php echo $utilisateur->getCodeVille(); ?></div>
                        <div><?php echo $utilisateur->getTel(); ?></div>
                    </div>
                </a>
            </form>
        <?php endforeach; ?>



    </div>
    <?php foreach($AllUtilisateurs as $utilisateur): ?>
        <form id="form_<?php echo $utilisateur->getId(); ?>" action="" method="get">
                <input type="hidden" name="view" value="utilisateurs">
                <input type="hidden" name="id" value="<?php echo $utilisateur->getId(); ?>">
        <a href="#" onclick="submitForm(<?php echo $utilisateur->getId(); ?>)">
        <div class="box show-on-mobile">

        <div class="box-user-mobile display-flex flex-column gap-10px">
            <div class="display-flex flex-column gap-5px">
                <span class="second-color "># :
                </span><span><?php echo $utilisateur->getId(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">NOM :
                </span><span><?php echo $utilisateur->getNom(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">PRENOM :
                </span><span><?php echo $utilisateur->getPrenom(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">E-MAIL :
                </span><span><?php echo $utilisateur->getEmail(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">ADRESSE :
                </span><span><?php echo $utilisateur->getAdresse(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">CODE POSTAL :
                </span><span><?php echo $utilisateur->getCodeVille(); ?></span>
            </div>
            <div class="display-flex flex-column gap-5px">
                <span class="second-color ">TÉLÉPHONE :
                </span><span><?php echo $utilisateur->getTel(); ?></span>
            </div>
        </div>
        
    </div>
    </a>
    </form>
    <?php endforeach; ?>
    <?php else: ?>
            <div class="box">
                <h3 class="no-mar-pad"><span class="aligne-icon gap-10px"><ion-icon name="alert-circle-outline"></ion-icon>Aucun utilisateur trouvé</span></h3>
            </div>
    <?php endif; ?>
</div>    

<script>
    function submitForm(userId) {
        var formId = 'form_' + userId;
        document.getElementById(formId).submit();
    }
</script>