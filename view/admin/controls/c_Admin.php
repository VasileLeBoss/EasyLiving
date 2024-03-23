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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if (isset($_POST['modif']))
        {
            $newEmail = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            $newNom = ucfirst(strtolower(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $newPrenom = ucfirst(strtolower(filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $newTel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
            $newAdresse = strtolower(filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $newCodeVille = filter_var($_POST['codepostale'], FILTER_SANITIZE_NUMBER_INT);
            $id = $_POST['id_utilisateur'];

            
            if (empty($newEmail) || empty($newNom) || empty($newPrenom) || empty($newTel) || empty($newAdresse) || empty($newCodeVille)) {
                $_SESSION['input-vide_error'] = "Veuillez remplir tous les champs du formulaire.";
                // header("Location: ../view/v_compte-modif.php");
                // exit;
            }

            require_once('../../models/ModeleDonnees.php');

            $modele = new ModeleDonnees('lecture');
            $results = $modele->getUtilisateurByID($id);
            $newUser = new Utilisateur;
            $user= $newUser->createUtilisateur($results);


            if (strtolower($newEmail) != strtolower($user->getEmail())) {
                // Vérifier si l'e-mail n'est pas déjà utilisé par un autre utilisateur
                $monModele = new ModeleDonnees('lecture');
                $nb = $monModele->controleEmailDejaExistant($newEmail);

                if ($nb > 0) {
                    $_SESSION['email_error'] = "L'adresse e-mail saisie est déjà associée à un compte.";
                }
                else {
                    $monModele = new ModeleDonnees('ecriture');
                    $monModele->updateInfoPersoUtilisateurBDD($id, $newEmail, $newNom, $newPrenom, $newTel, $newAdresse, $newCodeVille);
                }
                
            }
            if (isset($_SESSION['email_error'])) {
                $newEmail = $user->getEmail();
            }
            $monModele = new ModeleDonnees('ecriture');
            $monModele->updateInfoPersoUtilisateurBDD($id,$newEmail, $newNom, $newPrenom, $newTel, $newAdresse, $newCodeVille);
            $modele = new ModeleDonnees('lecture');
            $results = $modele->getUtilisateurByID($id);
            $newUser = new Utilisateur;
            $user= $newUser->createUtilisateur($results);

            include('templates/v_utilisateur-details.php'); 
            exit;

        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['view']) && $_GET['view'] === 'utilisateurs') {
            
            

            if (isset($_GET['id'])) {
                
                require_once('../../models/ModeleDonnees.php');
                $modele = new ModeleDonnees('lecture');
                $results = $modele->getUtilisateurByID($_GET['id']);
                $newUser = new Utilisateur;
                $user= $newUser->createUtilisateur($results);
                include('templates/v_utilisateur-details.php'); 

                exit;
                }


            if (isset($_GET['query'])) {
                        $AllUtilisateurs=[];
                        require_once('../../models/ModeleDonnees.php');
                        $modele = new ModeleDonnees('lecture');
                        $results = $modele->searchUtilisateur($_GET['query']);
                        foreach($results as $utilisateur)
                        {
                            $newUser = new Utilisateur;
                            $AllUtilisateurs[]= $newUser->createUtilisateur($utilisateur);
                        }
                        include('templates/v_utilisateur.php'); 
                        exit;
            }
            include('templates/v_utilisateur.php'); 
            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'revenue') {
            echo "revenue";
            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'annonces') {
            echo "annonces";

            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'demandeurs') {
            echo "demandeurs";

            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'demandes') {
            echo "demandes";
            exit;
        }
         elseif (isset($_GET['view']) && $_GET['view'] === 'locataires') {
            echo "locataires";
            exit;

        }  else {
            
        }
    
    }

}
else {
    header('Location: ../../v_erreur.php');
}



?>