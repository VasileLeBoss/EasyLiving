<?php
include_once('../models/UtilisateurModel.php');
session_start(); 
include('../models/ModeleDonnees.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modif']) && isset($_SESSION['utilisateur'])) 
    {
        switch ($_POST['modif']) {
            case 'info-perso':

                // Filtrer et nettoyer les données du formulaire
                $newEmail = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                $newNom = ucfirst(strtolower(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
                $newPrenom = ucfirst(strtolower(filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
                $newTel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
                $newAdresse = strtolower(filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $newCodeVille = filter_var($_POST['codepostale'], FILTER_SANITIZE_NUMBER_INT);
                $id = $_SESSION['utilisateur']->getId();
                            
                if (empty($newEmail) || empty($newNom) || empty($newPrenom) || empty($newTel) || empty($newAdresse) || empty($newCodeVille)) {
                    $_SESSION['input-vide_error'] = "Veuillez remplir tous les champs du formulaire.";
                    header("Location: ../view/v_compte-modif.php");
                    exit();
                }
                // Vérifiez si l'e-mail a été modifié
                if (strtolower($newEmail) != strtolower($_SESSION['utilisateur']->getEmail())) {
                    // Vérifier si l'e-mail n'est pas déjà utilisé par un autre utilisateur
                    $monModele = new ModeleDonnees('lecture');
                    $nb = $monModele->controleEmailDejaExistant($newEmail);

                    if ($nb > 0) {
                        $_SESSION['email_error'] = "L'adresse e-mail saisie est déjà associée à un compte.";
                        header("Location: ../view/v_compte-modif.php");
                        exit(); 
                    }
                }
                $modelDonnes = new ModeleDonnees('ecriture');
                if ($modelDonnes->updateInfoPersoUtilisateurBDD($id, $newEmail, $newNom, $newPrenom, $newTel, $newAdresse, $newCodeVille)) {
                    $_SESSION['utilisateur']->setNom($newNom);
                    $_SESSION['utilisateur']->setPrenom($newPrenom);
                    $_SESSION['utilisateur']->setEmail($newEmail);
                    $_SESSION['utilisateur']->setTel($newTel);
                    $_SESSION['utilisateur']->setAdresse($newAdresse);
                    $_SESSION['utilisateur']->setCodeVille($newCodeVille);

                    header('Location: ../view/v_compte-info-perso.php');
                    exit();
                } else {
                    header('Location: ../view/v_erreur.php');
                    exit();
                }
            break;
            case 'modif-mdp':

                $oldmdp = $_POST['ancien-mdp'];
                $newmdp = $_POST['nouveauMdpInput'];
                $confirmMdp = $_POST['confirmMdpInput'];

            
                // Vérifier si les champs sont vides
                if (empty($oldmdp) || empty($newmdp) || empty($confirmMdp)) {
                    $_SESSION['mdp_Error'] = 'Veuillez remplir tous les champs.';
                    header("Location: ../view/v_compte-modif-mdp.php");
                    exit();
                }
                if ($oldmdp == $newmdp) {
                    $_SESSION['mdp_Error'] = "Le nouveau mot de passe doit être différent de l'ancien pour des raisons de sécurité.";
                    header("Location: ../view/v_compte-modif-mdp.php");
                    exit();
                }
                
                
                $id = $_SESSION['utilisateur']->getId();
                $monModele = new ModeleDonnees('lecture');
                $hashedPasswordFromDB = $monModele->getHashedPasswordById($id);
            
                if (password_verify($oldmdp, $hashedPasswordFromDB)) {
            
                    // Mettre à jour le mot de passe dans la base de données
                    $monModele = new ModeleDonnees('ecriture');
                    $newHashedPassword = password_hash($newmdp, PASSWORD_DEFAULT);
                    if ($monModele->updatePasswordById($id, $newHashedPassword)) {
                        $_SESSION['mdp_Changed'] = 'Le mot de passe a été modifié';
                        header('Location: ../view/v_compte.php');
                        exit();
                    } else {
                        header('Location: ../view/v_erreur.php?notUpdate');
                        exit();
                    }
            
                } else {
                    // Le mot de passe actuel fourni ne correspond pas au mot de passe dans la base de données
                    $_SESSION['mdp_Error'] = 'Le mot de passe actuel est incorrect.';
                    header("Location: ../view/v_compte-modif-mdp.php");
                    exit();
                }
            break;
            

           
            default:
                header('Location: ../view/v_erreur.php');
                exit();
                break;
        }
    }
    else
    {
        header('Location: ../view/v_erreur.php');
        exit();
    }    
} else {
    header('Location: ../view/v_erreur.php');
    exit();
}
?>
