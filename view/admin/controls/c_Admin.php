<?php
if (Utilisateur::estAdmin()) {
    $AllUtilisateurs = $_SESSION['utilisateur']->getAllUtilisateurs();
    $AllAppartements = $_SESSION['utilisateur']->GetAllAppartements();




    $revenuPotentiel = 0;
    $revenuTotal = 0;
    foreach ($AllUtilisateurs as $utilisateur) {

        $LesTaxes = $utilisateur->calculeAdminRevenuUtilisateur() * 0.07;
        $totalUtilisateur = $utilisateur->calculeAdminRevenuUtilisateur();
        $revenuPotentiel += $LesTaxes;
        $revenuTotal += $totalUtilisateur;
    }

    $AllDemandes = $_SESSION['utilisateur']->getAllDemandes();

    require_once('../../models/ModeleDonnees.php');
    $modele = new ModeleDonnees('lecture');
    $AllLocataire = $modele->getAllLocataire();

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
        if (isset($_POST['archiver'])) {
            
            require_once('../../models/ModeleDonnees.php');
            $modele = new ModeleDonnees('ecriture');
            $results = $modele->ArchiverUtilisateurbyID($_POST['archiver']);

            echo '<script>window.location.href = "?view=utilisateurs";</script>';
            exit;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['view']) && $_GET['view'] === 'utilisateurs') {
            
            // $donnees = $_SESSION['utilisateur']->revenusParMoisUtilisateurAdmin();

            if (isset($_GET['id'])) {
                
                require_once('../../models/ModeleDonnees.php');
                $modele = new ModeleDonnees('lecture');
                $results = $modele->getUtilisateurByID($_GET['id']);
                $newUser = new Utilisateur;
                $user= $newUser->createUtilisateur($results);


                $donnees = $user->revenusParMoisUtilisateurAdmin();

                $donneesProrieter = [];
                foreach ($donnees as $donnee => $revenu) {
                    
                    $revenuProrieter = $revenu*0.93;
                    $donneesProrieter[$donnee] = $revenuProrieter;
                }

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


            $donnees = $_SESSION['utilisateur']->revenusParMoisAllUtilisateurAdmin();
            $donneesEntreprise = [];
            foreach ($donnees as $donnee => $revenu) {
                
                $revenuEntreprise = $revenu*0.07;
                $donneesEntreprise[$donnee] = $revenuEntreprise;
            }


            include('templates/v_revenu.php');
            exit;

        } elseif (isset($_GET['view']) && $_GET['view'] === 'annonces') {

            include('templates/v_annonces.php'); 
            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'demandeurs') {
            echo "demandeurs";
            exit;
        } elseif (isset($_GET['view']) && $_GET['view'] === 'demandes') {


            $AllDemandes = [];
            foreach ($AllUtilisateurs as $Utilisateur) {
                $newDemandes = $Utilisateur->getAllDemandesUtilisateurAdmin();
                $AllDemandes = array_merge($AllDemandes, $newDemandes);
            }
            sort($AllDemandes);


            include('templates/v_demandes.php'); 
            exit;
        }
         elseif (isset($_GET['view']) && $_GET['view'] === 'locataires') {


            $AllLocataire = $_SESSION['utilisateur']->getAllLocataire();
            include('templates/v_locataires.php'); 
            exit;

        }  else {
            
        }
    
    }

}
else {
    header('Location: ../../v_erreur.php');
}



?>