<?php
/**
 * Code de traitement pour le fichier annuler_entrainement.php
 * @author : Ilyas DAOUDA
 */
?>

<?php
  session_start();
  
  // Connexion à la BDD
  require_once("../../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  // On vérifie si des utilisateurs ont été sélectionnés
    if (isset($_POST['annuler']) && is_array($_POST['annuler'])) {

        $ids = $_POST['annuler']; // Tableau des IDs sélectionnés

        // On prépare les requêtes d'insertion et de suppression
        foreach ($ids as $id) {

            // On met la colonne estAnnulé à 1 dans la table `entrainements`
            $updateQuery = "UPDATE entrainements
                            SET estAnnulé = 1
                            WHERE idEntrainement = ?;";
            
            if ($stmtInsert = $mysqli->prepare($updateQuery)) {
                $stmtInsert->bind_param("i", $id);
                $stmtInsert->execute();
                $stmtInsert->close();
            } else {
                $_SESSION['message'] = "Erreur lors du transfert des données.";
                header('Location: ../index_admins.php');
                exit();
            }

        }

        $_SESSION['message'] = "Les entrainements sélectionnés ont été annulés avec succès.";
    } else {
        $_SESSION['message'] = "Aucun entrainement n'a été annulé.";
    }

  // Redirection vers la page d'accueil par exemple :
  header('Location: ../index_admins.php');

?>