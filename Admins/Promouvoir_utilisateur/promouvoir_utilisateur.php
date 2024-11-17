<?php
/**
 * Page Promouvoir un utilisateur
 * @author : Ilyas DAOUDA
 */
?>

<?php
  $titre = "Promouvoir un utilisateur";
  session_start();

  // Redirect to login if the user is not logged in
  if (!isset($_SESSION['admin_id'])) {
     header("Location: ../../Visiteurs/connexion.php");
     exit;
  }

  include('../header_admins_2.php');
  include('../admins.navigation_menu_4.php');
?>

  <form  method="POST" action="tt_promouvoir_utilisateur.php">
    <div class="container">
    
    <!-- Section Promouvoir un utilisateur -->
    <div class="row mt-5 bg-light" id="Section3">
        <div class="col-md-12 text-center">
        <h1 class="montserrat">Promouvoir un utilisateur</h1>
        </div>

        <?php include('utilisateurs.php');?>

    </div>

    <div class="row my-3">
        <div class="d-grid d-md-block text-center">
            <button class="btn btn-outline-primary" type="submit">Promouvoir la sélection</button></div>   
        </div>
    </div>
</form>
 
<?php
  include('../../footer.inc.php');
?>