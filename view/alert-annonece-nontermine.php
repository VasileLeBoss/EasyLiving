<?php 
include('header.php');
include('../controls/connected.php');


?>
<body>
<div class="alert-connexion align-verticaly align-horizontaly">
        <div class="form">
            <div class="row-grid">
                
                    <div>
                        <h2>Souhaitez-vous reprendre
                            <span class="second-color">votre annonce en cours de création ?</span>
                        </h2>
                    </div>
                    <div class="columns-grid-alert">
                    <form action="../controls/c_nouveauAppartement.php" name="form-reset"  method="post"> 
                    <input type="hidden" name="form-reset">
                        <a href=""><button type="submit"  id="retour">Effacer et recommencer</button></a>
                    </form> 

                    <form action="../controls/c_nouveauAppartement.php" name="form-continu" method="post">
                        <input type="hidden" name="form-continu">
                        <a href=""><button type="submit" >Reprendre l'annonce</button></a>
                    </form>
                    </div>

            </div>
        </div>
</div>
</body>
