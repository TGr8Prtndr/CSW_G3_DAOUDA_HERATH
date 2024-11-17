<?php
/**
 * Code de traitement pour le fichier inscription.php
 * @author : Ilyas DAOUDA
 */
?>

<?php
  session_start();

  // Contenu du formulaire :
  $nom =  htmlentities($_POST['nom']);
  $prenom = htmlentities($_POST['prenom']);
  $email =  htmlentities($_POST['email']);
  $password = htmlentities($_POST['password']);
  $membre = (int)$_POST['check'];


  // Vérification du domaine de l'email
  if (!preg_match('/@(groupe-esigelec\.org|esigelec\.fr)$/', $email)) {
    $_SESSION['message'] = "Votre email doit appartenir aux domaines @groupe-esigelec.org ou @esigelec.fr.";
    header('Location: inscription.php'); // Redirection vers le formulaire
    exit;
  }

  // Option pour bcrypt (voir le lien du cours vers le site de PHP) :
  $options = [
        'cost' => 10,
  ];
  // On crypte le mot de passe
  $password_crypt = password_hash($password, PASSWORD_BCRYPT, $options);

  // Connexion à la BDD
  require_once("../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  // Vérification si l'utilisateur existe déjà
  if ($stmt = $mysqli->prepare("SELECT idUser FROM utilisateurs WHERE emailUser = ?")) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Cet email est déjà enregistré.";
        header('Location: inscription.php');
        exit;
    }
  }

  // Insertion dans la BDD
  if ($stmt = $mysqli->prepare("INSERT INTO utilisateurs (nom_user, prenom_user, emailUser, userPassword, membre) VALUES (?, ?, ?, ?, ?)")) {

    $stmt->bind_param("ssssi", $nom, $prenom, $email, $password_crypt, $membre);
    // Le message est mis dans la session, il est préférable de séparer message normal et message d'erreur.
    if($stmt->execute()) {
        // Requête exécutée correctement 
        $_SESSION['message'] = "Vous avez bien été enregistré. Bienvenue !";

    } else {
        // Il y a eu une erreur
        $_SESSION['message'] =  "Impossible d'enregistrer";
    }
  }
  
  // Redirection vers la page d'accueil par exemple :
  header('Location: ../index.php');
  
?>