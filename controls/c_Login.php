<?php
include('../models/UtilisateurModel.php');
session_start();
include('../models/ModeleDonnees.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mdp'];

    $monModele = new ModeleDonnees('lecture');
    $resultats = $monModele->verifierLoginMdP($email, $mdp);

    if ($resultats !== false) {
        // Utiliser $resultats pour créer l'objet Utilisateur
        $utilisateur = new Utilisateur($resultats['id_utilisateur'], $resultats['email'], $resultats['nom'], $resultats['prenom'], $resultats['tel'], $resultats['adresse'], $resultats['code_ville']);
        
        // Stocker l'objet Utilisateur dans la session
        $_SESSION['utilisateur'] = $utilisateur;

        // Rediriger vers la page d'accueil
        header("Location: ../view/v_accueil.php");
        exit();
    } else {
        // Identification incorrecte, définir un message d'erreur
        $_SESSION['login_error'] = 'Email ou mot de passe incorrect.';
        header("Location: ../view/v_connexion.php");
        exit();
    }
} else {
    // Redirection en cas de méthode incorrecte
    header('Location: ../views/v_erreur.php');
    exit();
}
?>
