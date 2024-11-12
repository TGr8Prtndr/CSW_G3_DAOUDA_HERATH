<?php
  session_start(); // Pour les massages

  // Contenu du formulaire :
  $nom =  htmlentities($_POST['nom']);
  $prenom = htmlentities($_POST['prenom']);
  $email =  htmlentities($_POST['email']);
  $password = htmlentities($_POST['password']);
  $membre = (int)$_POST['check'];

  // Option pour bcrypt (voir le lien du cours vers le site de PHP) :
  $options = [
        'cost' => 10,
  ];
  // On crypte le mot de passe
  $password_crypt = password_hash($password, PASSWORD_BCRYPT, $options);

  // Connexion :
  require_once("../param.inc.php");
  $mysqli = new mysqli($host, $login, $passwd, $dbname);
  if ($mysqli->connect_error) {
      die('Erreur de connexion (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }

  // A FAIRE : Attention, ici on ne vérifie pas si l'utilisateur existe déjà
  // Il faut ajouter cette vérification !!!
  if ($stmt = $mysqli->prepare("INSERT INTO utilisateurs (nom_user, prenom_user, emailUser, userPassword, membre) VALUES (?, ?, ?, ?, ?)")) {

    $stmt->bind_param("ssssi", $nom, $prenom, $email, $password_crypt, $membre);
    // Le message est mis dans la session, il est préférable de séparer message normal et message d'erreur.
    if($stmt->execute()) {
        // Requête exécutée correctement 
        $_SESSION['message'] = "Enregistrement réussi";

    } else {
        // Il y a eu une erreur
        $_SESSION['message'] =  "Impossible d'enregistrer";
    }
  }
  // Redirection vers la page d'accueil par exemple :
  header('Location: ../index.php');


?>