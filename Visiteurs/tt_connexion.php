<?php
  session_start(); // Pour les messages

  // Contenu du formulaire :
  $email =  htmlentities($_POST['email']);
  $password = htmlentities($_POST['password']);

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

  
  if ($stmt_user = $mysqli->prepare("SELECT userPassword FROM utilisateurs WHERE emailUser = ?")) {

    $stmt_user->bind_param("s", $email);
    $stmt_user->execute();
    $stmt_user->store_result(); // On stocke le résultat de la requête SQL pour vérifier si une ligne a été trouvée.

    // On vérifie si l'email existe dans la base de données (il devrait y avoir une ligne).
    if ($stmt_user->num_rows == 1) {
        $stmt_user->bind_result($hash_password); // On stocke la valeur de la colonne userPassword
        $stmt_user->fetch(); // On stocke cette valeur dans la variable correspondante ici.

        // Vérification de la conformité du mot de passe
        // Le message est mis dans la session, il est préférable de séparer message normal et message d'erreur.
        if (password_verify($password, $hash_password)) {
            $_SESSION['message'] = "Connexion réussie !";
            // Stockage du type de compte
            $_SESSION['account_type'] = "user";
            // Redirection vers la page d'accueil ou tableau de bord
            header('Location: ../Utilisateurs/index_users.php');
        }
        else {
            $_SESSION['message'] = "Mot de passe incorrect.";
            header('Location: connexion.php');
        }
    }

    else {
      if ($stmt_admin = $mysqli->prepare("SELECT adminPassword FROM admins WHERE emailAdmin = ?"))
      {
        $stmt_admin->bind_param("s", $email);
        $stmt_admin->execute();
        $stmt_admin->store_result(); // On stocke le résultat de la requête SQL pour vérifier si une ligne a été trouvée.

        // On vérifie si l'email existe dans la base de données (il devrait y avoir une ligne).
        if ($stmt_admin->num_rows == 1) {
          $stmt_admin->bind_result($hash_password); // On stocke la valeur de la colonne userPassword
          $stmt_admin->fetch(); // On stocke cette valeur dans la variable correspondante ici.

          // Vérification de la conformité du mot de passe
          // Le message est mis dans la session, il est préférable de séparer message normal et message d'erreur.
          if (password_verify($password, $hash_password)) {
              $_SESSION['message'] = "Connexion réussie !";
              // Stockage du type de compte
              $_SESSION['account_type'] = "admin";
              // Redirection vers la page d'accueil ou tableau de bord
              header('Location: ../Admins/index_admins.php');
          }
          else {
              $_SESSION['message'] = "Mot de passe incorrect.";
              header('Location: connexion.php');
          }
        }
      }

      else {
        $_SESSION['message'] = "L'email n'existe pas dans la base de données.";
        header('Location: connexion.php');
      }
    }
  }

  else {
    $_SESSION['message'] = "Connexion impossible.";
    header('Location: connexion.php');
  }

?>