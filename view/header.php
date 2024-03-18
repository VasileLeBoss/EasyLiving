<?php
include ('../models/UtilisateurModel.php');
session_start();
include('../controls/check_inactivity.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php
    header('Cache-Control: public, max-age=900'); // Mise en cache publique pendant 15 min
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 900) . ' GMT'); // Expire dans 15 min
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="shortcut icon" href="../src/icon-logo.svg" type="image/x-icon">
    <title>EasyLiving</title>

</head>
<body>

<header class="header-grid ">
<div>
<ul class="nav-list start">
    <li><h1><a href="v_accueil.php">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" id="EasyLiving" data-name="EasyLiving" viewBox="0 0 70.87 28.35"><defs><style>.cls-1{fill:#1d1d1b;}</style></defs><path class="cls-1" d="M47.84,4.76l-.93-1h-.08l-.93,1L40.68,10.1v2H53.09v-2ZM42,10.7l4.86-4.95,4.86,4.95Z"/><path class="cls-1" d="M6.84,16.14H2.16v3.91H7.59v1.18H.74v-11H7.52V11.4H2.16V15H6.84Z"/><path class="cls-1" d="M14.1,21.23a2.91,2.91,0,0,1-.19-.86,3,3,0,0,1-2.28,1,2.78,2.78,0,0,1-2-.69A2.22,2.22,0,0,1,8.92,19a2.33,2.33,0,0,1,.95-2,4.38,4.38,0,0,1,2.68-.71h1.34v-.64a1.62,1.62,0,0,0-.43-1.17A1.72,1.72,0,0,0,12.19,14,2,2,0,0,0,11,14.4a1.13,1.13,0,0,0-.5.91H9.08a2,2,0,0,1,.43-1.18,2.86,2.86,0,0,1,1.16-.9,3.67,3.67,0,0,1,1.6-.34,3.13,3.13,0,0,1,2.17.71,2.56,2.56,0,0,1,.82,2v3.77a4.63,4.63,0,0,0,.28,1.79v.12Zm-2.27-1.06a2.44,2.44,0,0,0,1.22-.34,2.17,2.17,0,0,0,.84-.89V17.26H12.81c-1.68,0-2.52.5-2.52,1.51a1.28,1.28,0,0,0,.43,1A1.69,1.69,0,0,0,11.83,20.17Z"/><path class="cls-1" d="M22.08,19.06a1,1,0,0,0-.42-.88,4,4,0,0,0-1.46-.54,6.42,6.42,0,0,1-1.66-.55,2.44,2.44,0,0,1-.9-.75,1.9,1.9,0,0,1-.29-1.05,2.14,2.14,0,0,1,.83-1.7,3.2,3.2,0,0,1,2.13-.7,3.28,3.28,0,0,1,2.21.72,2.29,2.29,0,0,1,.85,1.84H22a1.27,1.27,0,0,0-.47-1A1.76,1.76,0,0,0,20.31,14a1.79,1.79,0,0,0-1.17.34,1.05,1.05,0,0,0-.42.87.86.86,0,0,0,.39.76,4.67,4.67,0,0,0,1.42.49,7.6,7.6,0,0,1,1.66.56,2.45,2.45,0,0,1,.95.79A1.89,1.89,0,0,1,23.45,19a2.11,2.11,0,0,1-.86,1.76,3.52,3.52,0,0,1-2.23.67A4,4,0,0,1,18.65,21a2.84,2.84,0,0,1-1.16-1,2.4,2.4,0,0,1-.42-1.36h1.37A1.46,1.46,0,0,0,19,19.83a2.06,2.06,0,0,0,1.36.41,2.15,2.15,0,0,0,1.25-.32A1,1,0,0,0,22.08,19.06Z"/><path class="cls-1" d="M27.86,19.18,29.73,13h1.46L28,22.5c-.5,1.36-1.29,2-2.38,2l-.26,0-.51-.1V23.29l.37,0A1.83,1.83,0,0,0,26.28,23,2.15,2.15,0,0,0,26.92,22l.3-.84L24.36,13h1.5Z"/><path class="cls-1" d="M34.06,20.05h5.12v1.18H32.63v-11h1.43Z"/><path class="cls-1" d="M40.59,12.1m1.48,9.13H40.7V13h1.37Z"/><path class="cls-1" d="M46.91,19.33l2-6.29h1.4l-2.87,8.19h-1L43.48,13h1.4Z"/><path class="cls-1" d="M53.11,21.23H51.74V13h1.37Z"/><path class="cls-1" d="M56.6,13l0,1a2.91,2.91,0,0,1,2.4-1.18c1.69,0,2.55,1,2.56,2.93v5.41H60.24V15.81a1.9,1.9,0,0,0-.4-1.31,1.56,1.56,0,0,0-1.21-.42,2,2,0,0,0-1.17.36,2.46,2.46,0,0,0-.78,1v5.83H55.3V13Z"/><path class="cls-1" d="M63.35,17.07A4.89,4.89,0,0,1,64.22,14,3,3,0,0,1,68.81,14l.07-.91h1.25v8a3.17,3.17,0,0,1-3.4,3.42,4.08,4.08,0,0,1-1.7-.38,2.94,2.94,0,0,1-1.27-1l.71-.84a2.66,2.66,0,0,0,2.16,1.12,2.08,2.08,0,0,0,1.56-.58,2.23,2.23,0,0,0,.56-1.62v-.7a2.82,2.82,0,0,1-2.25,1,2.72,2.72,0,0,1-2.27-1.16A5.09,5.09,0,0,1,63.35,17.07Zm1.38.16a3.76,3.76,0,0,0,.56,2.18,1.81,1.81,0,0,0,1.56.79A2,2,0,0,0,68.75,19V15.25a2,2,0,0,0-1.89-1.17,1.8,1.8,0,0,0-1.56.8A4,4,0,0,0,64.73,17.23Z"/></svg>
        </div>
        </a></h1></li>
    </ul>
</div>
<div>
<ul class="nav-list end">
<!-- <li><a class="user " href="v_depot-annonce.php"><button class="demande-log"><span class="aligne-icon"><ion-icon name="bed-outline"></ion-icon>Demander un logement</span></button></a></li> -->

<li><a class="user" href="v_depot-annonce.php"><button class="add-annonce"><span class="aligne-icon"><ion-icon name="add-outline"></ion-icon>Déposer une annonce</span></button></a></li>

    <?php  if (!Utilisateur::estConnecte()) : ?> 
        <li>
            <a href="v_connexion.php" class="user">
                <button class="connexion">Se connecter</button>
            </a>
        </li>
        <li ><a class="menu"><span><ion-icon name="menu-outline"></ion-icon></span></a></li>
    <?php else : ?>
        <li>
            <span class="user" id="user" onclick="toggleUserMenu(event)">
                <div class="relative">
                    <span class="notification-absolute-menu"><?php echo $_SESSION['utilisateur']->getNombreDemandesUtilisateur(); ?></span><ion-icon name="person-circle-outline"></ion-icon>
                </div>
            </span>
            <ul class="user-menu " id="userMenu">
                <hr>
                <a href="v_compte.php"><li><span class="aligne-icon" ><ion-icon name="person-outline"></ion-icon>Compte</span></li></a>
                <hr>
                <a href="v_view-voyage.php"><li><span class="aligne-icon"><ion-icon name="paper-plane-outline"></ion-icon>Voyages</span></li></a>
                
                <a class="relative" href="v_compte-annonce.php"><li><span class="aligne-icon"><ion-icon name="grid-outline"></ion-icon>Gérer mes annonces <span class="notification-relative "><?php echo $_SESSION['utilisateur']->getNombreDemandesUtilisateur(); ?></span></span></li></a>
                <hr>
                <a href="../controls/deconnexion.php"><li><span class="aligne-icon"><ion-icon name="log-out-outline"></ion-icon>Se déconnecter</span></li></a>
                <hr>
            </ul>
        </li>
        <li class="show-on-mobile"><a class="menu"><span class="relative align-verticaly align-horizontaly"><span class="notification-absolute-menu"><?php echo $_SESSION['utilisateur']->getNombreDemandesUtilisateur(); ?></span><ion-icon name="menu-outline"></ion-icon></span></a></li>
    <?php endif; ?>
</ul>
</div>

<ul class="menu-items">
    <?php  if (!Utilisateur::estConnecte()) : ?>
        <hr>
        <!-- <a href="v_depot-annonce.php"><li><span class="aligne-icon"><ion-icon name="bed-outline"></ion-icon>Demander un logement</span></li></a> -->

        <a href="v_depot-annonce.php"><li><span class="aligne-icon"><ion-icon name="add-outline"></ion-icon>Déposer une annonce</span></li></a>
        <hr>
        <a href="v_connexion.php"><li><span class="aligne-icon"><ion-icon name="log-in-outline"></ion-icon>Se connecter</span></li></a>
        <hr>
    <?php else : ?>
        <hr>
                <a href="v_compte.php"><li ><span class="aligne-icon" ><ion-icon name="person-outline"></ion-icon>Compte</span></li></a>
                <hr>
                <a href="v_view-voyage.php"><li><span class="aligne-icon"><ion-icon name="paper-plane-outline"></ion-icon>Voyages</span></li></a>
                <a href="v_compte-annonce.php"><li><span class="aligne-icon relative"><ion-icon name="grid-outline"></ion-icon>Gérer mes annonces<span class="notification-absolute-menu notification-absolute-mobile"><?php echo $_SESSION['utilisateur']->getNombreDemandesUtilisateur(); ?></span></span></li></a>
                <a href="v_depot-annonce.php"><li><span class="aligne-icon"><ion-icon name="add-outline"></ion-icon>Déposer une annonce</span></li></a>
                <hr>
                <a href="../controls/deconnexion.php"><li><span class="aligne-icon"><ion-icon name="log-out-outline"></ion-icon>Se déconnecter</span></li></a>
                <hr>
    <?php endif; ?>
</ul>
</header>

<script src="../scripts/header.js"></script>
