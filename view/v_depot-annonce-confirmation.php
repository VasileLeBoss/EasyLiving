<?php
include('header-annonce.php');
include('../controls/connected.php');
?>

<div class="min-conteiner ">
    <div class="full-width-white">
        <h1>Confirmation</h1>
    </div>
    <form id="form-annonce" action="../controls/c_nouveauAppartement.php" method="post">
    <div class="conteiner-form-annonce">

        <div class="box">
            <table class="table_confirmation">
                <tr>
                    <td><strong>Type appartement :</strong></td>
                    <td class="capitalize"><?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getTypappart() : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>Rue :</strong></td>
                    <td class="capitalize"><?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getRue() : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>Arrondissement :</strong></td>
                    <td class="capitalize">
                        <?php
                            echo isset($_SESSION['appart_temp'])
                                ? ($_SESSION['appart_temp']->getArrondissement() === 1
                                    ? $_SESSION['appart_temp']->getArrondissement() . 'er'
                                    : $_SESSION['appart_temp']->getArrondissement() . 'ème')
                                : '';
                        ?>
                    </td>          
                </tr>
                <tr>
                    <td><strong>Etage : </strong></td>
                    <td class="capitalize">
                        <?php
                            if (isset($_SESSION['appart_temp'])) {
                                $etage = $_SESSION['appart_temp']->getEtage();
                                if ($etage == 0) {
                                    echo 'Rez-de-chaussée';
                                } elseif ($etage == 1) {
                                    echo '1er';
                                } else {
                                    echo $etage . 'ème';
                                }
                            } else {
                                echo '';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Ascenseur :</strong></td>
                    <td class="capitalize">
                    <?php
                        echo isset($_SESSION['appart_temp'])
                            ? ($_SESSION['appart_temp']->getAscenseur() === 1
                                ? 'Oui'
                                : 'Non')
                            : '';
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Préavis :</strong></td>
                    <td class="capitalize">
                    <?php
                        echo isset($_SESSION['appart_temp'])
                            ? ($_SESSION['appart_temp']->getPreavis() === 1
                                ? 'Oui'
                                : 'Non')
                            : '';
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Disponible à partir du :</strong></td>
                    <td class="capitalize"><?php echo isset($_SESSION['appart_temp']) ? date('d/m/Y', strtotime($_SESSION['appart_temp']->getDateLibre())) : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>Prix hors charges :</strong></td>
                    <td class="capitalize"><?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getPrixLoc() . '€' : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>Prix charges :</strong></td>
                    <td class="capitalize"><?php echo isset($_SESSION['appart_temp']) ? $_SESSION['appart_temp']->getPrixCharg() . '€' : ''; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="progress-bar">
        <div class="progress"></div>
    </div>
    <div class="progress-bar-conteiner align-verticaly start">
    </div>
    <div class="progress-bar-conteiner align-verticaly">
        <div class="progress-bar-grid ">
            <div class="align-verticaly start">
            <a href="v_depot-annonce-prix.php"><button type="button"><b>Retour</b></button></a> 
            </div>
            <div class="align-verticaly end">
                <input type="hidden" name="form-annonce" value="enregistrer">
                <button id="submitbtn" type="submit" <?php echo isset($_SESSION['appart_temp']) ? '' : 'disabled'; ?>><b>Valider et Déposer</b></button>
            
            </div>
        </div>
      
    </div>
    </form>
</div>
<script src="../scripts/progressBar.js"></script>
<script>
setProgress(100); 
</script>
</body>