<?php
/**
 * Code de traitement pour le fichier index_inscrits.php
 * @author : Ilyas DAOUDA
 */
?>

<?php

  // Connexion à la BDD
  require_once("../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  if ($stmt = $mysqli->prepare("SELECT e.titre, e.description_entrainement, e.date_entrainement, 
                                GROUP_CONCAT(CONCAT(u.prenom_user, ' ', u.nom_user) SEPARATOR ', ') AS inscrits
                                FROM entrainements e
                                LEFT JOIN inscriptions i ON e.idEntrainement = i.idEntrainement
                                LEFT JOIN utilisateurs u ON i.idUser = u.idUser
                                WHERE e.estAnnulé=0
                                GROUP BY e.idEntrainement")) {

    $stmt->execute();
    $resultats = $stmt->get_result(); // On récupère le résultat de la requête

    // On vérifie si des lignes ont été trouvées
    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $data[] = [
            'titre' => htmlspecialchars($row['titre']),
            'description_entrainement' => htmlspecialchars($row['description_entrainement']),
            'date_entrainement' => htmlspecialchars($row['date_entrainement']),
            'inscrits' => !empty($row['inscrits']) ? explode(", ", $row['inscrits']) : []
        ];
    }

    }

    else {
      $_SESSION['message'] = "Aucun enregistrement trouvé.";
    }
  }

  else {
    $_SESSION['message'] = "Connexion impossible à la base de données pour l'affichage des inscrits.";
    header('Location: index_admins.php');
  }

?>