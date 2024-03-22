<?php 
 if (!Utilisateur::estAdmin()) {
        header('Location: ../../index.php');
        exit;
    }
?>