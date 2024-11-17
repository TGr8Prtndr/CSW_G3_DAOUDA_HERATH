<?php
/**
 * Page d'inscription (création d'un compte UTILISATEUR)
 * @author : Ilyas DAOUDA
 */
?>

<?php
  $titre = "Inscription";
  session_start();

  include('header_visitor.php');
  include('lite.navigation_menu.php');
  include('../message.inc.php');
?>

  <h1 class="mb-4 montserrat">Inscription</h1>
  <form  method="POST" action="tt_inscription.php">
    <div class="container">
    
    <!-- Ici on utilise le breakpoint medium -->
     <!-- Nom et prénom -->
    <div class="row">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control " id="nom" name="nom" placeholder="Votre nom..." required>
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control " id="prenom" name="prenom" placeholder="Votre prénom..." required>
        </div>
    </div>

    <!-- Email et mot de passe -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control " id="email" name="email" placeholder="Votre email..." required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control " id="password" name="password" placeholder="Votre mot de passe..." required>
        </div>
    </div>

    <!-- Devenir membre -->
    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" id="check" name="check" value="1" checked>
        <label class="form-check-label">Devenir membre ? (Votre demande sera d'abord étudiée.)</label>
    </div>

    <div class="row my-3">
        <div class="d-grid d-md-block">
            <button class="btn btn-outline-primary" type="submit">Inscription</button></div>   
        </div>
    </div>
</form>
 
<?php
  include('../footer.inc.php');
?>