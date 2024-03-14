<?php
session_start();
session_destroy();

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Expires: 0');

header('Location: ../index.php');
exit();
?>
