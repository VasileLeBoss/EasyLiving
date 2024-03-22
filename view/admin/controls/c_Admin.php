<?php

if (Utilisateur::estAdmin()) {
    $AllUtilisateurs = $_SESSION['utilisateur']->getAllUtilisateurs();
    $AllAppartements = $_SESSION['utilisateur']->GetAllAppartements();

    $revenuPotentiel = 0;
    foreach ($AllUtilisateurs as $utilisateur) {

        $LesTaxes = $utilisateur->calculeAdminRevenuUtilisateur() * 0.07;
        $revenuPotentiel += $LesTaxes;
    }

    $AllDemandes = $_SESSION['utilisateur']->getAllDemandes();
}


if (isset($_GET['view'])) {
    $message = $_GET['view'];
    switch ($message) {
        case 'utilisateurs':
            echo $message;
            exit;
            break;
        case 'revenue':
            echo $message;
            exit;
            break;
        case 'annonces':
            echo $message;
            exit;
            break;
        case 'demandeurs':
            echo $message;
            exit;
                break;    
                case 'demandes':
                    echo $message;
                    exit;
                        break;
        default:
            echo "ERREUR 404";
            break;
    }
}

?>