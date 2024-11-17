<?php
/**
 * Code de déconnexion d'un compte utilisateur/admin
 * @author : Ilyas DAOUDA
 */
?>


<?php
session_start();

// On supprime toutes les variables de session
$_SESSION = [];

// On détruit la session
session_destroy();
$_SESSION['message'] = "Vous avez été déconnecté !";

// On redirige vers la page d'accueil visiteur
header("Location: ../index.php");
exit();