<?php
  session_start();
  $titre = "Accueil";
  header('Content-Type: text/html; charset=utf-8');

  // On met à jour la table entrainements pour "annuler les entrainements passés".
  include '../update_entrainements.php';

  // On vérifie si l'utilisateur est connecté et on le redirige le cas échéant selon son type de compte
  if (isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == 'user') {
        header('Location: ../Utilisateurs/index_users.php');
        exit();
    }
  }
  else {
    header('Location: ../index.php');
    exit();
  }

  include('header_admins_1.php');

  include('admins.navigation_menu_1.php');

  include('../message.inc.php');
?>

  <!-- Section Ajouter un entrainement -->
  <div class="row mt-5 bg-light" >
    <div class="col-md-12 text-center">
      <h1 class="montserrat" id="Section1">Ajouter un entrainement</h1>
    </div>

    <?php include('index_entrainement.php');?>

    <div class="col-md-12 text-center mb-2">
          <button onclick="window.location.href='Ajout_entrainement/ajout_entrainement.php'" type="button" class="btn btn-secondary">Ajouter un entrainement</button>
    </div>
  </div>

  <!-- Section Promouvoir un utilisateur -->
  <div class="row mt-5 bg-light" id="Section3">
    <div class="col-md-12 text-center">
      <h1 class="montserrat">Promouvoir un utilisateur</h1>
    </div>

    <?php include('index_utilisateurs.php');?>

    <div class="col-md-12 text-center mb-2">
          <button onclick="window.location.href='Promouvoir_utilisateur/promouvoir_utilisateur.php'" type="button" class="btn btn-secondary">Promouvoir un utilisateur</button>
    </div>
  </div>

  <!-- Section Annuler un entrainement -->
  <div class="row mt-5 bg-light" id="Section4">
    <div class="col-md-12 text-center">
      <h1 class="montserrat">Annuler un entrainement</h1>
    </div>

    <?php include('index_entrainement.php');?>

    <div class="col-md-12 text-center mb-2">
          <button onclick="window.location.href='Annuler_entrainement/annuler_entrainement.php'" type="button" class="btn btn-secondary">Annuler un entrainement</button>
    </div>
  </div>

<?php
  include('../footer.inc.php');
?>