<?php
/**
 * Code de traitement pour le fichier entrainements_index.php
 * @author : Ilyas DAOUDA
 */
?>

<?php

  // Connexion à la BDD
  require_once("param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  if ($stmt = $mysqli->prepare("SELECT titre, description_entrainement, categorie FROM entrainements WHERE estAnnulé = 0 ORDER BY date_entrainement LIMIT 5")) {

    $stmt->execute();
    $result = $stmt->get_result(); // On récupère le résultat de la requête

    // On vérifie si des lignes ont été trouvées
    if ($result->num_rows > 0) {
      $resultats = [];
      while ($row = $result->fetch_assoc()) {
          $resultats[] = $row;
      }
      $_SESSION['resultats'] = $resultats; // On stocke les résultats pour l'affichage
    }

    else {
      $_SESSION['message'] = "Aucun enregistrement trouvé.";
    }
  }

  else {
    $_SESSION['message'] = "Connexion impossible à la base de données pour l'affichage des entraînements.";
    header('Location: index.php');
  }

?>