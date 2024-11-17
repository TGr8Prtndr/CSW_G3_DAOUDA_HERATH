<?php
/**
 * Code pour vérifier à chaque fois si un entrainement de la BDD est déjà passé
 * Si oui, on met la colonne estAnnulé à 0
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

  // On définit le fuseau horaire sur Paris
  date_default_timezone_set('Europe/Paris');

  // On récupère la date et l'heure actuelles
  $date_actuelle = date("Y-m-d");
  $heure_actuelle = date("H:i:s");

  // On met à jour la colonne 'estAnnulé' pour les entrainements passés
  if ($stmt = $mysqli->prepare("UPDATE entrainements SET estAnnulé = 1 WHERE (date_entrainement < '$date_actuelle' OR 
      (date_entrainement = '$date_actuelle' AND heure_debut < '$heure_actuelle')) AND estAnnulé = 0")) {

    $stmt->execute();
    
  }

  $mysqli->close();

?>