<?php
/**
 * Code de traitement pour le fichier promouvoir_utilisateur.php
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
    if (isset($_POST['promouvoir']) && is_array($_POST['promouvoir'])) {

        $ids = $_POST['promouvoir']; // Tableau des IDs sélectionnés

        // On prépare les requêtes d'insertion et de suppression
        foreach ($ids as $id) {

            // On insère les données de l'utilisateur dans la table `admins`
            $insertQuery = "INSERT INTO admins (nom_admin, prenom_admin, emailAdmin, adminPassword)
                            SELECT nom_user, prenom_user, emailUser, userPassword
                            FROM utilisateurs 
                            WHERE idUser = ?";
            
            if ($stmtInsert = $mysqli->prepare($insertQuery)) {
                $stmtInsert->bind_param("i", $id);
                $stmtInsert->execute();
                $stmtInsert->close();
            } else {
                $_SESSION['message'] = "Erreur lors du transfert des données.";
                header('Location: index_admins.php');
                exit();
            }

            // On supprime l'utilisateur de la table `utilisateurs`
            $deleteQuery = "DELETE FROM utilisateurs WHERE idUser = ?";
            
            if ($stmtDelete = $mysqli->prepare($deleteQuery)) {
                $stmtDelete->bind_param("i", $id);
                $stmtDelete->execute();
                $stmtDelete->close();
            } else {
                $_SESSION['message'] = "Erreur lors de la suppression des données.";
                header('Location: index_admins.php');
                exit();
            }
        }

        $_SESSION['message'] = "Les utilisateurs sélectionnés ont été promus avec succès.";
    } else {
        $_SESSION['message'] = "Aucun utilisateur sélectionné pour la promotion.";
    }

  // Redirection vers la page d'accueil par exemple :
  header('Location: ../index_admins.php');

?>