<?php
/**
 * Page Ajouter un entrainement
 * @author : Ilyas DAOUDA
 */
?>

<?php
  $titre = "Ajouter un entrainement";
  session_start();

  // Redirect to login if the user is not logged in
  if (!isset($_SESSION['admin_id'])) {
     header("Location: ../../Visiteurs/connexion.php");
     exit;
  }

  include('../header_admins_2.php');
  include('../admins.navigation_menu_2.php');
?>

  <h1 class="mb-4 montserrat">Ajouter un entrainement</h1>
  <form  method="POST" action="tt_ajout_entrainement.php">
    <div class="container">

    <!-- Ici on utilise le breakpoint medium -->
    <!-- Titre et catégorie -->
    <div class="row">
        <div class="col-md-6">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control " id="titre" name="titre" placeholder="Titre de l'entrainement..." required>
        </div>
        <div class="col-md-6">
            <label for="categorie" class="form-label">Catégorie</label>
            <input class="form-control" list="categories" name="categorie" id="categorie" required>
            <datalist id="categories">
                <option value="Course de sprint">
                <option value="Course de demi-fond">
                <option value="Course de fond">
                <option value="Course d'ultra-fond">
            </datalist>
        </div>
    </div>

    <!-- Date et heure -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="date_entrainement" class="form-label">Date de l'entrainement</label>
            <input type="date" class="form-control" name="date_entrainement" id="date_entrainement" required>
        </div>
        <div class="col-md-6">
            <label for="heure_debut" class="form-label">Heure de l'entrainement</label>
            <input type="time" class="form-control" name="heure_debut" id="heure_debut" required>
        </div>
    </div>

    <!-- Lieu et nombre maximal de participants -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" class="form-control " id="lieu" name="lieu" placeholder="Lieu de l'entrainement..." required>
        </div>
        <div class="col-md-6">
            <label for="nombre_max_participants" class="form-label">Nombre de participants</label>
            <input type="number" class="form-control" name="nombre_max_participants" id="nombre_max_participants" placeholder="Nombre maximal de participants..." required>
        </div>
    </div>

    <!-- Heure de fin et description -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="description_entrainement" class="form-label">Description de l'entrainement</label>
            <input type="text" class="form-control" name="description_entrainement" id="description_entrainement" placeholder="Description de l'entrainement..." required>
        </div>
        <div class="col-md-6">
            <label for="heure_fin" class="form-label">Heure de fin de l'entrainement</label>
            <input type="time" class="form-control" name="heure_fin" id="heure_fin" required>
        </div>
    </div>

    <div class="row my-3">
        <div class="d-grid d-md-block">
            <button class="btn btn-outline-primary" type="submit">Ajouter</button></div>   
        </div>
    </div>
</form>
 
<?php
  include('../../footer.inc.php');
?>