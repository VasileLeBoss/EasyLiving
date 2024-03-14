<?php
include ('../models/ModeleDonnees.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Vérifier si les champs ne sont pas vides
    if (empty($_POST['email']) || empty($_POST['mdp']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['tel']) || empty($_POST['adresse']) || empty($_POST['code_ville'])) {
        session_start();
        $_SESSION['error_message'] = 'Veuillez remplir tous les champs du formulaire.';
        header("Location: ../view/v_inscription.php");
        exit();
    }
    $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $newmdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $nom = ucfirst(strtolower(filter_input(INPUT_POST,'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $prenom = ucfirst(strtolower(filter_input(INPUT_POST,'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $tel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
    $adresse = strtolower(filter_input(INPUT_POST,'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $code_ville = filter_var($_POST['code_ville'], FILTER_SANITIZE_NUMBER_INT);

    $monModele = new ModeleDonnees('lecture');
    $nb = $monModele->controleEmailDejaExistant($email);

    if ($nb > 0) {

        session_start();
        $_SESSION['email_error'] = 'Cette adresse e-mail est déjà associée à un compte.';
        header("Location: ../view/v_inscription.php");
        exit(); 
    }
    else
    {
        $monModele = new ModeleDonnees('ecriture');
        $monModele->insertUtilisateur(strtolower($email),$newmdp,strtolower($nom),strtolower($prenom),$tel,strtolower($adresse),$code_ville);
        $monModele = new ModeleDonnees('lecture');
        $utilisateur = $monModele->getUtilisateurByEmail($email);
        session_start();
        // Stocker les informations de l'utilisateur dans la session
        if ($utilisateur) {
            include('../models/UtilisateurModel.php');
            $utilisateur = new Utilisateur($utilisateur['id_utilisateur'], $utilisateur['email'],$utilisateur['nom'],$utilisateur['prenom'],$utilisateur['tel'],$utilisateur['adresse'],$utilisateur['code_ville']);
            $_SESSION['utilisateur'] = $utilisateur;
            header("Location: ../view/v_accueil.php");
            exit();
        }
        else 
        {
            header("Location: ../view/v_connexion.php");
            exit(); 
        }
    }
} else {
    header('Location: ../views/v_erreur.php');
    exit(); 
}





?>