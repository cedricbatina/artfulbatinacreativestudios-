<?php
session_start();
require_once "functions.php";

// Efface toutes les variables de session
$_SESSION = [];

// Efface le cookie de session (sécurité max)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruit la session sur le serveur
session_destroy();
// Change l'ID de session (précaution session fixation)
session_regenerate_id(true);

// Redirige vers la page de connexion
header("Location: index.php");
exit;
