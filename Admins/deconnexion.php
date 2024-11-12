<?php
session_start();

// On supprime toutes les variables de session
$_SESSION = [];

// On détruit la session
session_destroy();

// On redirige vers la page d'accueil visiteur
header("Location: ../index.php");
exit();