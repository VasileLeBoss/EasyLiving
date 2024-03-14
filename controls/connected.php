<?php
if (!Utilisateur::estConnecte()) {
    include('alert_connexion.php');
    echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.body.classList.add("no-scroll");
            var footerElement = document.getElementById("footer");
            if (footerElement) {
                footerElement.style.display = "none";
            }
        });
    </script>';
    // header('Location: v_connexion.php');
    // exit();
}
?>