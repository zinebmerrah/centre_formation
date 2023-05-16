<?php
session_start();
if (isset($_GET['deconnecter'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: acceuil.php');
    exit;
}
;

?>