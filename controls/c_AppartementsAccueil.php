<?php
include_once('../models/AppartementModel.php');
require_once('../models/ModeleDonnees.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $typappart =filter_input(INPUT_POST,'typappart', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $modele = new ModeleDonnees('lecture'); 
        $resultats = $modele->GetAllAppartementsbyType($typappart); 
        if (!empty($resultats)) 
        {
           
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
        }
        else
        {
        $messageNoAppart= " <div class='height-100 width-100 align-horizontaly'><h3 class='text-color-black'>Aucune annonce pour : <span class='second-color capitalize'>" .$typappart. "</span></h3></div>";
        }  
        if (isset($_POST['view-annonce'])) {
            
            $idAnnonce = $_POST['view-annonce'];
            $annonce = $modele->getAnnoncebyID($idAnnonce);

            if (!empty($annonce)) {
                session_start();
                $_SESSION['appartementAnnonce'] = new Appartement(
                    $annonce['numappart'],
                    '',
                    $annonce['rue'],
                    $annonce['arrondisse'],
                    $annonce['etage'],
                    $annonce['typappart'],
                    $annonce['prix_loc'],
                    $annonce['prix_charg'],
                    $annonce['ascenseur'],
                    $annonce['preavis'],
                    $annonce['date_libre'],
                    $annonce['id_utilisateur']
                );
               
            } else {
                $_SESSION['messageNoResult'] = "<h3 class='text-color-black'>L'annonce a été modifiée ou supprimée</h3>";

            }

            header("Location: ../view/v_view-annonce.php");
            exit;

            
    }

    if (isset($_POST['search-appartement'])) {



        $modele = new ModeleDonnees('lecture');
        $resultats = $modele->chercheAppartement3criter($_POST['arrondisment'], $_POST['prix_max'] , $_POST['prix_min']);

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
        }
        else {
            $messageNoAppart= " <div class='height-100 width-100 align-horizontaly text-color-black'><h3>Aucune annonce disponible</h3></div>";
        }

    }


    if (isset($_POST['demande_reservation']))
    {
        include_once('../models/UtilisateurModel.php');
        session_start();
        $dateDepart = $_POST['dateDepart'];
        $dateArrivee = $_POST['dateArrivee'];
        $idAnnonce = $_POST['demande_reservation'];
        $idAppartement = $_POST['demande_reservation'];

        $id_proprieter = $_POST['id_proprieter'];

        $id_demandeur = $_SESSION['utilisateur']->getId();
        $monModele = new ModeleDonnees('ecriture');
                $result = $monModele->demandeReservation($dateArrivee,$dateDepart,$idAppartement,$id_demandeur,$id_proprieter);
                if ($result)
                {
                    header("Location: ../view/v_view-voyage.php");
                    exit;  
                }
                else{
                    header("Location: ../view/v_erreur.php?pas-enregi");
                    exit;  
                }
    }


}
    else {
    $modele = new ModeleDonnees('lecture'); 
    $resultats = $modele->GetAllAppartements(); 
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
    }
    else {
        $messageNoAppart= " <div class='height-100 width-100 align-horizontaly'><h3>Aucune annonce disponible</h3></div>";
    }
        
    }

    
?>
