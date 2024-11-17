<?php
/**
 * Barre de navigation pour la page d'accueil admin
 * @author : Ilyas DAOUDA
 */
?>

<nav class="navbar navbar-expand-md bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index_admins.php">Running</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#Section1">Ajouter un entrainement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Section2">Voir les inscrits aux entrainements</a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Section3">Promouvoir un utilisateur</a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Section4">Annuler un entrainement</a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Section5">Ajouter des photos à un entrainement passé</a> 
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="deconnexion.php" onclick="return confirm('Voulez-vous vraiment vous déconnecter ?');">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">