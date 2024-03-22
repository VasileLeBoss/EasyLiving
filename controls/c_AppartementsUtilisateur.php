<?php

include_once('../models/AppartementModel.php');
require_once('../models/ModeleDonnees.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['utilisateur'])) {
    $modele = new ModeleDonnees('lecture');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['search-request'])) {
            $request = ucfirst(strtolower(filter_input(INPUT_POST, 'search-request', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $resultats = $modele->searchannoncewhituserid($request, $_SESSION['utilisateur']->getId());

            if (!empty($resultats)) {
                foreach ($resultats as $donneesAppartement) {
                    $dateTime = new DateTime($donneesAppartement['date_libre']);
                    $formatter = new IntlDateFormatter(
                        'fr_FR',
                        IntlDateFormatter::FULL,
                        IntlDateFormatter::NONE,
                        null,
                        null,
                        'd MMMM yyyy'
                    );
                    $appartement = new Appartement(
                        $donneesAppartement['numappart'],
                        '',
                        $donneesAppartement['rue'],
                        $donneesAppartement['arrondisse'],
                        $donneesAppartement['etage'],
                        $donneesAppartement['typappart'],
                        $donneesAppartement['prix_loc'],
                        $donneesAppartement['prix_charg'],
                        $donneesAppartement['ascenseur'],
                        $donneesAppartement['preavis'],
                        $formatter->format($dateTime),
                        $donneesAppartement['id_utilisateur']
                    );
                    $appartements[] = $appartement;
                    
                }
            } else {
                $messageNoResult = "<h3 class='text-color-black'>Aucune annonce trouvée</h3>" ; 
            }
            
        }
        if (isset($_POST['view-annonce'])) {
            
            $idAnnonce = $_POST['view-annonce'];
            $annonce = $modele->getAnnoncebyID($idAnnonce);
            $appartementAnnonce = new Appartement ;
            $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($annonce);

            // if (!empty($annonce)) {
            //     $appartementAnnonce = new Appartement(
            //         $annonce['numappart'],
            //         '',
            //         $annonce['rue'],
            //         $annonce['arrondisse'],
            //         $annonce['etage'],
            //         $annonce['typappart'],
            //         $annonce['prix_loc'],
            //         $annonce['prix_charg'],
            //         $annonce['ascenseur'],
            //         $annonce['preavis'],
            //         $annonce['date_libre'],
            //         $annonce['id_utilisateur']
            //     );
            // } else {
            //     $messageNoResult = "<h3 class='text-color-black'>L'annonce a été modifiée ou supprimée</h3>";
            // }

            include_once("v_compte-view-annoce.php");
            exit;
        }

        if (isset($_POST["view-demande"])) {
            
            $idAnnonce = $_POST['view-demande'];
            $resultat = $modele->getAnnoncebyID($idAnnonce);
            $appartementAnnonce = new Appartement ;
            $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);
            $demandes = $modele->getAllDemandesAppartementById($idAnnonce);
            
            $ea = []; 
            $ex = [];
            $an = [];  
            $ap = [];  
            $ecl = [];
               
            foreach ($demandes as $demande) 
            {
                switch ($demande['status']) {
                    case 'ea': $ea[] = $demande;
                    break;
                    case 'ex': $ex[] = $demande;
                    break;
                    case 'an': $an[] = $demande;
                    break;
                    case 'ap': $ap[] = $demande;
                    break;
                    case 'ecl': $ecl[] = $demande;
                    break;
                    default: break;
                }
            }


            include('v_view-demande.php');
            exit;
          }
          if (isset($_POST['view-locataire'])) {
            
            $idAnnonce = $_POST['view-locataire'];
            $resultat = $modele->getAnnoncebyID($idAnnonce);
            $appartementAnnonce = new Appartement ;
            $appartementAnnonce = $appartementAnnonce->createAppartementFromAnnonce($resultat);

            $demandes = $modele->getAllLocatairesAppartementById($idAnnonce);
            
            include('v_view-locataires-appartement.php');
            exit;
          }


        // test
        if (isset($_POST['modif-annonce'])) {
            $modele = new ModeleDonnees('ecriture');
        
            $dateLibre = new DateTime($_POST['date_libre']);
        
            // Appel de la fonction UpdateAnnonceById avec $dateLibre comme paramètre
            $resultat = $modele->UpdateAnnonceById(
                $_POST['numappart'],
                $_POST['prix_loc'],
                $_POST['prix_charg'],
                $dateLibre
            );
        
            if ($resultat) {
                $_SESSION['messageUpdateAnnonce'] = "L'annonce a été mise à jour avec succes !";
                header("Location: ../view/v_compte-annonce.php");
                exit;
            } else {
                $_SESSION['messageUpdateAnnonce'] = "Une erreur est survenue lors de la mise à jour de l'annonce.";
                header("Location: ../view/v_erreur.php");
                exit;
            }
           
            
        }



        if(isset($_POST["delete-annonce"]))
        {
            $modele = new ModeleDonnees('ecriture');
            $resultat = $modele->DeleteAnnonceById($_POST['delete-annonce']);

            if ($resultat) {
                $_SESSION['messageUpdateAnnonce'] = "L'annonce a été supprimé avec succes !";
                header("Location: ../view/v_compte-annonce.php");
                exit;
            } else {
                $_SESSION['messageUpdateAnnonce'] = "Une erreur est survenue lors de la suppresion de l'annonce.";
                header("Location: ../view/v_erreur.php");
                exit;
            }

        }


        
        
    } else {
        $resultats = $modele->GetAllAppartementsbyIdUtilisateur($_SESSION['utilisateur']->getId());
        if (!empty($resultats)) {
            foreach ($resultats as $donneesAppartement) {
                $dateTime = new DateTime($donneesAppartement['date_libre']);
                $formatter = new IntlDateFormatter(
                    'fr_FR',
                    IntlDateFormatter::FULL,
                    IntlDateFormatter::NONE,
                    null,
                    null,
                    'd MMMM yyyy'
                );
                $appartement = new Appartement(
                    $donneesAppartement['numappart'],
                    '',
                    $donneesAppartement['rue'],
                    $donneesAppartement['arrondisse'],
                    $donneesAppartement['etage'],
                    $donneesAppartement['typappart'],
                    $donneesAppartement['prix_loc'],
                    $donneesAppartement['prix_charg'],
                    $donneesAppartement['ascenseur'],
                    $donneesAppartement['preavis'],
                    $formatter->format($dateTime),
                    $donneesAppartement['id_utilisateur']
                );
                $appartements[] = $appartement;
            }
        } else {
            $messageNoResult = "<h3>Vous n'avez pas encore d'annonces </h3>";
        }
    }
} else {
    header('Location: ../view/v_erreur.php?nosession');
    exit();
}
?>
