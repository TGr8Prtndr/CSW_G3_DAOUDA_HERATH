<?php
  session_start();
  $titre = "Accueil";

  // On met à jour la table entrainements pour "annuler les entrainements passés".
  include 'update_entrainements.php';

  // On vérifie si l'utilisateur est connecté et on le redirige le cas échéant selon son type de compte
  if (isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == 'user') {
        header('Location: Utilisateurs/index_users.php');
        exit();
    } elseif ($_SESSION['account_type'] == 'admin') {
        header('Location: Admins/index_admins.php');
        exit();
    }
  }

  include('header.php');

  include('Visiteurs/full.navigation_menu.php');

  include('message.inc.php');
?>

  <div class="row mt-5 bg-light" id="Section1">
    <div class="col-md-6">
      <img class="img-fluid img-thumbnail" src="Images du site/Running.jpg" alt="Image sur le running">
    </div>
    <div class="col-md-6 text-center">
      <h1 class="montserrat">Qui sommes-nous ?</h1>
      <p class="montserrat-p mt-4">RUNNING est une association de l'ESIGELEC dont l'objectif principal est de promouvoir
        la pratique du running autant auprès des élèves que du personnel de l'ESIGELEC.
      </p>
      <p class="montserrat-p mt-4">Que vous soyez débutant ou expérimenté en quête de performance, jeune ou plus âgé, notre
         communauté est ouverte à tous et a pour objectif de rassembler, motiver et encourager chaque participant. Nous 
         proposons des entrainements de groupes pour nos membres tout au long de l'année.
      </p>
      <p class="montserrat-p mt-4">Rejoignez-nous !</p>
    </div>
  </div>

  <!-- Affichage du tableau -->
  <?php include('entrainements_index.php');?>

<?php
  include('footer.inc.php');
?>