<?php

include_once('../models/AppartementModel.php');
require_once('../models/ModeleDonnees.php');
require_once ('../models/UtilisateurModel.php') ;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['utilisateur'])) {
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['supprimer-demande'])) {
            $modele = new ModeleDonnees('ecriture');

            $id = intval($_POST['supprimer-demande']);
            $modele->DeleteDemandeById($id);

            switch ($_POST["location"]) {
                case 'demande':
                    header("Location: ../view/v_compte-annonce.php");
                    break;
                case 'voyage':
                        header("Location: ../view/v_view-voyage.php");
                        break;
                default:
                header("Location: ../view/v_erreur.php");
                break;
            }
           
            exit;
        }
        if (isset($_POST['annuler-demande-an'])) {
            $modele = new ModeleDonnees('ecriture');

            $id = intval($_POST['annuler-demande-an']);
            $modele->UpdateStatusDemandeById($id,'an');


            switch ($_POST["location"]) {
                case 'demande':
                    header("Location: ../view/v_compte-annonce.php");
                    break;
                case 'voyage':
                        header("Location: ../view/v_view-voyage.php");
                        break;
                default:
                header("Location: ../view/v_erreur.php");
                break;
            }
        }
        if (isset($_POST['approuver-demande-ap'])) {
            $modele = new ModeleDonnees('ecriture');

            $id = intval($_POST['approuver-demande-ap']);
            $modele->UpdateStatusDemandeById($id,'ap');
            header("Location: ../view/v_compte-annonce.php");
            exit;
        }
        if (isset($_POST['reserver-logement-rib'])) {
            $modele = new ModeleDonnees('ecriture');
           
            $num_cpte_banque = filter_input(INPUT_POST, 'num_compte', FILTER_SANITIZE_NUMBER_INT);
            $banque = strtolower(filter_input(INPUT_POST, 'banque', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $tel_banque = filter_input(INPUT_POST, 'tel_banque', FILTER_SANITIZE_NUMBER_INT);
            $adress_banque = strtolower(filter_input(INPUT_POST, 'adresse_banque', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $code_ville_banque = filter_input(INPUT_POST, 'Code_postal', FILTER_SANITIZE_NUMBER_INT);
            $numappart = $_POST['reserver-logement-rib'];
            $num_dem = $_POST['num_dem'];
            $nom = $_SESSION['utilisateur']->getNom();
            $prenom = $_SESSION['utilisateur']->getPrenom();
            $tel = $_SESSION['utilisateur']->getTel();
            $date_libre = $_POST['dateDepart'];
            
             $result = $modele->InsertNewLocater($nom, $prenom,$tel , $num_cpte_banque, $banque, $adress_banque, $code_ville_banque, $tel_banque, $numappart);
             if ($result > 0)  {
                 $modele->UpdateStatusDemandeById($num_dem,'ecl');
                 $modele->UpdateDateDisponibleAppartement($numappart,$date_libre);
                 header('Location: ../view/v_view-voyage.php');
                 exit;
             }
             else
             {
                 header('Location: ../view/v_erreur.php');
               exit;
             }
            
        }
    }
    else {
        $modele = new ModeleDonnees('lecture');
        $ea = []; 
        $ex = [];
        $an = [];  
        $ap = [];  
        $ecl = [];
        $mesDemandes = $_SESSION['utilisateur']->getAllDemandesUtilisateur();
        
        foreach ($mesDemandes as $demande) 
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

    }

}
else {
    header('Location: v_connexion.php');
}