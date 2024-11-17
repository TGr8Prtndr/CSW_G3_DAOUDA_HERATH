<?php
/**
 * Page Voir les inscrits à un entrainement
 * @author : Ilyas DAOUDA
 */
?>

<?php
$titre = "Voir les inscrits à un entrainement";
session_start();

  // Redirect to login if the user is not logged in
  if (!isset($_SESSION['admin_id'])) {
     header("Location: ../../Visiteurs/connexion.php");
     exit;
  }

include('../header_admins_2.php');
include('../admins.navigation_menu_3.php');

// Pour récupérer la tableau
include('tt_voir_inscrits.php');
?>

<h1 class="mb-4 montserrat">Liste des Inscrits aux entrainements</h1>

<?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-1">Titre</th>
                    <th class="col-3">Description</th>
                    <th class="col-3">Date</th>
                    <th class="col-5">Inscrits</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['titre'] ?></td>
                        <td><?= $row['description_entrainement'] ?></td>
                        <td><?= $row['date_entrainement'] ?></td>
                        <td>
                            <?php if (!empty($row['inscrits'])): ?>
                                <?= implode('<br>', array_map('htmlspecialchars', $row['inscrits'])) ?>
                            <?php else: ?>
                                Aucun inscrit
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

<?php
  include('../../footer.inc.php');
?>

