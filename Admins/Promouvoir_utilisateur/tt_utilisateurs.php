<?php
/**
 * Code de traitement pour le fichier utilisateurs.php
 * @author : Ilyas DAOUDA
 */
?>

<?php

  // Connexion à la BDD
  require_once("../../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  if ($stmt = $mysqli->prepare("SELECT idUser, nom_user, prenom_user, emailUser, membre FROM utilisateurs")) {

    $stmt->execute();
    $result = $stmt->get_result(); // On récupère le résultat de la requête

    // On vérifie si des lignes ont été trouvées
    if ($result->num_rows > 0) {
      $resultats = [];
      while ($row = $result->fetch_assoc()) {
          // Ajout d'une valeur "Veut devenir membre" en fonction de la colonne "membre"
          $row['veut_devenir_membre'] = $row['membre'] == 1 ? 'Oui' : 'Non';

          $resultats[] = $row;
      }
      $_SESSION['resultats'] = $resultats; // On stocke les résultats pour l'affichage
    }

    else {
      $_SESSION['message'] = "Aucun enregistrement trouvé.";
    }
  }

  else {
    $_SESSION['message'] = "Connexion impossible à la base de données pour l'affichage des utilisateurs.";
    header('Location: index_admins.php');
  }

?>