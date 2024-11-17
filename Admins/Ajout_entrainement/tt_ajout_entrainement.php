<?php
/**
 * Code de traitement pour le fichier ajout_entrainement.php
 * @author : Ilyas DAOUDA
 */
?>

<?php
  session_start();

  header('Content-Type: text/html; charset=utf-8');
  
  // Contenu du formulaire
  $titre =  htmlentities($_POST['titre']);
  $categorie = htmlentities($_POST['categorie']);
  $date_entrainement = $_POST['date_entrainement'];
  $heure_debut = $_POST['heure_debut'];
  $lieu =  htmlentities($_POST['lieu']);
  $nombre_max_participants = intval($_POST['nombre_max_participants']);
  $description_entrainement =  htmlentities($_POST['description_entrainement']);
  $heure_fin = $_POST['heure_fin'];
  
  // Connexion à la BDD
  require_once("../../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  $mysqli->set_charset("utf8mb4");
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  if ($stmt = $mysqli->prepare("INSERT INTO entrainements (titre, categorie, date_entrainement, heure_debut, lieu, nombre_max_participants, description_entrainement, heure_fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {

    $stmt->bind_param("sssssiss", $titre, $categorie, $date_entrainement, $heure_debut, $lieu, $nombre_max_participants, $description_entrainement, $heure_fin);
    // Le message est mis dans la session, il est préférable de séparer message normal et message d'erreur.
    if($stmt->execute()) {
        // Requête exécutée correctement 
        $_SESSION['message'] = "Entrainement ajouté";

    } else {
        // Il y a eu une erreur
        $_SESSION['message'] = "Impossible d'ajouter";
    }
  }
  // Redirection vers la page d'accueil par exemple :
  header('Location: ../index_admins.php');

?>