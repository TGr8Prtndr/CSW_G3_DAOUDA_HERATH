<?php
/**
 * Page de connexion à un compte utilisateur/admin
 * @author : Ilyas DAOUDA
 */
?>

<?php
  $titre = "Connexion";
  session_start();
  
  include('header_visitor.php');
  include('lite.navigation_menu.php');
  include('../message.inc.php');
?>
  
  <h1 class="mb-4 montserrat">Connexion à votre compte</h1>
  <form  method="POST" action="tt_connexion.php">
    <div class="container">
    <!-- Ici on utilise le breakpoint medium -->
    <!-- email et mot de passe -->
    <div class="row">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control " id="email" name="email" placeholder="Votre email..." required>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control " id="password" name="password" placeholder="Votre mot de passe..." required>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-grid d-md-block">
            <button class="btn btn-outline-primary" type="submit">Connexion</button></div>   
        </div>
    </div>
</form>
 
<?php
  include('../footer.inc.php');
?>